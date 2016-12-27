<?php
namespace User\Form\LoginForm;

use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\InputFilter\InputFilter;

class LoginFilter extends InputFilter {

    public function __construct($data=array()){

        $this->add(array(
            'name'		=> 'name',
            'required'	=> true,
            'validators'	=> array(
                array(
                    'name'		=> 'NotEmpty',
                    'options'	=> array(
                        'messages'	=> array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Name: Not Empty'
                        )
                    ),
                    'break_chain_on_failure'	=> true
                ),
            )
        ));

        $this->add(array(
            'name'		=> 'email',
            'required'	=> true,
            'validators'	=> array(
                array(
                    'name'		=> 'NotEmpty',
                    'options'	=> array(
                        'messages'	=> array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Email: Not Empty'
                        )
                    ),
                    'break_chain_on_failure'	=> true
                ),
                array(
                    'name'		=> 'EmailAddress',
                    'options'	=> array(
                        'message'	=> 'Email: Wrong format'
                    ),
                    'break_chain_on_failure'	=> true
                ),
            )
        ));

        $this->add(array(
            'name'		=> 'password',
            'required'	=> true,
            'validators'	=> array(
                array(
                    'name'		=> 'NotEmpty',
                    'options'	=> array(
                        'messages'	=> array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Password: Not Empty'
                        )
                    ),
                    'break_chain_on_failure'	=> true
                ),
            )
        ));
    }
}