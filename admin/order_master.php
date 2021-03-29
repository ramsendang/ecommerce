<?php
require('top.inc.php');
if(isset($_GET['type']) && $_GET['type']!=''){
    $type = get_safe_value($conn, $_GET['type']);
    if($type == 'status'){
        $opeartion = get_safe_value($conn, $_GET['operation']);
        $id = get_safe_value($conn, $_GET['id']);

        if($opeartion=='active'){
            $order_status = 1;
        }else{
            $order_status = 0;
        }
        $update_staus_sql = "UPDATE `order` SET order_status = '$order_status' WHERE id = '$id'";
        mysqli_query($conn, $update_staus_sql);
    }
}

$sql = "SELECT * FROM users ORDER BY id   DESC";
$res = mysqli_query($conn, $sql);
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Order Master</h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-remove"><span class="nobr">order id</span></th>
                                <th class="product-remove"><span class="nobr">user id</span></th>
                                <th class="product-name"><span class="nobr">order date</span></th>
                                <th class="product-price"><span class="nobr"> address </span></th>
                                <th class="product-stock-stauts"><span class="nobr"> payment type </span></th>
                                <th class="product-add-to-cart"><span class="nobr">paymetn status</span></th>
                                <th class="product-add-to-cart"><span class="nobr">order status</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = mysqli_query($conn, "select * from `order`");
                            while($row=mysqli_fetch_assoc($res)){
                            ?>
                            <tr>
                            <td class="product-add-to-cart"><a href="order_master_detail.php?id=<?php echo $row['id']?>"> <?php echo $row['id']?></a></td>
                                <td><?php echo $row['user_id']?></a></td>
                                <td><?php echo $row['added_on']?></td>
                                <td><?php echo $row['address']?></td>
                                <td><?php echo $row['pament_type']?></td>
                                <td><?php echo $row['payment_status']?></td>
                                <td>
                                    <?php
                                    if($row['order_status']==1){
                                        echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."' style='color: black;'>shifts&nbsp&nbsp&nbsp&nbsp</a></span>";
                                    }else{
                                        echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."' style='color: black;'>pending&nbsp&nbsp&nbsp&nbsp</a></span>";
                                    }
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