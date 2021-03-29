<?php
require('top.inc.php');

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
                                <th class="product-remove"><span class="nobr">Product Name</span></th>
                                <th class="product-name"><span class="nobr">Product Image</span></th>
                                <th class="product-price"><span class="nobr"> qty </span></th>
                                <th class="product-stock-stauts"><span class="nobr"> prict </span></th>
                                <th class="product-add-to-cart"><span class="nobr">total price</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   
                            $id =get_safe_value($conn, $_GET['id']);
                            $res = mysqli_query($conn, "select distinct(order_deail.id),order_deail.*,product.name,product.image from order_deail
                            ,product,`order` where order_deail.order_id='$id'  and product.id=order_deail.product_id");
                                $total_price=0;
                            while($row=mysqli_fetch_assoc($res)){
                                $total_price=$total_price+($row['qty']*$row['price']);
                            ?>
                            <tr>
                            <td class="product-add-to-cart"><a href="order_master.php?id=<?php echo $row['id']?>"> <?php echo $row['name']?></a></td>
                            <td class="product-thumbnail"><a href="#"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>" alt="" /></a></td>    
                                <td><?php echo $row['qty']?></td>
                                <td><?php echo $row['price']?></td>
                                <td><?php echo $row['qty']*$row['price']?></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>total price</td>
                                <td><?php echo $total_price?></td>
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