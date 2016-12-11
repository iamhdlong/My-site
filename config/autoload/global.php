<?php
return array(
    'db' => array(
        'driver' => 'Pdo_Mysql',
        'database' => 'b_gedb',
        'charset' => 'utf8',
    ),

    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'HelperController' => function ($sm) {
                return new Core\Controller\HelperController();
            },
        ),
        'aliases' => array(
            'dbAdapter' => 'Zend\Db\Adapter\Adapter',
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'BlockSidebar' => function($sm){
                $model_post_category = $sm->getServiceLocator()->get('Admin\Model\PostCategory') ;
                $block = new \Blocks\BlockSidebar($model_post_category);
                $block->setData($model_post_category);
                return $block;
            },

        ),
    ),
);
