$(document).ready(function(){   
    $("#addProduct").submit(function(){
        var p_code = $("#p_code").val();
        var p_name = $("#p_name").val();
        var pbid = $("#pbid").val();
        var pdid = $("#pdid").val();
        var p_catid = $("#p_catid").val();
        var sub_cat = $("#sub_cat").val();
        var p_barcode = $("#p_barcode").val();
        var p_unit = $("#p_unit").val();
        var product_img = $("#product_img").val();
        var ppurchase_price = $("#ppurchase_price").val();
        var pdis = $("#pdis").val();
        
        if(p_code==""){
          $("#alertDiv").html("SKU Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#p_code").focus();          
          return false;
        }
        if(p_name==""){
          $("#alertDiv").html("Product name Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#p_name").focus();          
          return false;
        }
        if(pbid=="")
        {
            $("#alertDiv").html("Brand Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#pbid").focus();
            return false;
        }
        if(pdid=="")
        {
            $("#alertDiv").html("Department Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#pdid").focus();
            return false;
        }
         if(p_catid=="")
        {
            $("#alertDiv").html("Category Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#cat_id").focus();
            return false;
        }
        if(sub_cat=="")
        {
            $("#alertDiv").html("Sub category Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#sub_cat").focus();
            return false;
        }
         if(p_barcode=="")
        {
            $("#alertDiv").html("Barcode Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#p_barcode").focus();
            return false;
        }
         if(p_unit=="")
        {
            $("#alertDiv").html("Unit Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#p_unit").focus();
            return false;
        }
        if(ppurchase_price=="")
      {
            $("#alertDiv").html("Default Regular unit price be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 6000);
            $("#ppurchase_price").focus();
            return false;
        }
        if(pdis=="")
        {
            $("#alertDiv").html("Default O/Price Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#pdis").focus();
            return false;
        }
        var patp_code=/^\DS[0-9]{4}$/;
        if(!p_code.match(patp_code))
        {
          $("#alertDiv").html("SKU is Invalid");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#p_code").focus();
          return false;
        }
        var pdis = parseFloat(str);
        if (isNaN(pdis) || pdis < 0 || pdis > 100)
        {
            // alert("value is out of range");
            $("#alertDiv").html("pdis is out of range");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#pdis").focus();
            return false;
        }
        else
        {
            var decimalSeparator=".";
            var val=""+pdis;
            if(val.indexOf(decimalSeparator)<val.length-3)
            {
                //alert("too much decimal");
                $("#alertDiv").html("Too much decimal");
                $("#alertDiv").addClass("alert alert-danger");
                $("#alertDiv").show();
                setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
                $("#pdis").focus();
                return false
            }
        }



        //Check the product image jpg/jpeg/png or not
        var idxDot = product_img.lastIndexOf(".") + 1;
        var extFile = product_img.substr(idxDot, product_img.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            //TO DO
        }else{
            $("#alertDiv").html("Only jpg/jpeg and png files are allowed!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show()|
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#product_img").focus();
            return false;
        }
        
   });
    
});