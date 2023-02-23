$(document).ready(function (){

    $("#scus_id").keyup(function(){
        var scus_id = $("#scus_id").val();
        if(scus_id != null && scus_id != '')
        {
            var url="../controller/salescontroller.php?status=get_customer";

            $.post(url,{scus_id:scus_id},function(data)
            {
                $('#customersList').fadeIn();
                $('#customersList').html(data);
            });
        }
    });
    $(document).on('click','a',function(){
        $('#scus_id').val($(this).text());

        $('#cusid').val($(this).attr("value"));
        $('#sale_cardno').val($(this).attr("value1"));
        $('#apoint').val($(this).attr("value2"));
        $('#customersList').fadeOut();
    });

});