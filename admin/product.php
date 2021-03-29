<?php
require('top.inc.php');
// prx($_SERVER);

if(isset($_GET['type']) && $_GET['type']!=''){
    $type = get_safe_value($conn, $_GET['type']);
    if($type == 'status'){
        $opeartion = get_safe_value($conn, $_GET['operation']);
        $id = get_safe_value($conn, $_GET['id']);

        if($opeartion=='active'){
            $status = 1;
        }else{
            $status = 0;
        }
        $update_staus_sql = "UPDATE product SET status = '$status' WHERE id = '$id'";
        mysqli_query($conn, $update_staus_sql);
    }
    if($type == 'delete'){
        $id = get_safe_value($conn, $_GET['id']);
        $delete_staus_sql = "DELETE FROM product WHERE id = '$id'";
        mysqli_query($conn, $delete_staus_sql);
    }
}

$sql = "SELECT product.*, categories.categories FROM product, categories 
where product.categories_id = categories.id ORDER BY product.id DESC";
$res = mysqli_query($conn, $sql);
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Products</h4>
                    <h4 class="box-link" ><a href="manage_product.php" style="font-size: .9rem; text-decoration: underline;">Add products<a></h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th class="serial">#</th>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>MRP</th>
                                <th>price</th>
                                <th>qty</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=1;
                                while($row=mysqli_fetch_assoc($res)){?>
                                    <tr>
                                        <td class="serial"><?php $i?></td>
                                        <td><?php echo $row['id'] ?></td>    
                                        <td><?php echo $row['categories'] ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>"/></td>
                                        <td><?php echo $row['mrp'] ?></td>
                                        <td><?php echo $row['price'] ?></td>
                                        <td><?php echo $row['qty'] ?></td>
                                        <td>
                                            <?php
                                                if($row['status']==1){
                                                    echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."' style='color: black;'>Active&nbsp&nbsp&nbsp&nbsp</a></span>";
                                                }else{
                                                    echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."' style='color: black;'>DeActive&nbsp&nbsp&nbsp&nbsp</a></span>";
                                                }
                                                echo "&nbsp&nbsp&nbsp&nbsp<span class='badge badge-edit' ><a href='manage_product.php?id=".$row['id']."' style='color: black'>Edit&nbsp&nbsp</a></span>";
                                                echo "&nbsp&nbsp&nbsp&nbsp<span class='badge badge-pending'><a href='?type=delete&id=".$row['id']."' style='color: black; backgroundcolor: red;'>&nbsp&nbsp&nbspDelete&nbsp&nbsp</a></span>";
                                                
                                            ?>
                                        </td>
                                   </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('footer.inc.php');
?>      