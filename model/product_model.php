<?php

include_once '../commons/dbConnection.php';
$dbConnObj= new dbConnection();
class Product{
    /**
     * Insert into product details into table
     * @param $pcode
     * @param $product_name
     * @param $brand_id
     * @param $department_id
     * @param $cat_id
     * @param $sub_cat_id
     * @param $pbarcode
     * @param $unit_id
     * @param $product_image
     * @param $ppurchase_price
     * @param $pdis
     * @param $reqty
     * @return mixed
     */
    function addProduct($pcode,$product_name,$brand_id,$department_id,$cat_id,$sub_cat_id,$pbarcode,$unit_id,$product_image,$ppurchase_price,$pdis,$reqty)
    {
        $con=$GLOBALS['con'];
        $sql="INSERT INTO product(pcode,
                        product_name,
                        brand_id,
                        department_id,
                        cat_id,
                        sub_cat_id,
                        pbarcode,
                        unit_id,
                        product_image,
                        ppurchase_price,
                        pdis,
                        reqty
                        )VALUES(
                        '$pcode','$product_name','$brand_id','$department_id','$cat_id','$sub_cat_id','$pbarcode','$unit_id','$product_image','$ppurchase_price','$pdis','$reqty'
                        )";
        $result=$con->query($sql) or die($con->error);
        $productId=$con->insert_id;  //  getting the auto incremented id
        return $productId;

    }

    /**
     * Get all products in view-product
     * @return mixed
     */
    function getAllProducts()
    {
        $con = $GLOBALS["con"];
        $sql="SELECT * FROM product p, category c WHERE  p.cat_id=c.cat_id";
        $productResult=$con->query($sql);
        return $productResult;

    }

    /**
     * Get one product
     * @param $productId
     * @return mixed
     */
    function getAllProduct($productId)
    {
        $con = $GLOBALS["con"];
        $sql="SELECT * FROM product p, category c,department d,brand b,sub_category s,unit u WHERE p.cat_id=c.cat_id AND p.department_id=d.department_id AND p.brand_id=b.brand_id AND p.sub_cat_id=s.sub_cat_id AND p.unit_id=u.unit_id AND p.product_id='$productId'";
        $productResult=$con->query($sql);
        return $productResult;


    }

    /**
     * Deactivate product
     * @param $productId
     */
    function deactivateProduct($productId) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE product SET product_status='0' WHERE product_id='$productId'";
        $result = $con->query($sql);
    }

    /**
     * activate product
     * @param $productId
     */
    function activateProduct($productId) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE product SET product_status='1' WHERE product_id='$productId'";
        $result = $con->query($sql);
    }

    /**
     * Update product
     * @param $productId
     * @param $pcode
     * @param $product_name
     * @param $brand_id
     * @param $department_id
     * @param $cat_id
     * @param $sub_cat_id
     * @param $pbarcode
     * @param $unit_id
     * @param $product_image
     * @param $ppurchase_price
     * @param $pdis
     */
    function updateProduct($productId,$pcode,$product_name,$brand_id,$department_id,$cat_id,$sub_cat_id,$pbarcode,$unit_id,$product_image,$ppurchase_price,$pdis) {
        $con = $GLOBALS['con'];

        if ($product_image != "default.jpg") {
            //if the product image not equal to default image
            $sql ="UPDATE product SET "
                . "pcode='$pcode',"
                . "product_name='$product_name',"
                . "brand_id='$brand_id',"
                . "department_idl='$department_id',"
                . "cat_id='$cat_id',"
                . "sub_cat_id='$sub_cat_id',"
                . "pbarcode='$pbarcode',"
                . "unit_id='$unit_id',"
                . "ppurchase_price='$ppurchase_price',"
                . "pdis='$pdis'"
                . "WHERE product_id='$productId'";
        } else {
            //product image equal to default image
            $sql ="UPDATE user SET "
                . "pcode='$pcode',"
                . "product_name='$product_name',"
                . "brand_id='$brand_id',"
                . "department_id='$department_id',"
                . "sub_cat_id='$sub_cat_id',"
                . "pbarcode='$pbarcode',"
                . "unit_id='$unit_id',"
                . "ppurchase_price='$ppurchase_price',"
                . "pdis='$pdis'"
                . "WHERE product_id='$productId'";
        }
        $result = $con->query($sql) or die($con->error);
    }
    function editProduct()
    {
        $con = $GLOBALS['con'];
        $sql="INSERT INTO product(pcode,
                        product_name,
                        brand_id,
                        department_id,
                        cat_id,
                        sub_cat_id,
                        pbarcode,
                        unit_id,
                        product_image,
                        ppurchase_price,
                        pdis
                        )VALUES(
                        '$pcode','$product_name','$brand_id','$department_id','$cat_id','$sub_cat_id','$pbarcode','$unit_id','$product_image','$ppurchase_price','$pdis'
                        )";
        $result=$con->query($sql) or die($con->error);
        $productId=$con->insert_id;  //  getting the auto incremented id
        return $productId;
    }

    /**
     * get the product count by category
     * @return mixed
     */
    function getProductCountByCategory()
    {
        $con = $GLOBALS["con"];
        $sql="SELECT COUNT(*) as countp , c.cat_name FROM product p, category c WHERE p.cat_id=c.cat_id GROUP BY p.cat_id";
        $productResult = $con->query($sql);
        return $productResult;
    }

    /**
     * active product count
     * @return mixed
     */
    function getActiveProductCount() {
        $con = $GLOBALS['con'];
        $sql="SELECT COUNT(product_id) as countaddProduct FROM product WHERE product_status='1'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $activeProductCount = $row["countaddProduct"];
        return $activeProductCount;
    }
    function viewBrand($brand_id) {
        $con = $GLOBALS["con"];
        $sql ="SELECT * FROM product p, brand b WHERE p.brand_id=b.brand_id AND p.brand_id='$brand_id'";
        $result = $con->query($sql);
        return $result;
    }
    function getSpecificProduct($productId)
    {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM product WHERE product_id='$productId' ";
        $productResult=$con->query($sql);
        return $productResult;
    }
    function activateProducts() {
        $con = $GLOBALS["con"];
        $sql="SELECT * FROM product WHERE product_status='1'";
        $result = $con->query($sql);
    }
    //Get pcode number
    function getSkuNo()
    {
        $con=$GLOBALS["con"];
        $sql= "SELECT pcode from product order by pcode DESC LIMIT 1";
        $result=$con->query($sql);
        return $result;
    }
    //Get barcode number
    function getBarcodeNo()
    {
        $con=$GLOBALS["con"];
        $sql= "SELECT  pbarcode from product order by  pbarcode DESC LIMIT 1";
        $result=$con->query($sql);
        return $result;
    }




}