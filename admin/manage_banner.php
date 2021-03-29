<?php
require('top.inc.php');
$banner_name="";
$image="";
$msg ="";   
$image_required="required";
if(isset($_GET['id'])&& $_GET['id']!=""){
    $image_required ="";
    $id = get_safe_value($conn, $_GET['id']);
    $res = mysqli_query($conn, "SELECT * FROM banner WHERE id = '$id'");
    $check = mysqli_num_rows($res);
    if($check>0){
        $row = mysqli_fetch_assoc($res);
        $banner_name = $row['banner_name'];
    }else{
        header("location: banner.php");
        die();
    }
}
if(isset($_POST['submit'])){
    $banner_name = get_safe_value($conn, $_POST['banner_name']);
    $collection_date = date('Y');

    $res = mysqli_query($conn, "SELECT * FROM banner WHERE banner_name = '$banner_name'");
    $check = mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id'])&& $_GET['id']!=""){
            $getData = mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            }else{
                $msg ="product already exist";
            }
        }else{
            $msg ="Product already exist";
        }
    }
    if($_FILES['banner_image']['type']!='' && $_FILES['banner_image']['type']!='image/jpg' && $_FILES['banner_image']['type']!='image/png' && $_FILES['banner_image']['type']!='image/jpeg'){
        $msg ="please insert jpg , jpeg and png file only";
    }

    if($msg ==''){
        if(isset($_GET['id'])&& $_GET['id']!=""){
            if($_FILES['image']['name']!=''){
                $image =rand(111111111,999999999).'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
                $update_sql = "UPDATE banner SET banner_name='$banner_name',banner_image='$image' WHERE id ='$id'";
            }else{
                $update_sql = "UPDATE banner SET banner_name='$banner_name' WHERE id ='$id'";
            }
            mysqli_query($conn, $update_sql);
        }else{
            $image =rand(111111111,999999999).'_'.$_FILES['banner_image']['name'];
            move_uploaded_file($_FILES['banner_image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
            mysqli_query($conn, "INSERT INTO banner(banner_name,banner_image,collection_date) 
            VALUES ('$banner_name','$image','$collection_date')");
        }  
        header("location: banner.php");
        die();
    }
    
}


?>

<div class="content pb-0">
<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-header"><strong>banner</strong><small> Form</small></div>
            <div class="card-body card-block">
                <form method="POST" enctype="multipart/form-data">
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label for="banner_name" class=" form-control-label">banner Name</label>
                            <input type="text" name="banner_name" placeholder="Enter banner name" class="form-control" required value="<?php echo $banner_name?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="banner_image" class=" form-control-label">banner image</label>
                            <input type="file" name="banner_image"  class="form-control" <?php echo $image_required?>>
                        </div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submit">
                            <span id="payment-button-amount" >Submit</span>
                        </button>
                        <?php echo $msg ?>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
require('footer.inc.php');
?>