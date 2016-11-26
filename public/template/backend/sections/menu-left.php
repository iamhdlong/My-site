<?php
 $arrMenu = array(
     array('name'=>'' ,'class'=>'', 'icon'=>'', 'link'=>''),
 );
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
                <a href="<?php echo $this->url('adminRoute') ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>

            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i> <span>User</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->url('admin-group-user') ?>"><i class="fa fa-circle-o"></i> Group user</a></li>
                    <li><a href="<?php echo $this->url('admin-user') ?>"><i class="fa fa-circle-o"></i>Users</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i> <span>Post</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->url('admin-post-category') ?>"><i class="fa fa-circle-o"></i> Category</a></li>
                    <li><a href="<?php echo $this->url('admin-post') ?>"><i class="fa fa-circle-o"></i>Posts</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i> <span>Product</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->url('admin-product-category') ?>"><i class="fa fa-circle-o"></i>Product Category</a></li>
                    <li><a href="<?php echo $this->url('admin-product') ?>"><i class="fa fa-circle-o"></i>Producs</a></li>
                </ul>
            </li>



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>