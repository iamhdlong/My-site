<?php
namespace Admin\Controller;

use Core\Controller\CoreAdminController;
use Zend\View\Model\ViewModel;

class ProductCategoryController extends CoreAdminController{

    public $model = 'Admin\Model\ProductCategory';
    public $form = 'Admin\Form\ProductCategoryForm';
    public $route = 'admin-product-category';

    public function init(){

    }

    public function editAction(){
        $form = $this->getForm();
        $model = $this->getModel();
        $id = $this->params('id');

        $item = $model->getItemById($id,true);
        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->SetData($data);
            if($form->isValid()){
                $data = $form->getData();
                $data['modified'] = date('Y-m-d H:i:s');
                $update = $model->updateInfoCate($id, $data['parent'], $data);
                if($update){
                    $this->flashMessenger()->addMessage('Save success');
                    return $this->redirect()->toRoute($this->route, array('action'=>'edit','id'=>$id));
                }
            }else{
                $error = $form->showMessage()  ;
            }
        }
        $form->bind($item);
        return new ViewModel(array(
            'form'=>$form,
            'error' => $error
        ));
    }

    public function deleteItemsAction(){
        $idCheck = $this->params()->fromPost('idcheck');
        $type = $this->params()->fromPost('action_type');
        $model = $this->getModel();
        //remove node
        if($idCheck && in_array($type,array('delete'))){
            $model->removeCate($idCheck,$type);
            $this->flashMessenger()->addMessage('Delete success');
        }
        return $this->redirect()->toRoute($this->route);
    }


}