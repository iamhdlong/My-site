<?php
namespace Core\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class Paginator extends AbstractPlugin {

    protected $itemCountPerPage	= ITEM_COUNT_PER_PAGE;
    protected  $pageRange		= PAGE_RANGE;

    public function __invoke($totalItems)

    {

        $adapterPaginator	= new \Zend\Paginator\Adapter\Null($totalItems);
        $paginator			= new \Zend\Paginator\Paginator($adapterPaginator);
        $paginator->setPageRange($this->pageRange);
        $paginator->setItemCountPerPage($this->itemCountPerPage);
        return $paginator;
    }


}