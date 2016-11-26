var DevApp = DevApp || {};
DevApp.multiCheckbox = function(){
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
    $(".checkbox-toggle").click(function () {
        var clicks = $(this).data('clicks');
        if (clicks) {
            //Uncheck all checkboxes
            $("input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
        } else {
            //Check all checkboxes
            $("input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
        }
        $(this).data("clicks", !clicks);
    });
};

// change order via <th> in list page
DevApp.changeOrder = function(field, order){
    $('.index-cms-form input[name=order_by]').val(field);
    $('.index-cms-form input[name=order]').val(order);
    if(field && order){
        $('.index-cms-form').submit();
    }

};


DevApp.filterStatusSubmit = function(){
    $('.filter-status-cms').change(function(){
        $('.index-cms-form').submit();
    });
};

//change status ajax
DevApp.changeStatus = function(thiss){
    var e = thiss;
  var id = $(e).attr('id');
  var curStatus = $(e).attr('curstatus');

    if(id && curStatus){
        $.ajax({
            url:window.location.pathname,
            type:'GET',
            data:{id: id, curStatus: curStatus},
            beforeSend:function(){
            },
            success:function(res){
                var data = $.parseJSON(res);
                var newStatus = data.status;
                if(newStatus=='off'){
                    $(e).html('No');
                    $(e).removeClass('onbg').addClass('offbg');
                    $(e).attr('curstatus',0);
                }
                else if(newStatus=='on'){
                    $(e).html('Yes');
                    $(e).removeClass('offbg').addClass('onbg');
                    $(e).attr('curstatus',1);
                }
            },
            error:function()
            {

            }
        });


    }
};

//change multi status
DevApp.submitRequest = function(type, linkAction){
    if(type){
        $('input[name=action_type]').val(type);
        if(linkAction){
            $('.index-cms-form').attr('action',linkAction);
        }
        $('form').submit();
    }

};

$(document).ready(function () {
    DevApp.multiCheckbox();
    DevApp.filterStatusSubmit();
    $('form input[type="checkbox"], form input[type="radio"]').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
});
