<?php
namespace Core\ViewHelper;

use Zend\View\Helper\AbstractHelper;

class LinkSort extends AbstractHelper{

    public function __invoke($column, $ssFilter){
        $orderBy = $ssFilter['orderBy'];
        $order = $ssFilter['order'];
        $col = strtolower($column);

        if($orderBy==$col){
            $name = $orderBy;
            if($order == 'asc'){
                $class = 'sorting_asc';
                $onClick = 'desc';
            }else if($order == 'desc'){
                $class = 'sorting_desc';
                $onClick = 'asc ';
            }

        } else{
            $name = $col;
            $class = 'sorting';
            $onClick = 'asc ';
        }
        $html = "<a href='javascript:void(0)' class='{$class}' onclick='DevApp.changeOrder(\"{$name}\",\"{$onClick}\")'>{$column}</a>";
        return $html;

    }
}

