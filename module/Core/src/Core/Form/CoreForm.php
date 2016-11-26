<?php
/**
 * Created by PhpStorm.
 * User: long
 */
namespace Core\Form;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Form as Form;

class CoreForm extends Form implements ServiceLocatorAwareInterface{

    public $serviceLocator;
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator(){
        return $this->serviceLocator;

    }

}