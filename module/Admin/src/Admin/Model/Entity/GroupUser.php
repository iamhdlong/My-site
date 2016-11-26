<?php
namespace Admin\Model\Entity;

class GroupUser {

    public $id;
    public $name;
    public $status;
    public $order;
    public $created;
    public $created_by;
    public $modified;
    public $modified_by;

    public function exchangeArray($data){
        $this->id			= (!empty($data['id'])) ? $data['id'] : null;
        $this->name			= (!empty($data['name'])) ? $data['name'] : null;
        $this->status		= (!empty($data['status'])) ? $data['status'] : 0;
        $this->order		= (!empty($data['order'])) ? $data['order'] : 0;
        $this->created		= (!empty($data['created'])) ? $data['created'] : null;
        $this->created_by	= (!empty($data['created_by'])) ? $data['created_by'] : null;
        $this->modified		= (!empty($data['modified'])) ? $data['modified'] : null;
        $this->modified_by	= (!empty($data['modified_by'])) ? $data['modified_by'] : null;
    }

    public function getArrayCopy(){
        $result = get_object_vars($this);
//        $result['status']	= ($result['status'] == 1) ? 'active' : 'inactive';
        return $result;
    }

}