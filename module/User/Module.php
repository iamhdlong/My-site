<?php
namespace User;

use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

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
                'User\Form\UserForm' => function ($sm) {
                    $addForm = new \User\Form\UserForm\UserForm($sm);
                    return $addForm;
                },
                'User\Form\LoginForm' => function ($sm) {
                    $loginForm = new \User\Form\LoginForm\LoginForm($sm);
                    return $loginForm;
                },
                'User\Model\User' => function ($sm) {
                    $adapter = $sm->get('dbAdapter');
                    $tableGateway = new TableGateway('b_user', $adapter, null);
                    return new \User\Model\User($tableGateway);
                },

            ),
            'invokables' => array(
                'Zend\Authentication\AuthenticationService' => 'Zend\Authentication\AuthenticationService',
            ),
        );
    }


}
