<?php
namespace Core\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zendlib\Validator\StringLength;
use Zend\Session\Container;
use Zend\Mvc\Controller\PluginManager;
use Zend\EventManager\EventManager;

class CoreFrontController extends AbstractActionController{

    public function setPluginManager(PluginManager $plugins){
        parent::setPluginManager($plugins);
        $e = new MvcEvent();
        $this->init($e);
    }

    public function init(MvcEvent $e){

    }

   public function modelUser(){
       return $this->getServiceLocator()->get('User\Model\User');
   }

    public function storeUserInfo($data){
        $ss = new Container(USER_KEY_AUTH.'_user');
        $ss->user = $data;
    }

    public function getUserLoginInfo($attr=''){
        $ss = new Container(USER_KEY_AUTH.'_user');
        $info_user = $ss->user;
        $info_user = $info_user['user'];
        if(!empty($attr)){
            $info_user = $info_user->$attr;
        }
        return $info_user;
    }

    public function destroyUserLogin(){
        $ss = new Container(USER_KEY_AUTH.'_user');
        $ss->getManager()->getStorage()->clear();
    }


}