<?php
namespace User\Controller;

use Core\Controller\CoreFrontController;
use User\Model\User;
use Zend\Mvc\Controller\AbstractActionController;
use Zendlib\Validator\StringLength;
use Zend\Crypt\BlockCipher;

class UserController extends CoreFrontController{
    public function registerAction(){
        $user_form = $this->getServiceLocator()->get('User\Form\UserForm');
        $model_user = $this->modelUser();

        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $user_form->setData($data);
            if($user_form->isValid()){
                $block_cipher = BlockCipher::factory('mcrypt',array('algo'=>'aes'));
                $block_cipher->setKey('encryption_key');
                $pass = $block_cipher->encrypt(strip_tags(trim($data['password'])));
                $id = $model_user -> insert(array(
                    'name'=> strip_tags(trim($data['name'])),
                    'email'=> strip_tags(trim($data['email'])),
                    'password' => $pass,
                    'group' => User::GROUP_MEMBER
                ));

            }else{
               $error =$user_form->showMessage();
            }
        }
        return array(
            'form' => $user_form,
            'error' => $error
        );
    }

    public function loginAction(){
        $user_form = $this->getServiceLocator()->get('User\Form\LoginForm');


        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $user_form->setData($data);
           // if($user_form->isValid()){

                $zendDb				= $this->getServiceLocator()->get('dbAdapter');
                $dbTableAdapter		= new \Zend\Authentication\Adapter\DbTable($zendDb, 'b_user', 'email', 'password', 'MD5(?)');
                $dbTableAdapter->getDbSelect()->where->equalTo('status', 1);
                $authenticateServiceObj	= new \Zend\Authentication\AuthenticationService(null, $dbTableAdapter);
                $authenticateServiceObj->getAdapter()->setIdentity($data['email']);
                $authenticateServiceObj->getAdapter()->setCredential($data['password']);

                $result	= $authenticateServiceObj->authenticate();

                if(!$result->isValid()){
                    $error = '<h3 style="color:red;">'.current($result->getMessages()).'</h3>';
                }else{
                    $data	= $authenticateServiceObj->getAdapter()->getResultRowObject(null, array('password'));
                    $authenticateServiceObj->getStorage()->write($data);
                    return $this->redirect()->toRoute('dashboard');
                }


//            }else{
//                $error =$user_form->showMessage();
//            }
        }
        return array(
            'form' => $user_form,
            'error' => $error
        );
    }

    public function logoutAction(){
        $authenticateServiceObj	= new \Zend\Authentication\AuthenticationService();
        $authenticateServiceObj->clearIdentity();
        return false;
    }

    public function dashboardAction(){
        if($this->identity()){

        }else{
            return $this->redirect()->toRoute('home');
        }
    }


}