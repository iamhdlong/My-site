<?php
/**
 * Created by PhpStorm.
 * User: long
 */
namespace Admin\Form\GroupUserForm;
use \Zend\Form\Form as Form;
use Zend\Form\Element as Element;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

class GroupUserForm extends Form {



    public function __construct($name = null){
        parent::__construct();

        // FORM Attribute
        $this->setAttributes(array(
            'action'	=> '',
            'method'	=> 'POST',
            'class'		=> 'form-horizontal',
            'name'		=> 'add-form',
        ));

        $this->add(array(
            'name'			=> 'id',
            'type'			=> 'Hidden',
        ));

        // Email
        $this->add(array(
            'name'			=> 'name',
            'type'			=> 'Text',
            'attributes'	=> array(
                'class'			=> 'form-control',
                'placeholder'	=> 'Name',
            ),

        ));

//        $this->add(array(
//            'name'			=> 'status',
//            'type'			=> 'Radio',
//            'options'	=> array(
//                'value_options'			=> array(
//                    '1'	=> 'Publish',
//                    '0'	=> 'UnPublish',
//                ),
//                'label_attributes' => array (
//                    'class' => 'form-radio',
//                ),
//            ),
//            'attributes'	=> array(
//                'style'			=> 'margin-right:10px',
//            ),
//        ));

        $this->add(array(
            'name'			=> 'status',
            'type'			=> 'Select',
            'options'		=> array(
                'value_options'	=> array(
                    '1'	=> 'Publish',
                    '0'	=> 'UnPublish',
                ),
            ),

        ));
        $this->setInputFilter(new \Admin\Form\GroupUserForm\Filter());

    }
    
    public function showMessage(){
        $messages = $this->getMessages();

        $ms = '<div class="alert alert-danger alert-dismissible ">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-ban"></i> ';
        foreach($messages as $field => $message){
            $ms .= current($message);
        }
          $ms    .= '</div>';
        return $ms;

    }


}