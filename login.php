<?php
include 'top.inc.php';
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
            window.location.href="index.php"
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
        echo "email already exist";
    }else{
        mysqli_query($conn, "insert into users(name,email,mobile,password,added_on) values('$name','$email','$mobile','$passwrod','$added_on')")or die("error");
    }
}   
?>
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/cover.jpeg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Login/Register</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Login</h2>
								</div>
							</div>
							<div class="col-xs-12">
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
								</form>
								<div class="form-output">
									<p class="form-messege"></p>
								</div>
							</div>
						</div> 
                
				</div>
				

					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Register</h2>
								</div>
							</div>
							<div class="col-xs-12">
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
								</form>
								<div class="form-output">
									<p class="form-messege"></p>
								</div>
							</div>
						</div> 
                
				</div>
					
            </div>
        </section>
<?php include 'footer.inc.php'?>