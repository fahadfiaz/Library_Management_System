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
		$t_id = mysqli_real_escape_string($connection ,strtolower(trim($_POST['teacher_id'])));
		$issue_date = date("Y-m-d");
		
	
		
		//validations
		
		//1
		$fields_required =array("book_id", "teacher_id");
		foreach($fields_required as $field){
			$value = trim($_POST[$field]);
			if(!has_presence($value))
			{		
				$errors[$field] = ucfirst($field) . " can't be Blank";
			}		
		}
		
		
		$fields_with_max_lengths = array("book_id" => 5, "teacher_id" => 5);
		validate_max_lengths($fields_with_max_lengths);
		
		$queryerror="select book_id from book where book_id='$id'";
		$res1=mysqli_query($connection,$queryerror);
		$res2=mysqli_fetch_assoc($res1);
		if(empty($res2["book_id"]))
		{
			$errors["exist"]="Book does not exist";
			
		}
		
		
		$queryerror2="select teacher_id from teacher where teacher_id='$t_id'";
		$res3=mysqli_query($connection,$queryerror2);
		$res4 = mysqli_fetch_assoc($res3);
		
		if(empty($res4["teacher_id"]))
		{
			$errors["teacher"]="Register Teacher First Then Issue Book.";
		}
		
		
		if(empty($errors))
		{
		
		
			$query0 = "select status_id from book
					where book_id = '$id';";
			$result0 = mysqli_query($connection,$query0);	
			$stat = mysqli_fetch_assoc($result0);
			
			if($stat["status_id"] == 2){
					
				$due_date = add_Days($issue_date,10);
				$query="insert into issue_date(issue_date,due_date) 
						values ('$issue_date','$due_date')";

				$result = mysqli_query($connection,$query);

				$query1="insert into issue_return(book_id,issue_date,student_id,teacher_id,return_date,fine) 
						values ('$id','$issue_date',null,'$t_id',null,null)";

				$result1 = mysqli_query($connection,$query1);

				if($result1)
				{
					$query2="update book
							set status_id=1
							where book_id='$id'";

					$result2 = mysqli_query($connection,$query2);
					echo"<script>alert('Book has been Issued.')</script>";
				}
			}	
		
			else
			{
				echo "Book is Already issued. ";
			}
		}
	}
	else{
		$id ="";
		$t_id = "";
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
				<div class="button"> <li>  <a class="active" class="ban" href="issue_book.php"> Issue Books </a> </div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="return_book.php"> Return Book </a> </div>
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
				Issue Book
				
			</h2>
			
			<div class="issue">
					<form action="#" method ="post">
						Book Id:		<input   class="inputs"  type="text" name="book_id" value="<?php echo htmlspecialchars($id); ?>" /> <br />
						Teacher Id:		<input   class="inputs"  type="text" name="teacher_id" value="<?php echo htmlspecialchars($t_id); ?>"  /> <br />
	
						<div class="space">
							<div class="button">
								<input type="submit" name="submit" value="Issue Book" />
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