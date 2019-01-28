<?php
	//form detection
	require_once("include_function.php");
	require_once("validation_functions.php");
	require_once("connection.php");
	$errors = array();
	$message ="";
	if(isset($_POST['submit']))
	{
		
		$category_name =mysqli_real_escape_string($connection ,strtolower(trim($_POST['category_name'])));
		
	
		
		//validations
		
		//1
		$fields_required =array( "category_name");
		foreach($fields_required as $field){
			$value = trim($_POST[$field]);
			if(!has_presence($value))
			{		
				$errors[$field] = ucfirst($field) . " can't be Blank";
			}		
		}
		
		
		$fields_with_max_lengths = array("category_name" => 15);
		validate_max_lengths($fields_with_max_lengths);
		
		

		
		if(empty($errors)){
		$query="insert into category (category_type) 
			values ('$category_name')";

		$result = mysqli_query($connection,$query);
			if(!$result){		
					$errors["exist"]="Category already Exist.";
			}
			else if ($result)
			{
				echo"<script>alert('Category has been Added.')</script>";
			}
	
		}
	}
	else
	{
		$category_name ="";
	}
?>

<html>
<head>
	<title> Librarian </title>
	<link rel="stylesheet" type="text/css" href="adminstyle.css">
	<link rel="stylesheet" type="text/css" href="issue_book.css">
</head>

<body>
<div class="main">

		<div id="banner">
			<img src="banner.jpg" width="100%" height="192"/>
		</div>



		<div id="sidelinks" >
			<ul>

				<div class="button"> <li>  <a  class="ban" href="admin.php" >  Home </a> </div>
				
				<hr align="left" width=80% size=1 color="black"> 
				
				<div class="button"> <li>  <a  class="ban" href="add_book.php" >  Add Books </a> </div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="issue_book.php"> Issue Books </a> </div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a  class="ban" href="return_book.php"> Return Book </a> </div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="delete_book.php"> Delete Book </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="search_book.php"> Search Book </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="register_user.php"> Register User </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="fine_list.php"> Fine List </a> </div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="display_book.php"> Display Book </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="active" class="ban" href="add_category.php"> Add Category </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="show_category.php"> Show Category </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="login.php"> Log Out </a></div>
				<hr align="left" width=80% size=1 color="black">
				
			</ul>
		</div>

			
		
		<div id="content">
			
			
		
				
			<h2 style="text-shadow: 0 0 4px black; color:#4CAF50; text-align:center; text-decoration:blink; font:18pt Impact">
				 Add Category
				
			</h2>
			
			<div class="issue">
					<form action="add_category.php" method ="post">
			
						Category Name:		<input   class="inputs"  type="text" name="category_name" value="<?php echo htmlspecialchars($category_name); ?>" /> <br />
	
						<div class="space">
							<div class="button">
								<input type="submit" name="submit" value="Add" />
							</div>
						</div>
					</form>
				</div>
				
				<div class="error" >
						<?php
					
							echo form_errors($errors);
				
							?>
				</div>
			
		</div>
</div>


</body>
</html>
<?php
	//5. Close database connection
	mysqli_close($connection);
?>