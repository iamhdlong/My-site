<?php
namespace Core;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
class Module{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager			= $e->getApplication()->getEventManager();
        $moduleRouteListener	= new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php' ;
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader'	=> array(
                __DIR__ . '/autoload_classmap.php'
            ), // classmap se load nhanh hon standard (su dung 2 cach, uu tien classmap hon)
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getServiceConfig(){
    }

    public function getViewHelperConfig(){
        return array(
            'invokables' => array(
                'linkSort' => '\Core\ViewHelper\LinkSort',
                'FilterStatusElement' => '\Core\ViewHelper\FilterStatusElement',
                'SelectElement' => '\Core\ViewHelper\SelectElement',
                'Status' => '\Core\ViewHelper\Status',
                'layoutHelper' => '\Core\ViewHelper\LayoutHelper',
            )
        );
    }
}
