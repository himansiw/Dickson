$(document).ready(function (){

    $("#pusup_id").keyup(function(){
        var pusup_id = $("#pusup_id").val();
        if(pusup_id != null && pusup_id != '')
        {
            var url="../controller/purchasecontroller.php?status=get_suppliername";

            $.post(url,{pusup_id:pusup_id},function(data)
            {
                $('#suppliersList').fadeIn();
                $('#suppliersList').html(data);
            });
        }
    });
    $(document).on('click','a',function(){
        $('#pusup_id').val($(this).text());
        $('#psupplier_email').val($(this).attr("value"));
        $('#sup_id').val($(this).attr("value2"));
        $('#suppliersList').fadeOut();
    });

});