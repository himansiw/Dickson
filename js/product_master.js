$(document).ready(function(){
    $("#addDepartment").submit(function(){
        var department_name = $("#department_name").val();

        if(department_name==""){
            $("#alertDiv").html("Department name Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#department_name").focus();
            return false;
        }
    });

    $("#editDepartment").submit(function(){
        var department_name = $("#department_name").val();

        if(department_name==""){
            $("#alertDiv2").html("Department name Cannot be Empty!!!");
            $("#alertDiv2").addClass("alert alert-danger");
            $("#alertDiv2").show();
            setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 8000);
            $("#department_name").focus();
            return false;
        }
    });


});