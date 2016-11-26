<?php
namespace Blocks;

use Zend\View\Helper\AbstractHelper;

class BlockSidebar extends AbstractHelper{

    public function __invoke($column, $ssFilter){
        require_once "sidebar.phtml";

    }
}

