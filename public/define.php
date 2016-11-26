<?php
define('PATH_APPLICATION',(dirname(__DIR__)));

define('PATH_LIBRARY', PATH_APPLICATION.'/library');

define('PATH_PUBLIC', PATH_APPLICATION.'/public');

define('CAPTCHA_PATH', PATH_PUBLIC.'/captcha');

define('PATH_TEMPLATE', PATH_PUBLIC.'/template');

define('PATH_VENDOR', PATH_APPLICATION.'/vendor');

define('HTMLPURIFIER_PREFIX',PATH_VENDOR);




//@@@@@@@@@@@@@@@@@@@@
//@    ADMIN         @
//@@@@@@@@@@@@@@@@@@@@
define('URL_APPLICATION', '');

define('URL_PUBLIC', URL_APPLICATION.'/public');

define('URL_TEMPLATE', URL_PUBLIC.'/template');

define('URL_ADMIN_CSS', URL_TEMPLATE.'/backend/css');

define('URL_ADMIN_JS', URL_TEMPLATE.'/backend/js');

define('URL_PUBLIC_MEDIA', URL_PUBLIC.'/media');


//@@@@@@@@@@@@@@@@@@@@
//@    FRONT         @
//@@@@@@@@@@@@@@@@@@@@

define('URL_FRONT_CSS', URL_TEMPLATE.'/frontend/css');

define('URL_FRONT_JS', URL_TEMPLATE.'/frontend/js');




##paginator info
define('ITEM_COUNT_PER_PAGE',10);
define('PAGE_RANGE',4);
