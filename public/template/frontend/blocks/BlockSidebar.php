<?php
namespace Blocks;

use Zend\Db\Sql\Predicate\Expression as PExpression;
use Zend\Db\Sql\Predicate\NotIn;
use Zend\View\Helper\AbstractHelper;

class BlockSidebar extends AbstractHelper{

    public $data;
    public function __invoke($column, $ssFilter){
        require_once "blockviews/sidebar.phtml";

    }

    public function setData($model_post_category){

         $this->data = $model_post_category->getItems(array(
             'where'=> array(
                 new NotIn('left',array('0'))
             ),
             'order' => 'left ASC'
         ))->toArray();
        return $this->data;
    }
}

