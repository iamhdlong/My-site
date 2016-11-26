<?php
namespace Core\ViewHelper;
use Zend\Form\Element\Select;
use Zend\Form\View\Helper\FormSelect;

class FilterStatusElement extends FormSelect{

    public function __invoke($type,$valueSelected){
        $select= new Select($type);
        $select->setAttributes(array('class'=>'form-control input-sm filter-status-cms'));
        $select->setEmptyOption('--All--');
        $select->setValueOptions(array('0'=>'Inactive','1'=>'Active'));
        $select->setValue($valueSelected);
        return $this->render($select);
    }
}

