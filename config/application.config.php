<?php
return array(
		'modules' => array(
            'AcMailer',
			'Admin',
            'Core',
            'Home',
            'User',
		),
		'module_listener_options' => array(
				'module_paths'	 => array(
						'./module',
						'./vendor',
                ),
				'config_glob_paths' => array(
						'config/autoload/{,*.}{global,database}.php'
                ),
		),
		'service_manager' => array(),
//        'view_helpers'	=> array(
//            'invokables' => array(
//                'BlockSidebar'			=> 'Blocks\BlockSidebar',
//
//            ),
//        ),
);