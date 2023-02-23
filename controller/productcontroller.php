<?php
include '../model/product_model.php';
$productObj = new Product();  ///  create product Object
if(!isset($_REQUEST["status"]))
{
    ?>
    <script> window.location="../index.php"</script>
    <?php
}
else{
    $status= $_REQUEST["status"];
    switch($status)
    {
        /**
         * Insert into product nto product table
         */
        case "add_product":
            echo $pcode = $_POST["pcode"];
            echo "<br/>";
            echo $product_name = $_POST["product_name"];
            echo "<br/>";
            echo $brand_id = $_POST["brand_id"];
            echo "<br/>";
            echo $department_id = $_POST["department_id"];
            echo "<br/>";
            echo $cat_id = $_POST["cat_id"];
            echo "<br/>";
            echo $sub_cat_id = $_POST["sub_cat_id"];
            echo "<br/>";
            echo $pbarcode = $_POST["pbarcode"];
            echo "<br/>";
            echo $unit_id = $_POST["unit_id"];
            echo "<br/>";
            echo $ppurchase_price= $_POST["ppurchase_price"];
            echo "<br/>";
            echo $pdis = $_POST["pdis"];
            echo "<br/>";
            echo $reqty = $_POST["reqty"];
            try{
                if ($pcode == "")
                {
                    throw new Exception("SKU Cannot Be Empty!");
                }
                if ($product_name == "")
                {
                    throw new Exception("Product Name Cannot Be Empty!");
                }
                if ($brand_id == "")
                {
                    throw new Exception("Brand Cannot Be Empty!");
                }
                if ($department_id == "")
                {
                    throw new Exception("Department Cannot Be Empty!");
                }
                if ($cat_id == "")
                {
                    throw new Exception("Category Cannot Be Empty!");
                }
                if ($sub_cat_id == "")
                {
                    throw new Exception("Sub category Cannot Be Empty!");
                }
                if ($pbarcode == "")
                {
                    throw new Exception("Barcode Cannot Be Empty!");
                }
                if ($unit_id == "")
                {
                    throw new Exception("Unit Cannot Be Empty!");
                }
                if ($ppurchase_price == "")
                {
                    throw new Exception("Default Regular Unit Price Cannot Be Empty!");
                }
                $patpcode = "/^\DS[0-9]{4}$/";
                if (!preg_match($patpcode, $pcode))
                {
                    throw new Exception("Invalid SKU");
                }
                if(!isset($_POST["product_name"]) || $_POST["product_name"]=="")
                {
                    throw new Exception("Product name is not valid ");
                }
                if(!$_POST["brand_id"]>0)
                {
                    throw new Exception("Invalid Brand!");
                }
                if(!$_POST["department_id"]>0)
                {
                    throw new Exception("Invalid Department!");
                }
                if(!$_POST["cat_id"]>0)
                {
                    throw new Exception("Invalid Category");
                }
                if(!$_POST["unit_id"]>0)
                {
                    throw new Exception("Invalid Unit!");
                }
                //Upload image.
                if ($_FILES["product_img"]["name"] != "") {
                    $img = $_FILES["product_img"]["name"];
                    $img = "" . time() . "_" . $img;
                    //Obtain temporary location.
                    $tmp = $_FILES["product_img"]["tmp_name"];
                    $destination = "../images/product_image/$img";
                    move_uploaded_file($tmp, $destination);
                } else {
                    $img = "default.jpg";
                }
                $productId=$productObj->addProduct($pcode,$product_name,$brand_id,$department_id,$cat_id,$sub_cat_id,$pbarcode,$unit_id,$img,$ppurchase_price,$pdis);
                $msg = " Product successfully Added!!";
                $msg = base64_encode($msg);
                header('Location: ../view/view-product.php?msg=' . $msg);
            }
            catch (Exception $ex) {
                $error = $ex->getMessage();
                $error = base64_encode($error);
                header('Location: ../view/add-product.php?error=' . $error);
            }
            break;

        /**
         * Deactivate product
         */
        case "deactivateProduct":
            $productId= $_REQUEST["product_id"];
            //Decode the encoded product id to the normal numeric form.
            $productId = base64_decode($productId);
            $productObj->deactivateProduct($productId);
            $msg = "Product Successfully Updated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/view-product.php?msg=' . $msg);
            break;

        /**
         * Activate product
         */
        case "activateProduct":
            $productId= $_REQUEST["product_id"];
            $productId = base64_decode($productId);
            $productObj->activateProduct($productId);
            $msg = "Product Successfully Available!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/view-product.php?msg=' . $msg);
            break;

        /**
         * Edit product
         */
        case "edit_product":
            echo $productId = $_POST["product_id"];
            echo $pcode = $_POST["pcode"];
            echo "<br/>";
            echo $product_name = $_POST["product_name"];
            echo "<br/>";
            echo $brand_id = $_POST["brand_id"];
            echo "<br/>";
            echo $department_id = $_POST["department_id"];
            echo "<br/>";
            echo $cat_id = $_POST["cat_id"];
            echo "<br/>";
            echo $sub_cat_id = $_POST["sub_cat_id"];
            echo "<br/>";
            echo $pbarcode = $_POST["pbarcode"];
            echo "<br/>";
            echo $unit_id = $_POST["unit_id"];
            echo "<br/>";
            echo $ppurchase_price= $_POST["ppurchase_price"];
            echo "<br/>";
            echo $pdis = $_POST["pdis"];
            try{
                if ($pcode == "")
                {
                    throw new Exception("SKU Cannot Be Empty!");
                }
                if ($product_name == "")
                {
                    throw new Exception("Product Name Cannot Be Empty!");
                }
                if ($brand_id == "")
                {
                    throw new Exception("Brand Cannot Be Empty!");
                }
                if ($department_id == "")
                {
                    throw new Exception("Department Cannot Be Empty!");
                }
                if ($cat_id == "")
                {
                    throw new Exception("Category Cannot Be Empty!");
                }
                if ($sub_cat_id == "")
                {
                    throw new Exception("Sub category Cannot Be Empty!");
                }
                if ($pbarcode == "")
                {
                    throw new Exception("Barcode Cannot Be Empty!");
                }
                if ($unit_id == "")
                {
                    throw new Exception("Unit Cannot Be Empty!");
                }
                $patpcode = "/^\DS[0-9]{4}$/";
                if (!preg_match($patpcode, $pcode))
                {
                    throw new Exception("Invalid SKU");
                }
                if(!isset($_POST["product_name"]) || $_POST["product_name"]=="")
                {
                    throw new Exception("Product name is not valid ");
                }
                if(!$_POST["brand_id"]>0)
                {
                    throw new Exception("Invalid Brand!");
                }
                if(!$_POST["department_id"]>0)
                {
                    throw new Exception("Invalid Department!");
                }
                if(!$_POST["cat_id"]>0)
                {
                    throw new Exception("Invalid Category");
                }
                if(!$_POST["unit_id"]>0)
                {
                    throw new Exception("Invalid Unit!");
                }
                //Upload image.
                if ($_FILES["product_img"]["name"] != "") {
                    $img = $_FILES["product_img"]["name"];
                    $img = "" . time() . "_" . $img;
                    //Obtain temporary location.
                    $tmp = $_FILES["product_img"]["tmp_name"];
                    $destination = "../images/product_image/$img";
                    move_uploaded_file($tmp, $destination);
                } else {
                    $img = "default.jpg";
                }
                $productId=$productObj->addProduct($pcode,$product_name,$brand_id,$department_id,$cat_id,$sub_cat_id,$pbarcode,$unit_id,$img);
                $msg = " Product successfully Added!!";
                $msg = base64_encode($msg);
                header('Location: ../view/view-product.php?msg=' . $msg);
            }
            catch (Exception $ex) {
                $error = $ex->getMessage();
                $error = base64_encode($error);
                header('Location: ../view/add-product.php?error=' . $error);
            }
            break;

    }
}








