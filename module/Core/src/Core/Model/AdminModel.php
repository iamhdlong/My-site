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


class AdminModel extends AbstractTableGateway {
    public $tableGateway;
    public $itemCountPerPage	= ITEM_COUNT_PER_PAGE;
    public $table = '';


    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway	= $tableGateway;
    }

    public function getItemsPagi($currentPageNum,$dataOrdeFilter=array()){
        $select = new Select($this->table);
        //$select->columns(array( 'id', 'name', 'status', 'order', 'created', 'created_by'));
        $select->limit($this->itemCountPerPage);
        $select->offset(($currentPageNum - 1) * $this->itemCountPerPage);

        $eventManager	= new \Zend\EventManager\EventManager();

        $eventManager->attach('beforeListModel', array($this,'beforeListModel'));
        $eventManager->trigger('beforeListModel', $this, $select);


        $orderBy = $dataOrdeFilter['orderBy'];
        $order = $dataOrdeFilter['order'];
        if($orderBy && $order){
            $select->order(array($orderBy . ' ' . strtoupper($order)));
        }else{
            $select->order(array('id DESC'));
        }

        $status = $dataOrdeFilter['status'];
        if( strlen($status) > 0 ){
            $select->where->equalTo('status',$status);
        }

        $searchType = $dataOrdeFilter['searchType'];
        $searchValue = $dataOrdeFilter['searchValue'];
        if($searchType && $searchValue){
            $select->where->like($searchType,'%'.$searchValue.'%');
        }

        $result = $this->tableGateway->selectWith($select);
        //echo $select->getSqlString();

        return $result->toArray();
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

    //TODO: action Category
    //chia nhanh category
    public function insertRight($data,$cat_id=''){

        $select = new Select($this->table);
        $get_items = $this->getItems()->current();

        $table_empty = empty($get_items) ? true : false;

        $parent_cat_inf = $this->getCatInfo($cat_id);

        //update left
        $data_left = array('left'=>new Expression('`left`+2'));
        $where_left = new Where();
        $where_left ->GreaterThan('left',$parent_cat_inf['right']);
        $this->tableGateway->update($data_left,$where_left);

        //update right
        $data_right = array('right'=>new Expression('`right`+2'));
        $where_right = new Where();
        $where_right->greaterThanOrEqualTo('right',$parent_cat_inf['right']);
        $this->tableGateway->update($data_right,$where_right);

        //insert new category
        if($table_empty) $parent_cat_inf['right'] = 0;
        $data['left'] = $parent_cat_inf['right'] ;
        $data['right'] = $parent_cat_inf['right'] + 1 ;
        $data['level'] = $parent_cat_inf['level'] + 1 ;
        $this->tableGateway->insert($data);


    }


    // Di chuyen category (tach nhanh + di chuyen)
    //## Tach nhanh
    public function detachCate($cate_move_id){
        $select = new Select($this->table);
        $cate_move_inf = $this->getCatInfo($cate_move_id);

        // so luong cate tren nhanh can di chuyen
        $total_cate = ($cate_move_inf['right'] - $cate_move_inf['left'] + 1) / 2;


        //update cac cate tren nhanh di chuyen
        $where = new Where();
        $where->between('left',$cate_move_inf['left'],$cate_move_inf['right']);
        $data = array(
            'left'=>new Expression("`left`-{$cate_move_inf['left']}"),
            'right'=>new Expression('`right`-?',array($cate_move_inf['right']))
        );
        $this->tableGateway->update($data,$where);


        //update field left cac cate khac
        $data_left = array('left'=>new Expression("`left`-{$total_cate}*2"));
        $where_left = new Where();
        $where_left ->GreaterThan('left',$cate_move_inf['right']);
        $this->tableGateway->update($data_left,$where_left);

        //update field right cac cate khac
        $data_right = array('right'=>new Expression("`right`-{$total_cate}*2"));
        $where_right = new Where();
        $where_right->greaterThanOrEqualTo('right',$cate_move_inf['right']);
        $this->tableGateway->update($data_right,$where_right);


        return $total_cate;
    }

    //## Di chuyen nhanh
    public function moveRight($cate_move_id, $parent_cate_id, $total_cate){
        $select = new Select($this->table);
        $parent_cate_inf = $this->getCatInfo($parent_cate_id);
        $cate_move_inf = $this->getCatInfo($cate_move_id);

        //update field left cac cate khac
        $data_left = array('left'=>new Expression("`left`+?", array($total_cate*2)));
        $where_left = new Where();
        $where_left ->GreaterThan('left',$parent_cate_inf['right']);
        $where_left ->GreaterThan('right',0);
        $this->tableGateway->update($data_left,$where_left);

        //update field right cac cate khac
        $data_right = array('right'=>new Expression("`right` + ?",array($total_cate*2)));
        $where_right = new Where();
        $where_right ->greaterThanOrEqualTo('right',$parent_cate_inf['right']);
        $this->tableGateway->update($data_right,$where_right);

        //update level cate di chuyen
        $data_level = array('level'=>new Expression("`level`- ? + ? + 1", array($cate_move_inf['level'],$parent_cate_inf['level'])));
        $where_level = new Where();
        $where_level ->lessThanOrEqualTo('right',0);
        $this->tableGateway->update($data_level,$where_level);

        //update cac cate tren nhanh di chuyen
        $where = new Where();
        $where->lessThanOrEqualTo('right',0);

        $data_left = array('left'=>new Expression("`left` + ?",array($parent_cate_inf['right'])));
        $this->tableGateway->update($data_left,$where);

        $data_right = array('right'=>new Expression("`right`+ ?", array($parent_cate_inf['right'] + $total_cate * 2 - 1)));
        $this->tableGateway->update($data_right,$where);

        //update parent id cate di chuyen
        $this->tableGateway->update(array('parent'=>$parent_cate_inf['id']),array('id'=>$cate_move_id));


    }

    //## Tach + Di chuyen
    public function moveRightCate($cate_move_id, $parent_cate_id){
        $total_cate = $this->detachCate($cate_move_id);
        $this->moveRight($cate_move_id, $parent_cate_id, $total_cate);
    }

    public function getCatInfo($cat_id){
        $select = new Select($this->table);
        $select->where(array(
            'id'=>$cat_id
        ));
        $result	= $this->tableGateway->selectWith($select)->toArray();
        $result = $result[0];
        return $result;
    }

    public function updateInfoCate($cate_move_id, $parent_cate_id, $data=array()){
        if(!empty($data)){
            $parent_cate_inf = $this->getCatInfo($parent_cate_id);
            if(!empty($parent_cate_inf)){
                $cate_inf = $this->getCatInfo($cate_move_id);
                if($cate_inf['parent'] != $parent_cate_id){
                    $this->moveRightCate($cate_move_id, $parent_cate_id);
                }
            }
            $update = $this->tableGateway->update($data,array('id'=>$cate_move_id));
            return $update;
        }

    }

    public function getListCate(){
        $select = new Select($this->table);
        $select->order('left ASC');
        $result	= $this->tableGateway->selectWith($select)->toArray();
        return $result;
    }

    public function getChildCate($cate_id){
        $select = new Select($this->table);
        $select->where(array('parent'=>$cate_id));
        $select->order('left ASC');
        $result	= $this->tableGateway->selectWith($select)->toArray();
        return $result;
    }


    public function removeCate($cate_id){

        if(is_array($cate_id)){ // xoa cate ngoai page index
            foreach($cate_id as $value){
                $cat_inf = $this->getCatInfo($value);
                $child_cat = $this->getChildCate($value);
                // move child cate
                if(!empty($child_cat)){
                    foreach($child_cat as $child_cat_inf){
                        $this->moveRightCate($child_cat_inf['id'],$cat_inf['parent']);
                    }
                }
                // xoa cate da chon
                $this->tableGateway->delete(array('id'=>$cate_id));

            }
        }


    }
    //TODO: action Category

    // Event manager
    public function beforeListModel(){

    }

}