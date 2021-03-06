<?php
include_once 'define.php';
include_once PATH_LIBRARY.'/Zend/Loader/AutoloaderFactory.php';


chdir(dirname(__DIR__)) ;
ini_set('display_errors',0);
if(!class_exists('Zend\Loader\AutoloaderFactory')){
	die('Zend\Loader\AutoloaderFactory is not exits');
}

\Zend\Loader\AutoloaderFactory::factory(array(
	'Zend\Loader\StandardAutoLoader' => array(
			'autoregister_zf' => true,
            'namespaces' => array(
                'Zendlib' => PATH_LIBRARY . '/Zendlib',
                'Blocks' => PATH_TEMPLATE . '/frontend/blocks'
                ),
            'prefixes'		 => array(
                'HTMLPurifier'	=> PATH_VENDOR . '/HTMLPurifier'
                ),
			),
));

\Zend\Mvc\Application::init(require_once 'config/application.config.php')->run();