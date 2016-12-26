<?php
namespace Core\Model;

use Zend\Cache\Storage\Event;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\EventManager\EventInterface;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Where;
use Zend\Validator\GreaterThan;


class Model extends AbstractTableGateway {
    public $tableGateway;
    public $table = '';


    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway	= $tableGateway;
    }

    public function getItems($arrParam=array(), $type=null){

        $select = new Select($this->table);
        if(!empty($arrParam['where']) && is_array($arrParam['where'])){
            $select->where($arrParam['where']);
        }

        if(!empty($arrParam['order'])){
            $select->order($arrParam['order']);
        }

        if($type == 'one-item'){
            $select->limit(1);
        }

        $result	= $this->tableGateway->selectWith($select);
        //echo $select->getSqlString();
        return $result;
    }

    public function getOneItem($arrParam=array()){
        return $this->getItems($arrParam, 'one-item');
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


    public function update($data=array(),$where=array()){
        $result = $this->tableGateway->update($data,$where);
        return $result;
    }


    public function insert($data=array()){
        if($data){
            $data['created'] = date('Y-m-d H:i:s');
            $this->tableGateway->insert($data);
            $id = $this->tableGateway->lastInsertValue;
            return $id;
        }

    }


}