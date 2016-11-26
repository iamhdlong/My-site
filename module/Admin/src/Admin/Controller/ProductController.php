<?php
namespace Admin\Controller;

use Core\Controller\CoreAdminController;

class ProductController extends CoreAdminController{

    public $model = 'Admin\Model\Product';
    public $form = 'Admin\Form\ProductForm';
    public $route = 'admin-product';

    public function init(){

    }

}