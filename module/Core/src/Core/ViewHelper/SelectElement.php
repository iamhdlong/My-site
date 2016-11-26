<?php
namespace Core\ViewHelper;
use Zend\Form\Element\Select;
use Zend\Form\View\Helper\FormSelect;

class SelectElement extends FormSelect{

    public function __invoke($column ,$value=array(), $valueSelected, $emptyOption=false){
        $select= new Select($column);
        $select->setAttributes(array('class'=>'form-control input-sm '));
        $select->setValueOptions($value);
        $select->setValue($valueSelected);
        if($emptyOption){
            $select->setEmptyOption($emptyOption);
        }
        return $this->render($select);
    }
}

