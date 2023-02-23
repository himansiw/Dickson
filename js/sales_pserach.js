$(document).ready(function (){

    $("#saleproduct_id").keyup(function(){
        var saleproduct_id = $("#saleproduct_id").val();
        if(saleproduct_id != null && saleproduct_id != '')
        {
            var url="../controller/salescontroller.php?status=add_sale";

            $.post(url,{saleproduct_id:saleproduct_id},function(data)
            {
                $('#sproductList').fadeIn();
                $('#sproductList').html(data);
            });
        }
    });
    $(document).on('click', 'li', function(){

        $('#saleproduct_id').val($(this).text());
        //Get the  this product id
        var productid=$(this).val();


        var url="../controller/salescontroller.php?status=get_dis";

        $.post(url,{productid:productid},function(data){
            $('#sdiscount').val(data[0])
            $('#sale_rprice').val(data[1])
            $('#productid').val(data[2]);



        },"json");
        $('#sproductList').fadeOut();

    });

});















