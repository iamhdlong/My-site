<?php
namespace Core\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zendlib\Validator\StringLength;
use Zend\Session\Container;
use Zend\Mvc\Controller\PluginManager;
use Zend\EventManager\EventManager;

class CoreAdminController extends AbstractActionController{

    public $model = '';
    public $form = '';
    public $route ='';

    public function setPluginManager(PluginManager $plugins){
        parent::setPluginManager($plugins);
       $this->init();
    }

    public function init(){

    }


    public function getModel(){
       // echo $this->model;die;
        return $this->getServiceLocator()->get($this->model);
    }

    public function getForm(){
        return $this->getServiceLocator()->get($this->form);
    }


    public function indexAction(){

        $model = $this->getModel();

        /*
          * TODO: General
          * change status
          */
        if($this->getRequest()->isXmlHttpRequest()){
            $this->changeStatusAjax($model);
            return $this->response;
        }
        if($this->getRequest()->isPost()){
            $idCheck = $this->params()->fromPost('idcheck');
            $type = $this->params()->fromPost('action_type');
            if($idCheck && in_array($type,array('publish','unpublish'))){
                $update = $model->changeMultiStatus($idCheck,$type);
                if($update){
                    $this->flashMessenger()->addMessage('Change status success');
                }
            }else{
                // order (index page)
                $this->filterOrder();
            }
            return $this->redirect()->toRoute($this->route);
        }
        // end change status


        //Set order
        $ssOrder	= new Container(__NAMESPACE__);
        $orderBy =  $ssOrder->offsetExists('order_by') ? $ssOrder->offsetGet('order_by') : NULL;
        $order =  $ssOrder->offsetExists('order') ? $ssOrder->offsetGet('order') : NULL;
        $status =  $ssOrder->offsetExists('status') ? $ssOrder->offsetGet('status') : NULL;
        $searchType =  $ssOrder->offsetExists('filter_search_type') ? $ssOrder->offsetGet('filter_search_type') : NULL;
        $searchValue =  $ssOrder->offsetExists('filter_search_value') ? $ssOrder->offsetGet('filter_search_value') : NULL;
        $dataOrdeFilter = array(
            'orderBy' => trim($orderBy),
            'order' => trim($order),
            'status' => trim($status),
            'searchType' => trim($searchType),
            'searchValue' => trim($searchValue),
        );
        // end

        //TODO: get items and paginator
        $currentPageNum = $this->params()->fromQuery('page') ? $this->params()->fromQuery('page')  : 1;
        $items = $model->getItemsPagi($currentPageNum, $dataOrdeFilter);
        $totalItems = $this->getModel()->countItems($dataOrdeFilter);
        $paginator = $this->Paginator($totalItems);
        ## end
        return new ViewModel(array(
            'items' => $items,
            'paginator' => $paginator,
            'dataOrderFilter' => $dataOrdeFilter,
            'indexRoute' => $this->route

        ));
    }


    /*
     * TODO: General
     * change status ajax
     */
    public function changeStatusAjax($model){
        $id = $this->params()->fromQuery('id');
        $curStatus = $this->params()->fromQuery('curStatus');
        if($id){
            if($curStatus==0){
                $update = $model->update(array('status'=>1), array('id'=>$id));
                if($update) $result['status'] = 'on';
            }
            elseif($curStatus==1){
                $update = $model->update(array('status'=>0), array('id'=>$id));
                if($update) $result['status'] = 'off';
            }
        }
        echo json_encode($result);
    }

    /*
     * TODO: General
     */
    //order when click <th>
    public function filterOrder(){
        $request = $this->getRequest();
            $order_by = $request->getPost('order_by','id');
            $order = $request->getPost('order','desc');
            $status = $request->getPost('status') ;
            $searchType = $request->getPost('filter_search_type');
            $searchValue = $request->getPost('filter_search_value');
            $indexRoute = $request->getPost('index_route');


            $ssOrder	= new Container(__NAMESPACE__);
            $ssOrder->offsetSet('order_by', $order_by);
            $ssOrder->offsetSet('order', $order);
            $ssOrder->offsetSet('status', $status);
            $ssOrder->offsetSet('filter_search_type', $searchType);
            $ssOrder->offsetSet('filter_search_value', $searchValue);
            if($request->getPost('clear_filter')=='clear'){
                $ssOrder->getManager()->getStorage()->clear(__NAMESPACE__);
            }

            return $this->redirect()->toRoute($indexRoute);

    }

    /*
     * TODO: General
     */
    public function addAction(){
        $form = $this->getForm();
        $model = $this->getModel();
        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $form->getData();
                $data['created'] = date('Y-m-d H:i:s');
                $id = $model->insertItem($data);
                if($id){
                    $this->flashMessenger()->addMessage('Add success');
                    return $this->redirect()->toRoute($this->route,array('action'=>'edit','id'=>$id));
                }
            }else{
                $error = $form->showMessage();
            }
        }

        return new ViewModel(array(
            'form'=>$form,
            'error' => $error
        ));
    }

    /*
     * TODO: General
     */
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
                $update = $model->update($data,array('id'=>$id));
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



    /*
     * TODO: General
     */
    public function deleteItemsAction(){
        $idCheck = $this->params()->fromPost('idcheck');
        $type = $this->params()->fromPost('action_type');
        $model = $this->getModel();
        if($idCheck && in_array($type,array('delete'))){
            $model->deleteItems($idCheck,$type);
            $this->flashMessenger()->addMessage('Delete success');
        }
        return $this->redirect()->toRoute($this->route);
    }



}