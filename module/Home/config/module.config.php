<?php
return array(
    'controllers'	=> array(
        'invokables' => array (
            'Home\Controller\Index' => 'Home\Controller\IndexController',
        )
    ),
    'view_manager'	=> array(
        'doctype'					=> 'HTML5',
        'template_path_stack'		=> array(__DIR__ . '/../view'),
        'layout'					=> 'layout/frontend'

    ),
    'router' => array(
        'routes' => array(

            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                )
            ),

        )
    )
); 