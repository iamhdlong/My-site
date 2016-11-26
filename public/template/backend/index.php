<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <link rel="stylesheet" href="css/_all-skins.min.css">
    <link rel="stylesheet" href="css/datepicker3.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="css/blue0.css">

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php
include "sections/header.php";
?>

<?php
 //include "dashboard.php";
include "list.php";
?>

<?php
include "sections/menu-left.php";
include "sections/footer.php";

?>



</div>
<script src="js/jQuery-2.1.4.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/bootstrap3-wysihtml5.all.min.js"></script>
<script src="js/fastclick.min.js"></script>
<script src="js/app.min.js"></script>
<!--<script src="js/pages/dashboard.js"></script>-->
<script src="js/icheck.min.js"></script>
<script src="js/demo.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var totalItems	= 0;

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        //When unchecking the checkbox
        $("#check-all").on('ifUnchecked', function(event) {
            //Uncheck all checkboxes
            $("input[type='checkbox']").iCheck("uncheck");
        });

        //When checking the checkbox
        $("#check-all").on('ifChecked', function(event) {
            //Check all checkboxes
            $("input[type='checkbox']").iCheck("check");
        });

    });
</script>


</body>
</html>