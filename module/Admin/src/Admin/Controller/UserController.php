<?php
namespace Admin\Controller;

use Core\Controller\CoreAdminController;
use Zend\View\Model\ViewModel;

class UserController extends CoreAdminController{

    public $model = 'Admin\Model\User';
    public $form = 'Admin\Form\UserForm';
    public $route = 'admin-user';

    public function init(){

    }

    public function loginAction(){

        $viewModel = new ViewModel();
    }

}