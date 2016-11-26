<?php
namespace Core\ViewHelper;

use Zend\View\Helper\AbstractHelper;

class Status extends AbstractHelper{

    public function __invoke($id, $curStatus){
        if($curStatus==1){
            $status  = 'Yes';
            $class = 'onbg';
        }else{
            $status  = 'No';
            $class = 'offbg';
        }
        $html = sprintf('<span class="cms-status %s" onclick="DevApp.changeStatus(this)" id="%s" curstatus="%s">%s</span>', $class, $id, $curStatus, $status);
        return $html;

}
}

