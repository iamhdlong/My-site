<?php
/**
 * Created by PhpStorm.
 * User: DangLongHo
 */
$controller = array(
    'index' => 'Dashboard',
    'GroupUser' => 'GroupUser',
    'User' => 'User',
    'PostCategory' => 'Post Category',
    'Post' => 'Post',
    'ProductCategory' => 'Product Category',
    'Product' => 'Product',
);
$action = array(
    'index' => 'List',
    'add' => 'Add',
    'edit' => 'Edit',
);
$dataHeader = $this->arrDataHeader;
$controllerAlias = $controller[$dataHeader['controller']]; // parent
$actionAlias = $action[$dataHeader['action']]; // child
//header
$header = sprintf('<h1>%s<small>%s</small></h1>',$controllerAlias,$actionAlias);

//breadcrumb
if($dataHeader['controller'] != 'index'){
    if($dataHeader['action'] == 'index'){
        $breacrumb = sprintf('<li>%s</li><li class="active">%s</li>',
            $controllerAlias,
            $actionAlias
            );
    }else{
        $breacrumb = sprintf('<li><a href="%s">%s</a></li><li class="active">%s</li>',
            $this->url('adminRoute/default',array('controller'=>$dataHeader['controller'],'action'=>'index')),
            $controllerAlias,
            $actionAlias
        );
    }
}
?>
<section class="content-header">
    <?=$header?>
    <ol class="breadcrumb">
        <li><a href="<?= $this->url('adminRoute') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<!--        <li class="active">Dashboard</li>-->
        <?=$breacrumb?>
    </ol>
</section>
