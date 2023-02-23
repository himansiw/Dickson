$(document).ready(function (){

    $("#purproduct_id").keyup(function(){
        var purproduct_id = $("#purproduct_id").val();
        if(purproduct_id != null && purproduct_id != '')
        {
            var url="../controller/purchasecontroller.php?status=add_purchase";

            $.post(url,{purproduct_id:purproduct_id},function(data)
            {
                $('#productList').fadeIn();
                $('#productList').html(data);
            });
        }
    });
    $(document).on('click', 'li', function(){
        $('#purproduct_id').val($(this).text());
        $('#purchaseorder_price').val($(this).attr("value"));
        $('#productList').fadeOut();

    });

});















    // $(document).on('click', 'li', function(){
    //     $('#purproduct_id').val($(this).text());
    //     var purproduct_id = $("#purproduct_id").val();
    //     if(purproduct_id !="")
    //     {
    //         var url="../controller/purchasecontroller.php?status=get_price";
    //         $.post(url, {purproduct_id: purproduct_id}, function (data) {
    //             $("#purchaseorder_price").html(data).show();
    //         });
    //     }
    //
    //     $('#productList').fadeOut();
    // });



