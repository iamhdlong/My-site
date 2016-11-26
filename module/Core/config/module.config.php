<?php
return array(
    'controllers'	=> array(
        'invokables' => array (
            'Core\Controller\CoreAdmin' => 'Core\Controller\CoreAdminController',
        )
    ),

    'controller_plugins'	=> array(
 			'invokables'	=> array(
 					'Paginator'	=> 'Core\Plugin\Paginator',
 			),
    ),
    'router' => array(
        'routes' => array(
            'coreadmin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/core-admin[/:action][/:id][/]',
                    'constraints' => array (
                        'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' 		=> '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Core\Controller',
                        'controller' => 'CoreAdmin',
                        'action' => 'index'
                    )
                )
            ),

            //route change order when click <th>
            'admin-change-order-filter' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/core-admin/change-order-filter[/]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Core\Controller',
                        'controller' => 'CoreAdmin',
                        'action' => 'filterOrder'
                    )
                )
            ),
        )
    )
); 