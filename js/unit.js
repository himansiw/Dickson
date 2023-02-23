$(document).ready(function () {

    var table = $('#example').DataTable( {
        buttons: [ 'copy','csv','print', 'excel', 'pdf' ],
        dom:
            "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row'<'col-md-5'i><'col-md-7'p>>",
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

    $("#addUnit").submit(function(){
        var uname = $("#uname").val();
        var shortname = $("#shortname").val();
        var decimal = $("#decimal").val();

        if(uname==""){
            $("#alertDiv1").html("Unit name Cannot be Empty!!!");
            $("#alertDiv1").addClass("alert alert-danger");
            $("#alertDiv1").show();
            setTimeout(function () {$("#alertDiv1").slideUp(500, function () {$("#alertDiv1").hide();});}, 8000);
            $("#uname").focus();
            return false;
        }
        if(shortname==""){
            $("#alertDiv1").html("Short name Cannot be Empty!!!");
            $("#alertDiv1").addClass("alert alert-danger");
            $("#alertDiv1").show();
            setTimeout(function () {$("#alertDiv1").slideUp(500, function () {$("#alertDiv1").hide();});}, 8000);
            $("#shortname").focus();
            return false;
        }

        if(decimal=="") {
            $("#alertDiv1").html("Allow decimal cannot be empty!!!");
            $("#alertDiv1").addClass("alert alert-danger");
            $("#alertDiv1").show();
            setTimeout(function () {$("#alertDiv1").slideUp(500, function () {$("#alertDiv1").hide();});}, 8000);
            $("#decimal").focus();
            return false;
        }
    });
    $("#editUnit").submit(function(){
        var eunit_name = $("#eunit_name").val();
        var eshort_name = $("#eshort_name").val();
        var eallow_decimal = $("#eallow_decimal").val();

        if(eunit_name==""){
            $("#alertDiv2").html("Unit name Cannot be Empty!!!");
            $("#alertDiv2").addClass("alert alert-danger");
            $("#alertDiv2").show();
            setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 8000);
            $("#eunit_name").focus();
            return false;
        }
        if(eshort_name==""){
            $("#alertDiv2").html("Short name Cannot be Empty!!!");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv2").show();
            setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 8000);
            $("#eshort_name").focus();
            return false;
        }

        if(eallow_decimal==""){
            $("#alertDiv2").html("Allow decimal cannot be empty!!!");
            $("#alertDiv2").addClass("alert alert-danger");
            $("#alertDiv2").show();
            setTimeout(function () {$("#alertDiv2").slideUp(500, function () {$("#alertDiv2").hide();});}, 8000);
            $("#eallow_decimal").focus();
            return false;
        }
    });
});
function loadUnit(x)
{
    var url = "../controller/unitcontroller.php?status=edit_unit";
    $.post(url, {unit_id: x}, function (data) {
        $("#unitCont").html(data).show();
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
