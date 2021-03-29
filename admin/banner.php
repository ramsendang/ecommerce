<?php
require('top.inc.php');
// prx($_SERVER);

if(isset($_GET['type']) && $_GET['type']!=''){
    $type = get_safe_value($conn, $_GET['type']);
    if($type == 'delete'){
        $id = get_safe_value($conn, $_GET['id']);
        $delete_staus_sql = "DELETE FROM banner WHERE id = '$id'";
        mysqli_query($conn, $delete_staus_sql);
    }
}

$sql="select * from banner";
$res = mysqli_query($conn, $sql);
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Products</h4>
                    <h4 class="box-link" ><a href="manage_banner.php" style="font-size: .9rem; text-decoration: underline;">Add banner<a></h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th class="serial">#</th>
                                <th>ID</th>
                                <th>banner_name</th>
                                <th>banner Image</th>
                                <th>collection date</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=1;
                                while($row=mysqli_fetch_assoc($res)){?>
                                    <tr>
                                        <td class="serial"><?php $i?></td>
                                        <td><?php echo $row['id'] ?></td>    
                                        <td><?php echo $row['banner_name'] ?></td>
                                        <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['banner_image'] ?>"/></td>
                                        <td><?php echo $row['collection_date'] ?></td>
                                        <td>
                                            <?php
                                                echo "&nbsp&nbsp&nbsp&nbsp<span class='badge badge-edit' ><a href='manage_banner.php?id=".$row['id']."' style='color: black'>Edit&nbsp&nbsp</a></span>";
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