$(document).ready(function (){

    $("#rproduct_id").keyup(function(){
        var rproduct_id = $("#rproduct_id").val();
        if(rproduct_id != null && rproduct_id != '')
        {
            var url="../controller/purchasecontroller.php?status=search_receiving";

            $.post(url,{rproduct_id:rproduct_id},function(data)
            {
                $('#rproductList').fadeIn();
                $('#rproductList').html(data);
            });
        }
    });
    $(document).on('click', 'li', function(){
        $('#rproduct_id').val($(this).text());//get product name
        $('#product_id').val($(this).attr("value"));//get product id
        $('#rproductList').fadeOut();

    });

});

















