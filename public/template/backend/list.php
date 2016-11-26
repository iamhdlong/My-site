<?php
/**
 * Created by PhpStorm.
 * User: DangLongHo
 */
?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<?php include "sections/breadcrumb.php"; ?>
<section class="content">

    <!--======== Alert =========-->
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
        Success alert preview. This alert is dismissable.
    </div>
    <!--======== Alert =========-->

    <!--======== Button =========-->
    <div class="box-body">
        <a class="btn btn-app"> <i class="fa fa-plus-square-o"></i> Add </a>
        <a class="btn btn-app"> <i class="fa fa-arrow-circle-o-up"></i> Publish </a>
        <a class="btn btn-app"> <i class="fa fa-arrow-circle-o-down"></i> Unpublish </a>
        <a class="btn btn-app"> <i class="fa  fa-minus-square-o"></i> Delete </a>
    </div>
    <!--======== Button =========-->

    <!--======== Table =========-->
    <div class="box">

        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="dataTables_length" id="example1_length">
                            <label>Show
                                <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="example1_filter" class="dataTables_filter">
                            <label>Search:
                                <input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table-hover table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <td> <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button> </td>

                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 179px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Rendering engine</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 228px;" aria-label="Browser: activate to sort column ascending">Browser</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 194px;" aria-label="Platform(s): activate to sort column ascending">Platform(s)</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 154px;" aria-label="Engine version: activate to sort column ascending">Engine version</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 112px;" aria-label="CSS grade: activate to sort column ascending">CSS grade</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 112px;" aria-label="CSS grade: activate to sort column ascending">Status</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr role="row" class="odd">
                                <td><input type="checkbox"></td>
                                <td class="sorting_1">Gecko</td>
                                <td>Firefox 1.0</td>
                                <td>Win 98+ / OSX.2+</td>
                                <td>1.7</td>
                                <td>A</td>
                                <td><label class="label label-default"><i class="fa fa-check"></i></label></td>
                            </tr><tr role="row" class="even">
                                <td><input type="checkbox"></td>
                                <td class="sorting_1">Gecko</td>
                                <td>Firefox 1.5</td>
                                <td>Win 98+ / OSX.2+</td>
                                <td>1.8</td>
                                <td>A</td>
                                <td><label class="label label-default"><i class="fa fa-check"></i></label></td>
                            </tr>
                            <tr role="row" class="odd">
                                <td><input type="checkbox"></td>
                                <td class="sorting_1">Gecko</td>
                                <td>Firefox 2.0</td>
                                <td>Win 98+ / OSX.2+</td>
                                <td>1.8</td>
                                <td>A</td>
                                <td><label class="label label-success "><i class="fa fa-check"></i></label></td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td> <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button> </td>
                                <th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th>
                                <th rowspan="1" colspan="1">Platform(s)</th>
                                <th rowspan="1" colspan="1">Engine version</th>
                                <th rowspan="1" colspan="1">CSS grade</th>
                            </tr>

                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            <ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous">
                                    <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a>
                                </li>
                                <li class="paginate_button active">
                                    <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a>
                                </li>
                                <li class="paginate_button ">
                                    <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a>
                                </li>
                                <li class="paginate_button ">
                                    <a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a>
                                </li>

                                <li class="paginate_button next" id="example1_next">
                                    <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
    </div>
    <!--======== Table =========-->


</section><!-- /.content -->
</div><!-- /.content-wrapper -->

