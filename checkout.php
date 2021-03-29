
<?php
    $rmsg="";
    $msg="";
    require('top.inc.php');
    // prx($_SESSION);
    if(isset($_SESSION['cart']) && count($_SESSION['cart'])==0){
        ?>
            <script>
                window.location.href="index.php";
            </script>
        <?php
    }
    if(isset($_POST['login'])){
        
        $email = get_safe_value($conn, $_POST['email']);
        $passwrod = get_safe_value($conn, $_POST['password']);
        
        $sql ="SELECT * FROM users WHERE email = '$email' AND password = '$passwrod'";
        $res = mysqli_query($conn, $sql);
    
        $count = mysqli_num_rows($res);
        if($count > 0){
            $row = mysqli_fetch_assoc($res);
            $_SESSION['USER_LOGIN']='yes';
            $_SESSION['USER_ID']=$row['id'];
            $_SESSION['USER_LOGIN']=$row['name'];
            ?>
            <script>
                window.location.href="checkout.php"
            </script>
            <?php
        }else{
            $msg = "please enter correct login details";
        }
    }
    if(isset($_POST['submit'])){
        $name = get_safe_value($conn, $_POST['name']);
        $email = get_safe_value($conn, $_POST['email']);
        $mobile = get_safe_value($conn, $_POST['mobile']);
        $passwrod = get_safe_value($conn, $_POST['password']);
        $added_on = date('Y-m-d h:i:s');
    
        $check_user = mysqli_num_rows(mysqli_query($conn, "select * from users where email='$email'"));
        if($check_user>0){
            $rmsg="email already exist";
        }else{
            mysqli_query($conn, "insert into users(name,email,mobile,password,added_on) values('$name','$email','$mobile','$passwrod','$added_on')")or die("error");
        }
    }
    $cart_total=0;
    foreach($_SESSION['cart'] as $key =>$val){
        $productArr =get_product($conn,'','',$key);
        $price = $productArr[0]['price'];
        $qty=$val['qty'];
        $cart_total=$cart_total+($price*$qty);
    }
    if(isset($_POST['checkout'])){
        $address=get_safe_value($conn, $_POST['address']);
        $city=get_safe_value($conn, $_POST['city']);
        $pincode=get_safe_value($conn, $_POST['pincode']);
        $payment_type=get_safe_value($conn, $_POST['payment_type']);
        $user_id=$_SESSION['USER_ID'];
        $total_price=$cart_total;
        $payment_status='pending';
        if($payment_type=="cod"){
            $payment_status='success';
        }
        $order_status="0";
        $added_on=date("Y-m-d h:i:s");
        mysqli_query($conn, "insert into `order`(user_id,address,city,pincode,pament_type,total_price,payment_status,order_status,added_on) values
        ('$user_id','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$added_on')");

        $order_id= mysqli_insert_id($conn);
        foreach($_SESSION['cart'] as $key =>$val){
            $productArr =get_product($conn,'','',$key);
            $price = $productArr[0]['price'];
            $qty=$val['qty'];
            mysqli_query($conn, "insert into order_deail (order_id,product_id,qty,price) values ('$order_id','$key','$qty','$price')");
        }
        unset($_SESSION['cart']);
        ?>
            <script>
                window.location.href="thankyou.php";
            </script>
        <?php
    } 
?>
<div class="offset__wrapper">
            <!-- Start Search Popap -->


<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/cover.jpeg) no-repeat scroll center center / cover ;">
<div class="ht__bradcaump__wrap">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="bradcaump__inner">
                    <nav class="bradcaump-inner">
                        <a class="breadcrumb-item" href="index.html">Home</a>
                        <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                        <span class="breadcrumb-item active">checkout</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="checkout__inner">
                <div class="accordion-list">
                    <div class="accordion">
                        <?php 
                        $accordion_class="accordion__title";
                        if(!isset($_SESSION['USER_LOGIN'])){
                            $accordion_class="accordion__hide";
                            ?>
                            <div class="accordion__title">
                            Checkout Method
                        </div>
                        <div class="accordion__body">
                            <div class="accordion__body__form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="checkout-method__login">
                                        <form id="contact-form" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="email" placeholder="Your Email*" style="width:100%">
										</div>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="password" placeholder="Your Password*" style="width:100%">
										</div>
									</div>
									
									<div class="contact-btn">
										<button type="submit" name="login"  class="fv-btn">Login</button>
									</div>
                                    <div class="message">
                                        <?php echo $msg?>
                                    </div>
								</form>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-method__login">
                                        <form id="contact-form"  method="POST">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
										</div>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="email" id="email" placeholder="Your Email*" style="width:100%">
										</div>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%">
										</div>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="password" id="password" placeholder="Your Password*" style="width:100%">
										</div>
									</div>
									
									<div class="contact-btn">
										<button type="submit" name="submit" class="fv-btn">Register</button>
									</div>
                                    <div class="message">
                                    <?php echo $rmsg?>
                                    </div>
								</form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="<?php echo $accordion_class?>">
                            Address Information
                        </div>
                        <div class="accordion__body">
                            <div class="bilinfo">
                                <form action="#" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="single-input">
                                                <input type="text" name="address" placeholder="Street Address" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-input">
                                                <input type="text" name="city" placeholder="City/State" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-input">
                                                <input type="text" name="pincode" placeholder="Post code/ zip" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div >
                                    payment information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="paymentinfo">
                                            <div class="single-method">
                                                Cash on Delievary<input type="radio" name="payment_type" value="cod" required>
                                                Esewa<input type="radio" name="payment_type" value="esewa" required>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" name="checkout">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="order-details">
                <h5 class="order-details__title">Your Order</h5>
                <div class="order-details__item">
                <?php 
                    $cart_total=0;
                    foreach($_SESSION['cart'] as $key =>$val){
                        $productArr =get_product($conn,'','',$key);
                        $pname=$productArr[0]['name'];
                        $mrp=$productArr[0]['mrp'];
                        $price = $productArr[0]['price'];
                        $image=$productArr[0]['image'];
                        $qty=$val['qty'];
                        $cart_total=$cart_total+($price*$qty);
                ?>
                        <div class="single-item">
                            <div class="single-item__thumb">
                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image ?>" alt="ordered item">
                            </div>
                            <div class="single-item__content">
                                <a href="#"><?php echo $pname ?></a>
                                <span class="price">$<?php echo $price ?></span>
                            </div>
                            <div class="single-item__remove">
                                <a href="javascript:void(0)" onclick="manageCart('<?php echo $key?>','remove')"><i class="zmdi zmdi-delete"></i></a>
                            </div>
                        </div>
                        <?php } ?>
                </div>
                <div class="ordre-details__total">
                    <h5>Order total</h5>
                    <span class="price">$<?php echo $cart_total ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
    require('footer.inc.php');
?>