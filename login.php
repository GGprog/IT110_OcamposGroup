<?php

require_once 'config.php';

session_start();



if(isset($_REQUEST['btn_login']))
{

	$email		=strip_tags($_REQUEST["email"]);	
	$password	=strip_tags($_REQUEST["password"]);			
		
		try
		{
			$select_stmt=$db->prepare("SELECT * FROM user WHERE email=:uemail"); 
			$select_stmt->execute(array(':uemail'=>$email));	
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
			
			if($select_stmt->rowCount() > 0)	
			{
				if( $email==$row["email"]) 
				{
					if(password_verify($password, $row["password"])) 
					{
						$_SESSION["user_login"] = $row["id"];		
						header("refresh:2; index.php");			
					}
					else
					{

						$errorMsg[]="Incorrect password. Please try again.";
					}
				}
				else
				{
					$errorMsg[]="Incorrect E-mail. Please try again.";
				}
			}
			else
			{
				$errorMsg[]="Incorrect E-mail. Please try again.";
			}
		}
		catch(PDOException $e)
		{
			$e->getMessage();
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
			<div class="d-flex justify-content-center">
				<div class="brand_logo_container">
					<img src="img/user.png" class="brand_logo" alt="Programming Knowledge logo">
				</div>
			</div>
		<div class="d-flex justify-content-center form_container">
				<form>
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fas fa-user"></i></span>					
						</div>
						<input type="text" name="email" class="form-control" placeholder="Enter E-mail" required>
					</div>
					<div class="input-group mb-2">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fas fa-key"></i></span>					
						</div>
						<input type="password" name="password" class="form-control" placeholder="Enter password" required>
					</div>
					<div class="form-group">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" name="rememberme" class="custom-control-input" id="customControlInline">
							<label class="custom-control-label" for="customControlInline">Remember me</label>
						</div>
					</div>
				
			</div>
			<div class="d-flex justify-content-center mt-3 register_container">
					<input class="btn" type="submit" id="register" name="btn_login" value="Login">
			</div>
			</form>
			<div class="mt-4">
				<div class="d-flex justify-content-center links">
					Don't have an account? <a href="register.php"><p class="text-info">Sign Up</p></a>
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
		?>
</div>
</div>
</div>   			
	</body>
</html>

