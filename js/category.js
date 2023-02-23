$(document).ready(function () {

    $("#p_catid").change(function () {
        var url = "../controller/categorycontroller.php?status=getCatSubcategories";
        var x = $("#p_catid").val();
        $.post(url, {cat_id: x}, function (data) {
            $("#subcatdiv").html(data).show();
        });
    });
    var table = $('#example').DataTable( {
        lengthMenu:[
            [5,10,25,50,100,-1],
            [5,10,25,50,100,"All"]
        ]
    } );

    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-5:eq(0)' );
    var url = window.location.href;//old url.
    var spliturl = url.split('?')[0];// Divide the old url on the question mark.
    var newSpliturl = spliturl.split('localhost')[1];//Divide the new url on the localhost mark
    window.history.pushState({},document.title,""+ newSpliturl);
    var table1 = $('#example_1').DataTable( {
        lengthMenu:[
            [5,10,25,50,100,-1],
            [5,10,25,50,100,"All"]
        ]
    } );

    table1.buttons().container()
        .appendTo( '#example_wrapper .col-md-5:eq(0)' );
    var url = window.location.href;//old url.
    var spliturl = url.split('?')[0];// Divide the old url on the question mark.
    var newSpliturl = spliturl.split('localhost')[1];//Divide the new url on the localhost mark
    window.history.pushState({},document.title,""+ newSpliturl);

    $("#addCategory").submit(function(){
        var cat_name = $("#cat_name").val();
        var cat_code = $("#cat_code").val();

        if(cat_name==""){
            $("#alertDiv1").html("Category name Cannot be Empty!!!");
            $("#alertDiv1").addClass("alert alert-danger");
            $("#alertDiv1").show();
            setTimeout(function () {$("#alertDiv1").slideUp(500, function () {$("#alertDiv1").hide();});}, 8000);
            $("#cat_name").focus();
            return false;
        }
        if(cat_code==""){
            $("#alertDiv1").html("Category code Cannot be Empty!!!");
            $("#alertDiv1").addClass("alert alert-danger");
            $("#alertDiv1").show();
            setTimeout(function () {$("#alertDiv1").slideUp(500, function () {$("#alertDiv1").hide();});}, 8000);
            $("#cat_code").focus();
            return false;
        }

        var num= /^[0-9]+$/;
        if(!cat_code.match(num))
        {
            $("#alertDiv1").html("Only numeric numbers are allowed!!");
            $("#alertDiv1").addClass("alert alert-danger");
            $("#alertDiv1").show();
            setTimeout(function () {$("#alertDiv1").slideUp(500, function () {$("#alertDiv1").hide();});}, 8000);
            $("#cat_code").focus();
            return false;
        }
    });
    $("#addSubcategory").submit(function(){
        var sub_cat_name = $("#sub_cat_name").val();

        if(sub_cat_name==""){
            $("#alertDiv3").html("Subcategory name Cannot be Empty!!!");
            $("#alertDiv3").addClass("alert alert-danger");
            $("#alertDiv3").show();
            setTimeout(function () {$("#alertDiv3").slideUp(500, function () {$("#alertDiv3").hide();});}, 8000);
            $("#sub_cat_name").focus();
            return false;
        }
    });
    $("#editCategory").submit(function(){
        var ecat_name = $("#ecat_name").val();
        var ecat_code = $("#ecat_code").val();

        if(ecat_name==""){
            $("#alertDiv2").html("Category name Cannot be Empty!!!");
            $("#alertDiv2").addClass("alert alert-danger");
            $("#alertDiv2").show();
            setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 8000);
            $("#ecat_name").focus();
            return false;
        }
        if(ecat_code==""){
            $("#alertDiv2").html("Category code Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv2").show();
            setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 8000);
            $("#ecat_code").focus();
            return false;
        }

        var num= /^[0-9]+$/;
        if(!ecat_code.match(num))
        {
            $("#alertDiv2").html("Only numeric numbers are allowed!!");
            $("#alertDiv2").addClass("alert alert-danger");
            $("#alertDiv2").show();
            setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 8000);
            $("#ecat_code").focus();
            return false;
        }
    });
    $("#editSubcategory").submit(function(){
        var esub_cat_name = $("#esub_cat_name").val();

        if(esub_cat_name==""){
            $("#alertDiv4").html("Subcategory name Cannot be Empty!!!");
            $("#alertDiv4").addClass("alert alert-danger");
            $("#alertDiv4").show();
            setTimeout(function () {$("#alertDiv4").slideUp(500, function () {$("#alertDiv4").hide();});}, 8000);
            $("#esub_cat_name").focus();
            return false;
        }
    });
});

function loadCategory(x)
{
    var url = "../controller/categorycontroller.php?status=edit_category";
    $.post(url, {cat_id: x}, function (data) {
        $("#categoryCont").html(data).show();
    });
}
function loadSubCat(x)
{
    var url = "../controller/categorycontroller.php?status=edit_subcategory";
    $.post(url, {sub_cat_id: x}, function (data) {
        $("#subcategoryCont").html(data).show();
    });
}
$(function() {
    $("#msg").show();
    setTimeout(function () {$("#msg").slideUp(500, function () {$("#msg").hide();});}, 8000);
});

$(function() {
    $("#error").show();
    setTimeout(function () {$("#error").slideUp(500, function () {$("#error").hide();});}, 8000);
});
    