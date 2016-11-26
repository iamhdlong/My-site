<?php
namespace Admin\Form\ProductCategoryForm;

use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\InputFilter\InputFilter;

class Filter extends InputFilter {

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

    }
}