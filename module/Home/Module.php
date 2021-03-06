<?php
namespace Home;

use Zend\Mvc\MvcEvent;


class Module
{

    public function onBootstrap(MvcEvent $e)
    {


    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php'
            ), // classmap se load nhanh hon standard (su dung 2 cach, uu tien classmap hon)
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }



    public function getServiceConfig()
    {
        return array(
            'factories' => array(


            ),
        );
    }


}
