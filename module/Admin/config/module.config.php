<?php
return array(
    'controllers'	=> array(
        'invokables' => array (
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\GroupUser' => 'Admin\Controller\GroupUserController',
            'Admin\Controller\User' => 'Admin\Controller\UserController',
            'Admin\Controller\PostCategory' => 'Admin\Controller\PostCategoryController',
            'Admin\Controller\Post' => 'Admin\Controller\PostController',
            'Admin\Controller\ProductCategory' => 'Admin\Controller\ProductCategoryController',
            'Admin\Controller\Product' => 'Admin\Controller\ProductController',
        )
    ),
    'view_manager'	=> array(
        'doctype'					=> 'HTML5',
        'display_not_found_reason' 	=> true,
        'not_found_template'       	=> 'error/404',

        'display_exceptions'       	=> true,
        'exception_template'       	=> 'error/index',

        'template_path_stack'		=> array(__DIR__ . '/../view'),
        'template_map' 				=> array(
            'layout/layout'     => PATH_TEMPLATE . '/backend/main.phtml',
            'layout/backend'     => PATH_TEMPLATE . '/backend/main.phtml',
            'layout/frontend'     => PATH_TEMPLATE . '/frontend/main.phtml',
            'layout/userLogin'     => PATH_TEMPLATE . '/backend/login-user.phtml',
            'layout/error'     => PATH_TEMPLATE . '/error/layout.phtml',
            'error/404'			=> PATH_TEMPLATE . '/error/404.phtml',
            'error/index'		=> PATH_TEMPLATE . '/error/index.phtml',

        ),
        'default_template_suffix'  	=> 'phtml',
        'layout'					=> 'layout/backend'
    ),
    'view_helper_config' => array(
        'flashmessenger' => array(
            'message_open_format'      => '<div class="alert alert-success alert-dismissable ">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												 	<i class="icon fa fa-check"></i> ',
            'message_close_string'     => '</div>',
            'message_separator_string' => ''
        )
    ),
    'router' => array(
        'routes' => array(

//            'home' => array(
//                'type' => 'Literal',
//                'options' => array(
//                    'route' => '/',
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'Admin\Controller',
//                        'controller' => 'Index',
//                        'action' => 'index'
//                    )
//                )
//            ),
            'adminRoute' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array (
                    'default' => array (
                        'type' 		=> 'Segment',
                        'options' 	=> array (
                            'route' => '/[:controller][/:action][/]',
                            'constraints' => array (
                                'controller' 	=> '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array (
                            )
                        )
                    ),
                )
            ),
            //TODO: USER
            'admin-group-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/group-user[/:action][/:id][/]',
                    'constraints' => array (
                        'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' 		=> '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'GroupUser',
                        'action' => 'index'
                    )
                )
            ),

            'admin-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/user[/:action][/:id][/]',
                    'constraints' => array (
                        'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' 		=> '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'User',
                        'action' => 'index'
                    )
                )
            ),
            //##TODO: USER

            //TODO: POST
            'admin-post-category' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/post-category[/:action][/:id][/]',
                    'constraints' => array (
                        'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' 		=> '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'PostCategory',
                        'action' => 'index'
                    )
                )
            ),
            'admin-post' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/post[/:action][/:id][/]',
                    'constraints' => array (
                        'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' 		=> '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Post',
                        'action' => 'index'
                    )
                )
            ),

            //##TODO: POST

            //TODO: PRODUCT
            'admin-product-category' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/product-category[/:action][/:id][/]',
                    'constraints' => array (
                        'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' 		=> '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'ProductCategory',
                        'action' => 'index'
                    )
                )
            ),
            'admin-product' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/product[/:action][/:id][/]',
                    'constraints' => array (
                        'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' 		=> '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Product',
                        'action' => 'index'
                    )
                )
            ),

            //##TODO: PRODUCT


            //route change order when click <th>
//            'admin-change-order-filter' => array(
//                'type' => 'Segment',
//                'options' => array(
//                    'route' => '/admin/change-order-filter[/]',
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'Admin\Controller',
//                        'controller' => 'GroupUser',
//                        'action' => 'filterOrder'
//                    )
//                )
//            ),
        )
    )
); 