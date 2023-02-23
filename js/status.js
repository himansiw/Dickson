$(document).ready(function (){

    $("#statusid").keyup(function(){
        var statusid= $("#statusid").val();
        if(statusid != null && statusid != '')
        {
            var url="../controller/purchasecontroller.php?status=search_status";

            $.post(url,{statusid_id:statusid},function(data)
            {
                $('#tatusid').fadeIn();
                $('#tatusid').html(data);
            });
        }
    });
    $(document).on('click', 'li', function(){
        $('#rproduct_id').val($(this).text());//get product name
        $('#product_id').val($(this).attr("value"));//get product id
        $('#rproductList').fadeOut();

    });

});

















