$(document).ready(function (){
    //Calculate the Purchase price
    $("#pqty,#purchaseorder_price").keyup(function(){
        var pqty = parseFloat($("#pqty").val());
        var purchaseorder_price = parseFloat($("#purchaseorder_price").val());
        if((pqty != null && pqty != "" ) && (purchaseorder_price  != null && purchaseorder_price  != "" ) ){
            var result = pqty * purchaseorder_price;
            $("#ppurchase_price_amount").val(result.toFixed(2));
        } else {
            $("#ppurchase_price_amount").val("");
        }
    });
    //Click the add list button then load the information in the table
    $("#add_plist").click(function(){

        var purproduct_id = $("#purproduct_id").val();
        var pqty = +$("#pqty").val();
        var purchaseorder_price = parseFloat($("#purchaseorder_price").val());
        var ppurchase_price_amount = parseFloat($("#ppurchase_price_amount").val());
        var ptotal = parseFloat($("#ptotal").val());

        if(purproduct_id=="")
        {
            $("#alertDiv").html("Product Name Cannot be Empty!!!").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#purproduct_id").focus();
            return false;
        }
        if(pqty=="")
        {
            $("#alertDiv").html("Qty Cannot be Empty!!!").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#pqty").focus();
            return false;
        }
        if(isNaN(purchaseorder_price)==true)
        {
            $("#alertDiv").html("Purchase Price Cannot be Empty!!!").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#purchaseorder_price").focus();
            return false;
        }

        var row="<tr>";
        row += "<td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='"+purproduct_id+"' name='purproduct_id[]' /></td>";
        row += "<td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='"+pqty.toFixed(3)+"' name='pqty[]'/></td>";
        row += "<td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='"+purchaseorder_price.toFixed(2)+"' name='purchaseorder_price[]'/></td>";
        row += "<td><input type='text' class='form-control subtotal' readonly='readonly' style='background-color: white' value='"+ppurchase_price_amount.toFixed(2)+"' name='ppurchase_price_amount[]'/></td>";
        row += "<td><button href='javascript:void(0)' style='background-color: white; border: none;outline: none'><span class='text-danger remove' arial-hidden='true'> &cross;</span></button></td>";
        row+="</tr>";
        $("#ppurchase_price_amount").each(function() {
            ptotal = ppurchase_price_amount + ptotal;
            $( "#ptotal" ).val( ptotal.toFixed( 2 ) );

        })
        $('#purchase').append(row);

        $("#purproduct_id").val("");
        $("#pqty").val("");
        $("#purchaseorder_price").val("");
        $("#ppurchase_price_amount").val("");

    });
    $("#purchase").on("click",".remove",function () {
        swal({
            title: "Are you sure?",
            text: "You need to remove this item completely!!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Yes, delete it!", {
                        icon: "success",
                    });
                    var subtotal = +$(this).parents("tr").find('.subtotal').val();
                    var ptotal = +$("#ptotal").val();
                    ptotal -= subtotal;
                    $("#ptotal").val(ptotal.toFixed(2));
                    $(this).parents("tr").remove();
                } else {
                    swal("Canceled "," You do not need to delete this item !!!");
                }
            });
    });

    $("#submit").on("click",function (){
        var purchaseref_no=$("#purchaseref_no").val();
        var pusup_id=$("#pusup_id").val();
        var psupplier_email=$("#psupplier_email").val();
        var message=$("#message").val();

        if(purchaseref_no=="")
        {
            $("#alertDiv").html("Reference Number Cannot be Empty!!!").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#purchaseref_no").focus();
            return false;
        }
        if(pusup_id=="")
        {
            $("#alertDiv").html("Supplier Cannot be Empty!!!").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#pusup_id").focus();
            return false;
        }
        if(psupplier_email=="")
        {
            $("#alertDiv").html("Supplier email Cannot be Empty!!!").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#psupplier_email").focus();
            return false;
        }
        if(message=="")
        {
            $("#alertDiv").html("Message Cannot be Empty!!!").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
            $("#message").focus();
            return false;
        }
    });

});
