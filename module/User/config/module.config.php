<?php
return array(
    'controllers'	=> array(
        'invokables' => array (
            'User\Controller\User' => 'User\Controller\UserController',
        )
    ),
    'view_manager'	=> array(
        'doctype'					=> 'HTML5',
        'template_path_stack'		=> array(__DIR__ . '/../view'),
        'layout'					=> 'layout/frontend'

    ),
    'router' => array(
        'routes' => array(

            'register' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/user/dang-ky',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'User',
                        'action' => 'register'
                    )
                )
            ),
            'login' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/user/dang-nhap',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'User',
                        'action' => 'login'
                    )
                )
            ),
            'logout' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/user/dang-xuat',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'User',
                        'action' => 'logout'
                    )
                )
            ),
            'dashboard' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/user/dashboard',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'User',
                        'action' => 'dashboard'
                    )
                )
            ),

        )
    )
); 