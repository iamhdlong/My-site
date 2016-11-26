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
        'invokables' => array(
            'BlockSidebar' => 'Blocks\BlockSidebar',

        ),
    ),
);
