<?php
	//form detection
	require_once("include_function.php");
	require_once("validation_functions.php");
	require_once("connection.php");
	$errors = array();
	$message ="";
	if(isset($_POST['submit']))
	{
		$id = mysqli_real_escape_string($connection ,strtolower(trim($_POST['book_id'])));
		
		//validations
		
		//1
		$fields_required =array("book_id");
		foreach($fields_required as $field){
			$value = trim($_POST[$field]);
			if(!has_presence($value))
			{		
				$errors[$field] = ucfirst($field) . " can't be Blank";
			}		
		}
		
		
		$fields_with_max_lengths = array("book_id" => 5);
		validate_max_lengths($fields_with_max_lengths);
		
		
		$query1="select book_id
					from book 
				where book_id='$id'";
			$result1 = mysqli_query($connection,$query1);
			$book = mysqli_fetch_assoc($result1);
		
		
		if(!empty($book["book_id"]))
		{
				$query0="select status_id
							from book 
						where book_id='$id'";
					$result0 = mysqli_query($connection,$query0);
					$stat = mysqli_fetch_assoc($result0);
				
				
				
				if($stat["status_id"] == 2)
				{
					 $query00="delete from issue_return
							 where book_id='$id'";

					 $result00= mysqli_query($connection,$query00);
					
					$query001="delete from isbn 
							 where book_id='$id'";

					$result001 = mysqli_query($connection,$query001);
					
				
				
							$query="delete from book 
							where book_id='$id'";

					$result = mysqli_query($connection,$query);
				
					
					if( mysqli_affected_rows($connection) == 1){
						
						echo"<script>alert('Book record has been Deleted.')</script>";
					}
				}
				else if($stat["status_id"] == 1 )
				{
					$errors["exist"]="Book is issued.";
				}
		}
		else
		{
			$errors["exist"]="Book not exist.";
		}
	
	}
	else{
		$id = "";
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
				<div class="button"> <li>  <a  class="ban" href="issue_book.php"> Issue Books </a> </div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a  class="ban" href="return_book.php"> Return Book </a> </div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="active" class="ban" href="delete_book.php"> Delete Book </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="search_book.php"> Search Book </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="register_user.php"> Register User </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="fine_list.php"> Fine List </a> </div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="display_book.php"> Display Book </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="add_category.php"> Add Category </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="show_category.php"> Show Category </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="login.php"> Log Out </a></div>
				<hr align="left" width=80% size=1 color="black">
				
			</ul>
		</div>

		
		<div id="content">
			
			
		
				<div class="log">			
			
			
			</div>
			<h2 style="text-shadow: 0 0 4px black; color:#4CAF50;  text-align:center; text-decoration:blink; font:18pt Impact; ">
				 Delete Book 
				
			</h2>
			
			 <div class="issue">
					<form action="delete_book.php" method ="post">
						Book Id:		<input   class="inputs"  type="text" name="book_id" value="<?php echo htmlspecialchars($id); ?>" /> <br />
	
						<div class="space">
							<div class="button">
								<input type="submit" name="submit" value="Delete Book" />
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