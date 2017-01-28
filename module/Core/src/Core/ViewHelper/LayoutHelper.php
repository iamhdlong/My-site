<?php
namespace Core\ViewHelper;

use Zend\Mvc\MvcEvent;
use Zend\Session\Container;
use Zend\View\Helper\AbstractHelper;

class LayoutHelper extends AbstractHelper{

    public function getUserLoginInfo(){
        $ss = new Container(USER_KEY_AUTH.'_user');
        $user_inf = $ss->user;
        return $user_inf['user'];
    }
}

