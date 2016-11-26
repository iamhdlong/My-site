<?php
namespace Admin\Controller;

use Core\Controller\CoreAdminController;

class GroupUserController extends CoreAdminController{

    public $model = 'Admin\Model\GroupUser';
    public $form = 'Admin\Form\GroupUserForm';
    public $route = 'admin-group-user';

    public function init(){

    }

}