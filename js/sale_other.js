<!--Disable The readonly in Redeem Point text-->
    function enableText() {
    var r_point = document.getElementById('r_point');
    r_point.readOnly = false;
    r_point.style.display = 'block';
}

    $('#invoice').click(function(){
    var invoice_no = $("#invoice_no").val();
    var id = $("#id").val();
    $.ajax({
    url:'../controller/salescontroller.php?status=add_pay',
    method: 'POST',
    data: $( "form" ).serialize(),
    success:(function(xhr){
    window.swal({
    title: "Data successfully Added!!",
    icon: "../images/logo/invoice.png",
    text: "Do You Want To Print Invoice?,Click Here!!!",
    showConfirmButton: true,
    allowOutsideClick: false,
    timer: 2500
   }).then(function() {
    var nw=window.open("../view/customer-invoice.php?invoice_no="+invoice_no ,"_blank");
    // nw.print()
    setTimeout(function(){
    //nw.close()
    location.reload()
    },20000)

    })
    //using setTimeout to simulate ajax request
    setTimeout(() => {
    window.swal({
    title: "Finished!",
    icon: "success",
    showConfirmButton: false,
    timer: 1000
    });
    }, 2000);
    })
    })
})

    setTimeout(function () {

    // Closing the alert
    $('.alert').alert('close');
}, 3000);

    function changeFunc() {
    var selectBox = document.getElementById("selectBox");
    var rselectedValue = selectBox.options[selectBox.selectedIndex].value;
    if (rselectedValue=="2"){
    $('#cc').hide();
    $('#ch_no').hide();
    $('#card_no').show();
    $('#holder_name').show();
    $('#card_type').show();
    $('#month').show();
    $('#year').show();
    $('#pin').show();

}
    else if (rselectedValue=="3"){
    $('#card_no').hide();
    $('#holder_name').hide();
    $('#card_type').hide();
    $('#month').hide();
    $('#year').hide();
    $('#pin').hide();
    $('#cc').show();
    $('#ch_no').show();
}
    else {
    $('#card_no').hide();
    $('#holder_name').hide();
    $('#card_type').hide();
    $('#month').hide();
    $('#year').hide();
    $('#pin').hide();
    $('#cc').hide();
    $('#ch_no').hide();
}
}
    $(function() {
    $("#msg").show();
    setTimeout(function () {$("#msg").slideUp(500, function () {$("#msg").hide();});}, 8000);
    });

    $(function() {
    $("#error").show();
    setTimeout(function () {$("#error").slideUp(500, function () {$("#error").hide();});}, 8000);
    });
