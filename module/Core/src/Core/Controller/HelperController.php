<?php
namespace Core\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zendlib\Validator\StringLength;
use Zend\Session\Container;
use Zend\Mvc\Controller\PluginManager;

class HelperController extends AbstractActionController{

    public function userGroupModel(){
        return $this->getServiceLocator()->get('Admin\Model\GroupUser');
    }

    public function postCategoryModel(){
        return $this->getServiceLocator()->get('Admin\Model\postCategory');
    }

    public function productCategoryModel(){
        return $this->getServiceLocator()->get('Admin\Model\productCategory');
    }

    public function getUserGroup(){
        $groups = $this->userGroupModel()->getItems()->toArray();
        $listGroup = array();
        foreach($groups as $key => $item){
            $listGroup[$item['id']] = $item['name'];
        }
        return $listGroup;
    }

    public function getPostCategory(){
        $groups = $this->postCategoryModel()->getItems()->toArray();
        $listGroup = array();
        foreach($groups as $key => $item){
            $listGroup[$item['id']] = $item['name'];
        }
        return $listGroup;
    }

    public function getProductCategory(){
        $groups = $this->productCategoryModel()->getItems()->toArray();
        $listGroup = array();
        foreach($groups as $key => $item){
            $listGroup[$item['id']] = $item['name'];
        }
        return $listGroup;
    }


    // danh sach category co phan cap
    public function selectPostCategoryLevel(){
        $groups = $this->postCategoryModel()->getItems(array('order'=>'left ASC'))->toArray();
        $root_cat_id =  $this->postCategoryModel()->getOneItem(array('where'=>array('left'=>0)))->toArray()[0]['id'];
        $listGroup = array();
        $listGroup[$root_cat_id] = 'None';
        foreach($groups as $key => $item){
            if($item['level'] != 0){
                $listGroup[$item['id']] = str_repeat('-',$item['level']-1).' '. $item['name'];
            }

        }
        return $listGroup;
    }

    // danh sach category product co phan cap
    public function selectProductCategoryLevel(){
        $groups = $this->productCategoryModel()->getItems(array('order'=>'left ASC'))->toArray();
        $root_cat_id =  $this->productCategoryModel()->getOneItem(array('where'=>array('left'=>0)))->toArray()[0]['id'];
        $listGroup = array();
        $listGroup[$root_cat_id] = 'None';
        foreach($groups as $key => $item){
            if($item['level'] != 0){
                $listGroup[$item['id']] = str_repeat('-',$item['level']-1).' '. $item['name'];
            }

        }
        return $listGroup;
    }



}