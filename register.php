<?php

require_once "config.php";

if(isset($_REQUEST['create'])) 
{
	$name	= strip_tags($_REQUEST['name']);	
	$email		= strip_tags($_REQUEST['email']);		
	$password	= strip_tags($_REQUEST['password']);	
		
	if(strlen($password) < 6){
		$errorMsg[] = "Password must be atleast 6 characters";	
	}
	else
	{	
		try
		{	
			$select_stmt=$db->prepare("SELECT name, email FROM user 
										WHERE name=:uname OR email=:uemail"); 
			
			$select_stmt->execute(array(':uname'=>$name, ':uemail'=>$email)); 
			
			
			if(!isset($errorMsg)) 
			{
				$new_password = password_hash($password, PASSWORD_DEFAULT); 
				
				$insert_stmt=$db->prepare("INSERT INTO user	(name,email,password) VALUES
																(:uname,:uemail,:upassword)"); 					
				
				if($insert_stmt->execute(array(	':uname'	=>$name, 
												':uemail'	=>$email, 
												':upassword'=>$new_password))){
													
					$registerMsg="Register Successfully. Please click on Login Account link"; 
				}
			}
		}
		catch(PDOException $e)
		{
			
		}
	}
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>NOTE APP</title>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>	
	<link rel="stylesheet" type="text/css" href="css/style.css">
		
</head>




	<body>

			<div class="container h-100">
	<div class="d-flex justify-content-center h-100">
		<div class="user_card">
			
		<div >
				<form>
					<h1>Create Account</h1>
					<p>Fill up the form with correct values.</p>
					<div class="input-group mb-3">
						<input type="text" name="name" class="form-control" placeholder="Name" required>
					</div>

					<div class="input-group mb-3">
						<input type="text" name="email" class="form-control" placeholder="Email Address" required>
					</div>
					
					<div class="input-group mb-3">
						<input class="form-control" id="password"  type="password" name="password" placeholder="Password" required>
					</div>

				
			</div>
			<div class="d-flex justify-content-center mt-3 register_container">
					<input class="btn" type="submit" id="register" name="create" value="Sign Up">
			</div>
			</form>
			<div class="mt-4">
				<div class="d-flex justify-content-center links">
					 Already have an account? <a href="login.php"><p class="text-info">Log In here</p></a>
				</div>
		</div>

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
			if(isset($errorMsg))
			{
				foreach($errorMsg as $error)
				{
				?>
					<div class="alert alert-danger">
						<strong><?php echo $error; ?></strong>
					</div>
	            <?php
				}
			}
			if(isset($registerMsg))
			{
			?>
				<div class="alert alert-success">
					<strong><?php echo $registerMsg; ?></strong>
				</div>
	        <?php
			}
			?> 
										
	</body>
</html>






