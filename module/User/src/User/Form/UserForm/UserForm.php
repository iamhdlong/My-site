<?php
/**
 * Created by PhpStorm.
 * User: long
 */
namespace User\Form\UserForm;
use Zend\Form\Element as Element;
use Core\Form\CoreForm;
use Zend\ServiceManager\ServiceManager;

class UserForm extends CoreForm {



    public function __construct(ServiceManager $sm){
        parent::__construct();
         $id = $sm->get('application')->getMvcEvent()->getRouteMatch()->getParam('id');
        // FORM Attribute
        $this->setAttributes(array(
            'action'	=> '',
            'method'	=> 'POST',
            'class'		=> 'form-horizontal',
            'id'		=> 'register-form',
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
            'name'			=> 'password',
            'type'			=> 'Password',
            'attributes'	=> array(
                'class'			=> 'form-control',
                'placeholder'	=> 'Password',
            ),

        ));

        $this->setInputFilter(new \User\Form\UserForm\Filter(array('id'=>$id)));

    }
    
    public function showMessage(){
        $messages = $this->getMessages();


        $ms = '<p class="message-error">';
        foreach($messages as $field => $message){
            $ms .= current($message).'<br>';
        }
          $ms    .= '</p>';
        return $ms;

    }


}