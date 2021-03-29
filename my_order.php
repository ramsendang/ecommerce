<?php 
    require('top.inc.php');
    // prx($_SESSION);
?>
        <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-remove"><span class="nobr">order id</span></th>
                                                <th class="product-name"><span class="nobr">order date</span></th>
                                                <th class="product-price"><span class="nobr"> address </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> payment type </span></th>
                                                <th class="product-add-to-cart"><span class="nobr">paymetn status</span></th>
                                                <th class="product-add-to-cart"><span class="nobr">order status</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $uid=$_SESSION['USER_ID'];
                                            $res = mysqli_query($conn, "select * from `order` where user_id='$uid'");
                                            while($row=mysqli_fetch_assoc($res)){
                                            ?>
                                            <tr>
                                            <td class="product-add-to-cart"><a href="my_order_detail.php?id=<?php echo $row['id']?>"> <?php echo $row['id']?></a></td>
                                                <td><?php echo $row['added_on']?></td>
                                                <td><?php echo $row['address']?></td>
                                                <td><?php echo $row['pament_type']?></td>
                                                <td><?php echo $row['payment_status']?></td>
                                                <td><?php echo $row['order_status']?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    require('footer.inc.php');
?>