<?php
/**
 * Created by PhpStorm.
 * User: long
 */
namespace Admin\Form\UserForm;
use \Zend\Form\Form as Form;
use Zend\Form\Element as Element;
use Core\Form\CoreForm;

use  Core\Controller\HelperController;
use Zend\ServiceManager\ServiceManager;

class UserForm extends CoreForm {



    public function __construct(HelperController $helper, ServiceManager $sm){
        parent::__construct();
         $id = $sm->get('application')->getMvcEvent()->getRouteMatch()->getParam('id');
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

        $this->add(array(
            'name'			=> 'email',
            'type'			=> 'Text',
            'attributes'	=> array(
                'class'			=> 'form-control',
                'placeholder'	=> 'Email',
            ),

        ));

        $this->add(array(
            'name'			=> 'address',
            'type'			=> 'Text',
            'attributes'	=> array(
                'class'			=> 'form-control',
                'placeholder'	=> 'Address',
            ),

        ));

        $this->add(array(
            'name'			=> 'password',
            'type'			=> 'Password',
            'attributes'	=> array(
                'class'			=> 'form-control',
                'placeholder'	=> 'Password',
            ),

        ));



            $this->add(array(
                'name'			=> 'group',
                'type'			=> 'Select',
                'options'		=> array(
                    'value_options'	=> $helper->getUserGroup(),
                ),

            ));

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
        $this->setInputFilter(new \Admin\Form\UserForm\Filter(array('id'=>$id)));

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