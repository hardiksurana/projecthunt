<?php
    session_start();
    require_once("library/class.user.php");

    $login = new USER();
    if(isset($_POST['rememberMe'])){
        $_COOKIE['rememberMe'] = TRUE;
    }

    if($login->is_loggedin()){
    	$login->redirect('mainpage.php');
    }

    if(isset($_POST['login-submit'])){
    	$uname = strip_tags($_POST['user']);
    	$upass = strip_tags($_POST['pass']);

    	if($login->doLogin($uname,$upass)){
    		$login->redirect('mainpage.php');
    	}
    	else{
    		$message = "wrong details!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
    	}
    }

    $user = new USER();
    if($user->is_loggedin() != ""){
    	$user->redirect('mainpage.php');
    }

    if(isset($_POST['register-submit'])){
    	$uname = strip_tags($_POST['user']);
    	$umail = strip_tags($_POST['email']);
    	$upass = strip_tags($_POST['pass']);

    	if($uname == ""){
    		$message = "Please provide username.";
            echo "<script type='text/javascript'>alert('$message');</script>";
    	}
    	else if($umail == ""){
    		$message = "Please provide E-Mail ID.";
            echo "<script type='text/javascript'>alert('$message');</script>";
    	}
    	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)){
    	    $error[] = 'Please enter a valid email address !';
    	}
    	else if($upass == ""){
    		$message = "Please provide password.";
            echo "<script type='text/javascript'>alert('$message');</script>";
    	}
    	else if(strlen($upass) < 6){
    		$message = "Password must be atleast 6 characters";
            echo "<script type='text/javascript'>alert('$message');</script>";
    	}
    	else{
    		try{
    			$stmt = $user->runQuery("SELECT user_name, user_email FROM users WHERE user_name=:uname OR user_email=:umail");
    			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
    			$row=$stmt->fetch(PDO::FETCH_ASSOC);

    			if($row['user_name'] == $uname){
    				$message = "sorry username already taken !";
    		        echo "<script type='text/javascript'>alert('$message');</script>";
    			}
    			else if($row['user_email'] == $umail){
    			    $message = "sorry email id already taken !";
    	            echo "<script type='text/javascript'>alert('$message');</script>";
    			}
    			else{
    				if($user->register($uname,$umail,$upass)){
    					$user->redirect('login.php?joined');
    				}
    			}
    		}
    		catch(PDOException $e){
    			echo $e->getMessage();
    		}
    	}
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("library/header.php"); ?>
    <title>ProjectHunt | Login</title>
    <!-- My Stylesheets -->
    <link rel="stylesheet" href="css/master.css" charset="utf-8">
    <link rel="stylesheet" href="css/login.css" charset="utf-8">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-light">
      <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="homepage.php">
                  <img alt="ProductHunt Logo" src="images/logo.jpg">
                </a>
            </div>
            <button class="navbar-toggler hidden-sm-up pull-xs-right" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
            &#9776;
          </button>
          <div class="collapse navbar-toggleable-xs pull-xs-right" id="navbar-content">
              <ul class="nav navbar-nav pull-sm-right">
                <li class="nav-item">
                  <a class="nav-link" href="homepage.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="login.php">
                      <button type="button" name="button" class="btn btn-info">Register/Log-In</button>
                    </a>
                </li>
              </ul>
          </div>
      </div>
    </nav>
    <!-- NAVBAR ENDS HERE -->

    <!-- Form Section -->
    <div class="container">
        	<div class="row">
    			<div class="col-md-6 col-md-offset-3">
    				<div class="panel panel-login">
    					<div class="panel-heading">
    						<div class="row">
    							<div class="col-xs-6">
    								<a href="login.php" class="active" id="login-form-link">Login</a>
    							</div>
    							<div class="col-xs-6">
    								<a href="register.php" id="register-form-link">Register</a>
    							</div>
    						</div>
    						<hr>
    					</div>
    					<div class="panel-body">
    						<div class="row">
    							<div class="col-lg-12">
    								<form id="login-form" method="post" role="form" style="display: block;">
    									<div class="form-group">
    										<input type="text" name="user" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
    									</div>
    									<div class="form-group">
    										<input type="password" name="pass" id="password" tabindex="2" class="form-control" placeholder="Password">
    									</div>
    									<div class="form-group text-center">
    										<input type="checkbox" tabindex="3" class="" name="rememberMe" id="remember">
    										<label for="remember"> Remember Me</label>
    									</div>
    									<div class="form-group">
    										<div class="row">
    											<div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-lg btn-info" value="Log In">
    											</div>
    										</div>
    									</div>
    								</form>
    								<form id="register-form" method="post" role="form" style="display: none;">
    									<div class="form-group">
    										<input type="text" name="user" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
    									</div>
    									<div class="form-group">
    										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
    									</div>
    									<div class="form-group">
    										<input type="password" name="pass" id="password" tabindex="2" class="form-control" placeholder="Password">
    									</div>
    									<div class="form-group">
    										<div class="row">
    											<div class="col-sm-6 col-sm-offset-3">
    												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-lg btn-info" value="Register Now">
    											</div>
    										</div>
    									</div>
    								</form>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
        <!-- Form Section  Ends Here-->
</body>
</html>
