<?php
	//form detection
	require_once("include_function.php");
	require_once("validation_functions.php");
	$errors = array();
	$message ="";
	if(isset($_POST['submit']))
	{
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		//validations
		
		//1
		$fields_required =array("username", "password");
		foreach($fields_required as $field){
			$value = trim($_POST[$field]);
			if(!has_presence($value))
			{		
				$errors[$field] = ucfirst($field) . " can't be Blank";
			}		
		}
		
		
		$fields_with_max_lengths = array("username" => 30, "password" => 8);
		validate_max_lengths($fields_with_max_lengths);
		if(empty($errors)){
			
			//try to login part	
			if($username == "admin" && $password == "abc123")
			{
				//sucessful login
				redirect("admin.php");
			}
			else if($username == "student" && $password == "abc123")
			{
				redirect("student.php");
			}
			else
			{
				$message = "Username/Password Do not Match.";
			}
		}
		
	}
	else
	{
				$username = "";
				
				//$message = "Plz Log in.";
				
	}
?>


<html>
<head>
<title> LMS Login </title>
<link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>

	<div class="main">
	<?php echo "Please Login!! "; ?>
	
	<form action="login.php" method ="post">
	
		Username:		<input  class="inputs"  type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" /> <br />
		Password:		<input  class="inputs" type="password" name ="password" value="" /> <br />
	
	
	<div class="space">
	<div class="button">
	<input type="submit" name="submit" value="Login" />
	</div>
	</div>
	</form>
	
	
	<?php echo $message ?>
	
	<?php
			echo form_errors($errors);
	?>
	
	</div>	
	
	
</body>
</html>
