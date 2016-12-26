<?php
namespace Core\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zendlib\Validator\StringLength;
use Zend\Session\Container;
use Zend\Mvc\Controller\PluginManager;
use Zend\EventManager\EventManager;

class CoreFrontController extends AbstractActionController{

   public function modelUser(){
       return $this->getServiceLocator()->get('User\Model\User');
   }


}