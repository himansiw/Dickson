<?php
 include '../model/category_model.php';
 include '../model/subcategory_model.php';
 
   $categoryObj=new Category();
   $subCategoryObj=new Subcategory();
   
if(!isset($_REQUEST["status"])){ 
?>
    <script> window.location="../index.php"</script>
<?php
 }
 else{
    $status=$_REQUEST["status"];
    switch ($status)
    { 
    //Add Category.    
            case "add_category":
        try {
            $cat_name=$_POST["cat_name"];
            $cat_code=$_POST["cat_code"];
            $cat_id=$categoryObj->addCategory($cat_name,$cat_code);
             if ($cat_id > 0) {
                    $msg = "Category $cat_name Successfully Added";
                    $msg = base64_encode($msg);
                    header('Location: ../view/category_subcategory.php?msg=' . $msg);
                } else {
                    throw new Exception("Category Addition Error");
                }
            }catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                header('Location: ../view/category_subcategory.php?msg=' . $msg);
            }
            break;
    //Edit Category        
            case "edit_category":
            $cat_id = $_POST["cat_id"];
            $categoryResult = $categoryObj->getCategory($cat_id);
            $catrow = $categoryResult->fetch_assoc();
            ?>
            <input type="hidden" name="cat_id" value="<?php echo $catrow["cat_id"]; ?>">
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Category name</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="ecat_name" name="cat_name" value="<?php echo $catrow["cat_name"]; ?>">
                </div>
            </div>
             <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Category code</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control"id="ecat_code" name="cat_code" value="<?php echo $catrow["cat_code"]; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <?php
            break;
     //Update Category   
            case "update_category":
            $cat_id = $_POST["cat_id"];
            $cat_name = $_POST["cat_name"];
            $cat_code = $_POST["cat_code"];
            $categoryObj->updateCategory($cat_id,$cat_name,$cat_code);
            $msg = "Successfully Updated Category to $cat_name";
            $msg = base64_encode($msg);
            header('Location: ../view/category_subcategory.php?msg=' . $msg);
            break;
    //Deactivate Category
            case "deactivateCategory":
            $cat_id = $_REQUEST["cat_id"];
        //Decode the encoded category id to the normal numeric form.
            $cat_id = base64_decode($cat_id);
            $categoryObj->deactivateCategory($cat_id);
            $msg = "Category Successfully Deactivated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/category_subcategory.php?msg=' . $msg);
            break;
    //Active Category.
            case "activateCategory":
            $cat_id= $_REQUEST["cat_id"];
            $cat_id = base64_decode($cat_id);
            $categoryObj->activateCategory($cat_id);
            $msg = "Category Successfully Activated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/category_subcategory.php?msg=' . $msg);
            break;    
         
        
  //Subcategory module.
        case "add_subcategory":
            $sub_cat_name = $_POST["sub_cat_name"];
            $cat_id = $_POST["cat_id"];
            $subcatsts = $subCategoryObj->addSubcategory($sub_cat_name,$cat_id);
            if ($subcatsts > 0){
                $msg = "Sub Category $sub_cat_name Successfully Added";
                $msg = base64_encode($msg);
                ?><script> window.location ="../view/category_subcategory.php?msg=<?php echo $msg;?>" </script><?php
            }
            else{
                $msg = "Sub Category $sub_cat_name Not Successfully Added";
                $msg = base64_encode($msg);
                ?><script> window.location ="../view/category_subcategory.php?error=<?php echo $msg;?>" </script><?php
            }
        break;

        case "getSubcategory":
            $cat_id = $_POST["cat_id"];
            $subcategoryResult = $subCategoryObj->getAllSubcategories($cat_id);
        break;
            //get the all sub categories for given parent category in product
         case"getCatSubcategories" :
            $cat_id = $_POST["cat_id"];
            $subcategoryResult = $subCategoryObj->getAssignedSubCategories($cat_id);
            ?>
           <select name="sub_cat_id" id="sub_cat"  class="form-control" >
               <option value="">-- SELECT --</option>
            <?php
            while ($subcatrow = $subcategoryResult->fetch_assoc()) {
            ?> 
               <option value="<?php echo $subcatrow["sub_cat_id"]; ?>">
                <?php echo $subcatrow["sub_cat_name"]; ?>
               </option>
                <?php
            }?>
            </select>
            <?php
            break;

        case "edit_subcategory":
            $sub_cat_id = $_POST["sub_cat_id"];
            $subcategoryResult = $subCategoryObj->getSubcategory($sub_cat_id);
            $subcatrow = $subcategoryResult->fetch_assoc();
            ?>
            <input type="hidden" name="sub_cat_id" value="<?php echo $subcatrow["sub_cat_id"]; ?>" />
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Subcategory Name</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="sub_cat_name" id="esub_cat_name" value="<?php echo $subcatrow["sub_cat_name"]; ?>"/>
                </div>
            </div>  
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
             <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Category Name</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" readonly style="background-color: white" name="cat_name" value="<?php echo $subcatrow["cat_name"]; ?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <?php
            break;

        case "update_subcategory":
            $sub_cat_id = $_POST["sub_cat_id"];
            $sub_cat_name = $_POST["sub_cat_name"];
            $subCategoryObj->updateSubcategory($sub_cat_id,$sub_cat_name);
            $msg = "Successfully Updated Sub Category  $sub_cat_name";
            $msg = base64_encode($msg);
            header('Location: ../view/category_subcategory.php?msg=' . $msg);
            break;
        
          case "deactivateSubcategory":
            $sub_cat_id = $_REQUEST["sub_cat_id"];
    //Decode the encoded category id to the normal numeric form.
            $sub_cat_id = base64_decode($sub_cat_id);
            $subCategoryObj->deactivateSubcategory($sub_cat_id);
            $msg = "Sub Category Successfully Deactivated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/category_subcategory.php?msg=' . $msg);
            break;    
    //Active Subcategory.
        case "activateSubcategory":
            $sub_cat_id= $_REQUEST["sub_cat_id"];
            $sub_cat_id = base64_decode($sub_cat_id);
            $subCategoryObj->activateSubcategory($sub_cat_id);
            $msg = "Sub Category Successfully Activated!!!";
            $msg = base64_encode($msg);
            header('Location: ../view/category_subcategory.php?msg=' . $msg);
            break;
        
    
    }
}
        
    
 
