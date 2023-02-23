$(document).ready(function (){
    $("#rqty,#rpurchase_price").keyup(function(){
        var rqty = parseFloat($("#rqty").val());
        var rpurchase_price = parseFloat($("#rpurchase_price").val());
        if((rqty != null && rqty != "" ) && (rpurchase_price  != null && rpurchase_price  != "" ) ){
            var result = rqty * rpurchase_price;
            $("#purchase_price_amount").val(result.toFixed(2));
        } else {
            $("#purchase_price_amount").val("");
        }
    });
    // Calculate the Regullar price value
    $("#rdis").keyup(function(){
        var rdis = +($("#rdis").val());
        var rpurchase_price = parseFloat($("#rpurchase_price").val());
        if((rdis != null && rdis != "" ) && (rpurchase_price  != null && rpurchase_price  != "" ) ){
            var result = (rpurchase_price*rdis)/100;
            result1 =rpurchase_price + result;
            $("#regullar_price").val(result1.toFixed(2));
        } else {
            $("#regullar_price").val("");
        }
    });

    $("#add_list").click(function(){
        var rproduct_id = $("#rproduct_id").val();
        //var product_name = $("#rproduct_id option:selected").text();
        var rqty = +$("#rqty").val();
        var rpurchase_price = parseFloat($("#rpurchase_price").val());
        var purchase_price_amount = parseFloat($("#purchase_price_amount").val());
        var rdis = +$("#rdis").val();
        var regullar_price = parseFloat($("#regullar_price").val());
        var rm_date = $("#rm_date").val();
        var rexp_date = $("#rexp_date").val();
        var total = parseFloat($("#total").val());
        var gtotal = parseFloat($("#gtotal").val());

        if(rproduct_id=="")
        {
            $("#alertDiv").html("Product Name Cannot be Empty!!!").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#rproduct_id").focus();
            return false;
        }
        if(rqty=="")
        {
            $("#alertDiv").html("Qty Cannot be Empty!!!").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#rqty").focus();
            return false;
        }
        if(rpurchase_price=="")
        {
            $("#alertDiv").html("Purchase Price Cannot be Empty!!!").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#rpurchase_price").focus();
            return false;
        }
        if(isNaN(rpurchase_price)==true)
        {
            $("#alertDiv").html("Purchase Price Can only use numeric value!!!").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#rpurchase_price").focus();
            return false;
        }
        // if(isNaN(rdis)==true) {
        //     $("#alertDiv").html("Profit data entered was not numeric!!").addClass("alert alert-danger");
        //     $("#rdis").focus();
        //     return false;
        // }



        var row="<tr>";
        // row += "<td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='"+product_name+"' name='pName[]' /><input type='hidden' value='"+rproduct_id+"' name='product_id[]'/></td>";
        row += "<td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='"+rproduct_id+"' name='rproduct_id[]' /></td>";
        row += "<td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='"+rqty.toFixed(3)+"' name='rqty[]'/></td>";
        row += "<td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='"+rpurchase_price.toFixed(2)+"' name='rpurchase_price[]'/><input type='hidden' value='"+rdis+"' name='rdis[]'/></td>";
        row += "<td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='"+regullar_price.toFixed(2)+"' name='regullar_price[]'/></td>";
        row += "<td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='"+rm_date+"' name='rm_date[]'/></td>";
        row += "<td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='"+rexp_date+"' name='rexp_date[]'/></td>";
        row += "<td><input type='text' class='form-control subtotal' readonly='readonly' style='background-color: white' value='"+purchase_price_amount.toFixed(2)+"' name='purchase_price_amount'/></td>";
        row += "<td><a href='javascript:void(0)'><span class='text-danger remove' arial-hidden='true'> &cross;</span></a></td>";

        total= purchase_price_amount+total;
        $("#total").val(total.toFixed(2));
        row+="</tr>";
        $("#gtotal").val(total.toFixed(2));

        $('#receive').append(row);

        $("#rproduct_id").val("");
        $("#rqty").val("");
        $("#rpurchase_price").val("");
        $("#purchase_price_amount").val("");
        $("#rdis").val("");
        $("#regullar_price").val("");
        $("#rm_date").val("");
        $("#rexp_date").val("");

    });
    $("#receive").on("click",".remove",function () {
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
                    var total = +$("#total").val();
                    total -= subtotal;
                    $("#total").val(total.toFixed(2));
                    $(this).parents("tr").remove();
                    $("#gtotal").val(total.toFixed(2));
                } else {
                    swal("Canceled "," You do not need to delete this item !!!");
                }
            });

    });

    //Get Due price.
    $("#rpaid").keyup(function(){
        var rpaid = parseFloat($("#rpaid").val());
        var gtotal = parseFloat($("#gtotal").val());
        if((rpaid != null && rpaid != "" ) && (gtotal  != null && gtotal  != "" ) ){
            var result = gtotal -rpaid ;
            $("#rdue").val(result.toFixed(2));
        } else {
            $("#rdue").val("");
        }
    });

    //  $('#rproduct_id').on('change',function(){
    //     $("#rqty").val('');
    //     $("#rpurchase_price").val("");
    //     $("#purchase_price_amount").val("");
    //     $("#rdis").val("");
    //     $("#regullar_price").val("");
    //     $("#rm_date").val("");
    //     $("#rexp_date").val("");
    //
    // })
});