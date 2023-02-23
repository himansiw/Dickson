$(document).ready(function(){


    naviagetopage=function (x)
    {

        var txt=$("#searchtext").val();

        var url="../controller/employeecontroller.php?status=paginate";


        $.post(url,{page:x,txt:txt},function(data){
            $("#empcont").html(data).show();
        });
    }



});
