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


}