$(document).ready(function(){
    $("#addCustomers").submit(function(){
        var cus_fname = $("#cus_fname").val();
        var cus_lname = $("#cus_lname").val();
        var cus_mob = $("#cus_mob").val();
        var cus_email = $("#cus_email").val();
        var cus_nic = $("#cus_nic").val();
        var cus_house_no = $("#cus_house_no").val();
        var cus_street = $("#cus_street").val();
        var cus_city = $("#cus_city").val();

        if(cus_fname==""){
            $("#alertDiv").html("Customer firstname Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#cus_fname").focus();
            return false;
        }
        if(cus_lname==""){
            $("#alertDiv").html("Customer lastname Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#cus_lname").focus();
            return false;
        }
        if(cus_mob=="")
        {
            $("#alertDiv").html("Mobile Number Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#cus_mob").focus();
            return false;
        }
        if(cus_nic=="")
        {
            $("#alertDiv").html("NIC Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#cus_nic").focus();
            return false;
        }
        if(cus_house_no=="")
        {
            $("#alertDiv").html("House no. Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#cus_house_no").focus();
            return false;
        }
        if(cus_street=="")
        {
            $("#alertDiv").html("Street Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#cus_street").focus();
            return false;
        }
        if(cus_city=="")
        {
            $("#alertDiv").html("City Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#cus_city").focus();
            return false;
        }
        var patcus_mob=/^\+947[0-9]{8}$/;
        var patcus_nic=/^([0-9]{9}[vVxX]|[0-9]{12})$/;
        var patcus_email=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/;


        if(!cus_mob.match(patcus_mob))
        {
            $("#alertDiv").html("Mobile Number is Invalid");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#cus_mob").focus();
            return false;
        }

        if(!cus_email.match(patcus_email))
        {
            $("#alertDiv").html("Email is Invalid");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#cus_email").focus();
            return false;

        }
        if(!cus_nic.match(patcus_nic))
        {
            $("#alertDiv").html("NIC is Invalid");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#cus_nic").focus();
            return false;
        }

    });

});