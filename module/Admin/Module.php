<?php
namespace Admin;

use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach('dispatch', array($this, 'loadLayout'));

        $adapter = $e->getApplication()->getServiceManager()->get('dbAdapter');
        GlobalAdapterFeature::setStaticAdapter($adapter);



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

    public function loadLayout(MvcEvent $e)
    {
        $config = $e->getApplication()->getServiceManager()->get('config');

        $controller = $e->getTarget();
        $route = $e->getRouteMatch();
        $controllerArr = explode('\\', $route->getParam('controller'));
        $moduleName = $controllerArr[0];
        $controller->layout($config['layouts'][$moduleName]);
        

        if($route->getParam('__CONTROLLER__')=='User'){
            if($route->getParam('action')=='login'){
                $controller->layout($config['layouts']['UserLogin']);
            }
        }

        //set data breadcrumb to view
        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        $viewModel->arrDataHeader = array(
            'module' => $controllerArr[0],
            'controller' => $controllerArr[2],
            'action' => $route->getParam('action'),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                ##### Group user
                'GroupUserGateway' => function ($sm) {
                    $adapter = $sm->get('dbAdapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new \Admin\Model\Entity\GroupUser());
                   // return new TableGateway('b_group_user', $adapter, null, $resultSetPrototype);
                    return new TableGateway('b_group_user', $adapter, null);
                },
                'Admin\Model\GroupUser' => function ($sm) {
                    $tableGateway = $sm->get('GroupUserGateway');
                    return new \Admin\Model\GroupUser($tableGateway);
                },
                'Admin\Form\GroupUserForm' => function ($sm) {
                    $addForm = new \Admin\Form\GroupUserForm\GroupUserForm();
                    //$addForm->setInputFilter(new \Form\Form\LoginFilter());
                    return $addForm;
                },
                ##### Group user

                ##### User
                'UserGateway' => function ($sm) {
                    $adapter = $sm->get('dbAdapter');
                    return new TableGateway('b_user', $adapter, null);
                },
                'Admin\Model\User' => function ($sm) {
                    $tableGateway = $sm->get('UserGateway');
                    return new \Admin\Model\User($tableGateway);
                },
                'Admin\Form\UserForm' => function ($sm) {
                    $helper = $sm->get('HelperController');
                    $addForm = new \Admin\Form\UserForm\UserForm($helper, $sm);
                    //$addForm->setInputFilter(new \Form\Form\LoginFilter());
                    return $addForm;
                },
                ##### User

                ##### POST
                'PostCategoryGateway' => function ($sm) {
                    $adapter = $sm->get('dbAdapter');
                    return new TableGateway('b_post_category', $adapter, null);
                },
                'Admin\Model\PostCategory' => function ($sm) {
                    $tableGateway = $sm->get('PostCategoryGateway');
                    return new \Admin\Model\PostCategory($tableGateway);
                },
                'Admin\Form\PostCategoryForm' => function ($sm) {
                    $helper = $sm->get('HelperController');
                    $addForm = new \Admin\Form\PostCategoryForm\PostCategoryForm($helper, $sm);
                    return $addForm;
                },

                'PostGateway' => function ($sm) {
                    $adapter = $sm->get('dbAdapter');
                    return new TableGateway('b_posts', $adapter, null);
                },
                'Admin\Model\Post' => function ($sm) {
                    $tableGateway = $sm->get('PostGateway');
                    return new \Admin\Model\Post($tableGateway);
                },
                'Admin\Form\PostForm' => function ($sm) {
                    $helper = $sm->get('HelperController');
                    $addForm = new \Admin\Form\PostForm\PostForm($helper, $sm);
                    return $addForm;
                },
                ##### POST

                ##### PRODUCT
                'ProductCategoryGateway' => function ($sm) {
                    $adapter = $sm->get('dbAdapter');
                    return new TableGateway('b_product_category', $adapter, null);
                },
                'Admin\Model\ProductCategory' => function ($sm) {
                    $tableGateway = $sm->get('ProductCategoryGateway');
                    return new \Admin\Model\ProductCategory($tableGateway);
                },
                'Admin\Form\ProductCategoryForm' => function ($sm) {
                    $helper = $sm->get('HelperController');
                    $addForm = new \Admin\Form\ProductCategoryForm\ProductCategoryForm($helper, $sm);
                    return $addForm;
                },

                'ProductGateway' => function ($sm) {
                    $adapter = $sm->get('dbAdapter');
                    return new TableGateway('b_product', $adapter, null);
                },
                'Admin\Model\Product' => function ($sm) {
                    $tableGateway = $sm->get('ProductGateway');
                    return new \Admin\Model\Product($tableGateway);
                },
                'Admin\Form\ProductForm' => function ($sm) {
                    $helper = $sm->get('HelperController');
                    $addForm = new \Admin\Form\ProductForm\ProductForm($helper, $sm);
                    return $addForm;
                }
                ##### PRODUCT

            ),
        );
    }

//    public function getFormElementConfig(){
//        return array(
//            'factories'	=> array(
//                'Admin\Form\AddForm'	=> function($sm){
//                    $addForm	= new \Admin\Form\AddForm();
//                    //$addForm->setInputFilter(new \Form\Form\LoginFilter());
//                    return $addForm;
//                }
//            ),
//        );
//    }
}
