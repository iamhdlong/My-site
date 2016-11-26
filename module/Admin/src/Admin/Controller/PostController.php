<?php
namespace Admin\Controller;

use Core\Controller\CoreAdminController;

class PostController extends CoreAdminController{

    public $model = 'Admin\Model\Post';
    public $form = 'Admin\Form\PostForm';
    public $route = 'admin-post';

    public function init(){

    }

}