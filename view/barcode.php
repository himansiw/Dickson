<html>
<head>
<style>
p.inline {display: inline-block;}
span { font-size: 12px ; text-align:center;}
</style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */

    }
</style>
</head>
<body onload="window.print();">
	<div style="margin-left: 5%; padding: 5px 5px">
		<?php
		include 'barcode128.php';
		include '../model/product_model.php';
		$productObj=new Product();
		$product_id = $_POST['product_id'];
		$productResult=$productObj->getAllProduct($product_id);
		$bpid=$productResult->fetch_assoc();
		$barcode_id = $_POST['barcode_id'];
		$sale_price = $_POST['sale_price'];

		for($i=1;$i<=$_POST['print_qty'];$i++){
			echo "<p class='inline'><span><b>Dickson Food City</b></span><br/><span>".$bpid["product_name"]."</span>".bar128(stripcslashes($_POST['barcode_id']))."<span ><b>Price:Rs. ".$sale_price." </b></span></p>&nbsp&nbsp&nbsp&nbsp";
		}

		?>
	</div>
</body>
</html>