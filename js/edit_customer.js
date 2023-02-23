$(document).ready(function(){
//Edit Customer Validation.
$("#edit_Customers").submit(function(){

    var ecus_fname = $("#ecus_fname").val();
    var ecus_lname = $("#ecus_lname").val();
    var ecus_mob =   $("#ecus_mob").val();
    var ecus_email = $("#ecus_email").val();
    var ecus_nic = $("#ecus_nic").val();
    var ecus_house_no = $("#ecus_house_no").val();
    var ecus_street = $("#ecus_street").val();
    var ecus_city = $("#ecus_city").val();

    if(ecus_fname==""){
        $("#alertDiv2").html("Customer firstname Cannot be Empty!!!");
        $("#alertDiv2").addClass("alert alert-danger");
        $("#alertDiv2").show();
        setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 5000);
        $("#ecus_fname").focus();
        return false;
    }
    if(ecus_lname==""){
        $("#alertDiv2").html("Customer lastname Cannot be Empty!!!");
        $("#alertDiv2").addClass("alert alert-danger");
        $("#alertDiv2").show();
        setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 5000);
        $("#ecus_lname").focus();
        return false;
    }
    if(ecus_mob==""){
        $("#alertDiv2").html("Mobile Number Cannot be Empty!!!");
        $("#alertDiv2").addClass("alert alert-danger");
        $("#alertDiv2").show();
        setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 5000);
        $("#ecus_mob").focus();
        return false;
    }
    if(ecus_nic==""){
        $("#alertDiv2").html("Customer Nic Cannot be Empty!!!");
        $("#alertDiv2").addClass("alert alert-danger");
        $("#alertDiv2").show();
        setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 5000);
        $("#ecus_nic").focus();
        return false;
    }
    if(ecus_house_no==""){
        $("#alertDiv2").html("House No. Cannot be Empty!!!");
        $("#alertDiv2").addClass("alert alert-danger");
        $("#alertDiv2").show();
        setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 5000);
        $("#ecus_house_no").focus();
        return false;
    }
    if(ecus_street==""){
        $("#alertDiv2").html("Street Cannot be Empty!!!");
        $("#alertDiv2").addClass("alert alert-danger");
        $("#alertDiv2").show();
        setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 5000);
        $("#ecus_street").focus();
        return false;
    }
    if(ecus_city==""){
        $("#alertDiv2").html("City Cannot be Empty!!!");
        $("#alertDiv2").addClass("alert alert-danger");
        $("#alertDiv2").show();
        setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 5000);
        $("#ecus_city").focus();
        return false;
    }
    var patecus_mob=/^\+947[0-9]{8}$/;
    var patecus_nic=/^([0-9]{9}[vVxX]|[0-9]{12})$/;
    var patecus_email=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/;


    if(!ecus_mob.match(patecus_mob))
    {
        $("#alertDiv2").html("Mobile Number is Invalid");
        $("#alertDiv2").addClass("alert alert-danger");
        $("#alertDiv2").show();
        setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 5000);
        $("#ecus_mob").focus();
        return false;
    }

    if(!ecus_email.match(patecus_email))
    {
        $("#alertDiv2").html("Email is Invalid");
        $("#alertDiv2").addClass("alert alert-danger");
        $("#alertDiv2").show();
        setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 5000);
        $("#ecus_email").focus();
        return false;

    }
    if(!ecus_nic.match(patecus_nic))
    {
        $("#alertDiv2").html("NIC is Invalid");
        $("#alertDiv2").addClass("alert alert-danger");
        $("#alertDiv2").show();
        setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 5000);
        $("#ecus_nic").focus();
        return false;
    }

});

});