<?php
namespace Admin\Model;

use Core\Model\AdminModel;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\EventManager\Event;
use Zend\Validator\GreaterThan;

class ProductCategory extends AdminModel {

    //public $tableGateway;
    //public $itemCountPerPage	= 2;
    public $table = 'b_product_category';

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway	= $tableGateway;
    }



    public function getItemById($id='',$asObject=false){

        if($asObject){ // via entity
            $result	= $this->tableGateway->select(function (Select $select) use ($id){
                $select->where->equalTo('id', $id);
            })->current();

        }else{
            $select = new Select($this->table);
            $select->where(array(
                'id'=>$id
            ));
            $result	= $this->tableGateway->selectWith($select)->toArray();
            $result = $result[0];
        }
        return $result;
    }

    public function countItems($dataOrdeFilter=array()){
        $select = $this->tableGateway->select(function(Select $select) use($dataOrdeFilter){
            $status = $dataOrdeFilter['status'];
            if(strlen($status) > 0 ){
                $select->where->equalTo('status',$status);
            }
        });
        return $select->count();
    }


    public function update($data=array(),$where=array()){
       $result = $this->tableGateway->update($data,$where);
        return $result;
    }

    public function changeMultiStatus($id=array(),$type=''){


        if($type=='publish'){
            $data = array('status'=>1);
        }elseif($type=='unpublish'){
            $data = array('status'=>0);
        }
        $idStr = implode(',',$id);
        $where = 'id IN ('.$idStr.')' ;

        $result = $this->tableGateway->update($data,$where);
        return $result;
    }

    public function deleteItems($ids=array(),$type=''){
        if($ids && $type='delete'){
            foreach($ids as $key => $id){
                 $this->tableGateway->delete(array('id'=>$id));
            }
        }
    }

    public function insertItem($data=array()){
        if($data){
            $data['created'] = date('Y-m-d H:i:s');
//            $this->tableGateway->insert($data);
            if($data['parent']){
                $data['parent'] = $data['parent'];
            }else{
               $root_cate = $this->tableGateway->select(function (Select $select){
                    $select->where->equalTo('left', 0);
                })->current();
                $data['parent'] = $root_cate['id'];
            }
            $this->insertRight($data,$data['parent']);
            $id = $this->tableGateway->lastInsertValue;
            return $id;
        }

    }



    public function beforeListModel(Event $e){
        $select = $e->getParams();
        $select->order('left ASC');

    }

}