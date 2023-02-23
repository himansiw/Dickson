$(document).ready(function (){

// Calculate the sub price amount
    $("#sqty").keyup(function(){
        var sqty = parseFloat($("#sqty").val());
        var sale_rprice = parseFloat($("#sale_rprice").val());
        var sdiscount = parseFloat($("#sdiscount").val())
        //Check the qty and subprice empty or not
        if((sqty != null && sqty != "" ) && (sale_rprice  != null && sale_rprice != "" )){
            var result = sqty * sale_rprice;
           var result2 = result-sdiscount;
            $("#subprice_amount").val(result2.toFixed(2));
        } else {
            $("#subprice_amount").val("");
        }
    });
// Calculate the Net Total value
    $("#distotal").keyup(function(){
        var distotal= +($("#distotal").val());
        var stotal = parseFloat($("#stotal").val());
        if((distotal != null && distotal != "" ) && (stotal  != null && stotal != "" ) ){
            var result = (stotal*distotal)/100;
            result = stotal-result;
            $("#netotal").val(result.toFixed(2));
        } else {
            $("#netotal").val("");
        }
    });
    var productarry=[];
    //Click the add button then load the information in the table
    $("#add_slist").click(function(){

        var saleproduct_id = $("#saleproduct_id").val();
        var productid = $("#productid").val();
        var sqty = parseFloat($("#sqty").val());
        var sdiscount = parseFloat($("#sdiscount").val());
        var sale_rprice = parseFloat($("#sale_rprice").val());
        var subprice_amount = parseFloat($("#subprice_amount").val());
        var stotal = parseFloat($("#stotal").val());
        var distotal= +($("#distotal").val());
        var netotal = parseFloat($("#netotal").val());
        var c_point = parseFloat($("#c_point").val());


        if(saleproduct_id=="")
        {
            $("#alertDiv").html("Product Name Cannot be Empty!!!").addClass("alert alert-danger");
            $("#saleproduct_id").focus();
            return false;
        }
        if(sqty=="")
        {
            $("#alertDiv").html("Qty Cannot be Empty!!!").addClass("alert alert-danger");
            $("#sqty").focus();
            return false;
        }
        if(isNaN(sale_rprice)==true)
        {
            $("#alertDiv").html("Regular Price Cannot be Empty!!!").addClass("alert alert-danger");
            $("#sale_rprice").focus();
            return false;
        }

        // if(productarry.includes(productid)){
        //     for(var x=0; x<productarry.length;x++){
        //         if(productarry[x]==productid){
        //            var qty=+$("input[key=qty]").eq(x).val();
        //             $("input[key=qty]").eq(x).val(qty+1);
        //             var sub=+$("input[key=sub]").eq(x).val();
        //             $("input[key=sub]").eq(x).val(sub+sub);
        //             var stotal = parseFloat($("#stotal").val());
        //             $("#stotal").eq(x).val(stotal+stotal)
        //             var netotal = parseFloat($("#netotal").val());
        //             $("#netotal").eq(x).val(netotal+netotal);
        //         }
        //     }
        //
        // }else {
            var row = "<tr>";
            row += "<td><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='" + saleproduct_id + "' name='saleproduct_id[]' /><input type='hidden' value='" + productid + "' name='productid[]'/></td>";
            row += "<td><input type='text' key='qty' class='form-control' readonly='readonly' style='background-color: white' value='" + sqty.toFixed( 3 ) + "' name='sqty[]'/></td>";
            row += "<td><div class='input-group'><span class='input-group-addon'>Rs</span><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='" + sale_rprice.toFixed( 2 ) + "' name='sale_rprice[]'/></div></td>";
            row += "<td><div class='input-group'><span class='input-group-addon'>Rs</span><input type='text' class='form-control' readonly='readonly' style='background-color: white' value='" + sdiscount.toFixed( 2 ) + "' name='sdiscount[]'/></div></td>";
            row += "<td><div class='input-group'><span class='input-group-addon'>Rs</span><input type='text' key='sub' class='form-control subtotal' readonly='readonly' style='background-color: white' value='" + subprice_amount.toFixed( 2 ) + "' name='subprice_amount[]'/></div></td>";
            row += "<td><button type='button' data-href='javascript:void(0)' style='background-color: white; border: none;outline: none' ><span class='text-danger remove' arial-hidden='true'> &cross;</span></button></td>";
            row += "</tr>";
            $( "#subprice_amount" ).each( function () {
                stotal = subprice_amount + stotal;
                $( "#stotal" ).val( stotal.toFixed( 2 ) );

            } )
            var result1 = (stotal * distotal) / 100;
            result1 = stotal - result1;
            $( "#netotal" ).val( result1.toFixed( 2 ) );


            $( '#sale' ).append( row );


            $( "#productid" ).val( "" );
            $( "#saleproduct_id" ).val( "" );
            $( "#sqty" ).val( "" );
            $( "#sdiscount" ).val( "" );
            $( "#sale_rprice" ).val( "" );
            $( "#subprice_amount" ).val( "" );
        // }
    });
    $("#sale").on("click",".remove",function () {
        // var conf = confirm("Do You Really Want To Remove This Item!!");
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
                    var stotal = +$("#stotal").val();
                    stotal -= subtotal;
                    $("#stotal").val(stotal.toFixed(2));
                    var distotal= +($("#distotal").val());
                    var netotal = parseFloat($("#netotal").val());
                    var result = (stotal*distotal)/100;
                    netotal = stotal-result;
                    $("#netotal").val(netotal.toFixed(2));
                    var c_point = parseFloat($("#c_point").val());
                    var result3 = netotal/100;
                    $("#c_point").val(result3.toFixed(2));
                    $(this).parents("tr").remove();
                } else {
                    swal("Canceled "," You do not need to delete this item !!!");
                }
            });
    });

    //Click the pay button.
    $("#mod").click(function(){
        var stotal = parseFloat($("#stotal").val());
        var distotal= +($("#distotal").val());
        var netotal = parseFloat($("#netotal").val());
        var r_value = parseFloat($("#r_value").val());
        var ntotal = parseFloat($("#ntotal").val());
        var result2 = (stotal*distotal)/100;
        result2 = stotal- result2;
        var result7 = result2 - r_value;
        $("#ntotal").val(result7.toFixed(2));
    });
    //Get Due price.
    $("#paid").keyup(function(){
        var paid = parseFloat($("#paid").val());
        var ntotal = parseFloat($("#ntotal").val());
        if((paid != null && paid != "" ) && (ntotal  != null && ntotal  != "" ) ){
            var result = paid - ntotal;
            $("#due").val(result.toFixed(2));
        } else {
            $("#due").val("");
        }
    });


    //Click the use loyalty yes check button
    $("#yes").click(function(){
        if($(this).is(':checked') && $('#loyalty_added').val() == 0) {
        var netotal = parseFloat($("#netotal").val());
        var c_point = parseFloat($("#c_point").val());
        var result3 = netotal/100;
        $("#c_point").val(result3.toFixed(2));
        var apoint = parseFloat($("#apoint").val());
        var result4 = (netotal/100)+apoint;
        $("#apoint").val(result4.toFixed(2));
        var current_points = result4.toFixed(2);
        if(current_points < 100) {
            $("#r_point").attr('readonly', 'readonly');//when the points greater than 100 then remove the readonly
        }
            $('#loyalty_added').val(1);
        }
        if($(this).prop('checked') == false && $('#loyalty_added').val() == 1)
        {
            var apoint = parseFloat($("#apoint").val());
            var c_point = parseFloat($("#c_point").val());
            var result3 = apoint-c_point
            $("#apoint").val(result3.toFixed(2));
            $('#loyalty_added').val(0);
        }



    });
    $("#r_point").keyup(function(){
        var r_point = parseFloat($("#r_point").val());
        var apoint = parseFloat($("#apoint").val());
        if(( r_point != null &&  r_point != "" ) && (apoint  != null && apoint  != "" ) ){
            var result5 = apoint - r_point;
            $("#apoint").val(result5.toFixed(2));
        } else {
            $("#apoint").val("");
        }
        var result6 = r_point * 1;
        $("#r_value").val(result6.toFixed(2));

    });
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-5:eq(0)' );
    var url = window.location.href;//old url.
    var spliturl = url.split('?')[0];// Divide the old url on the question mark.
    var newSpliturl = spliturl.split('localhost')[1];//Divide the new url on the localhost mark
    window.history.pushState({},document.title,""+ newSpliturl);

});