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
		$s_id = mysqli_real_escape_string($connection ,strtolower(trim($_POST['Student_id'])));
	
		
		//validations
		
		//1
		$fields_required =array("book_id", "Student_id");
		foreach($fields_required as $field){
			$value = trim($_POST[$field]);
			if(!has_presence($value))
			{		
				$errors[$field] = ucfirst($field) . " can't be Blank";
			}		
		}
		
		
		$fields_with_max_lengths = array("book_id" => 5, "Student_id" => 10);
		validate_max_lengths($fields_with_max_lengths);
		
		$queryerror="select book_id from book where book_id='$id'";
		$reserror=mysqli_query($connection,$queryerror);
		$reserror2=mysqli_fetch_assoc($reserror);
		if(empty($reserror2["book_id"]))
		{
			$errors["exist"]="Book does not exist";
			
		}
		
		
		$queryerror2="select student_id from student where student_id='$s_id'";
		$res3=mysqli_query($connection,$queryerror2);
		$res4 = mysqli_fetch_assoc($res3);
		
		if(empty($res4["student_id"]))
		{
			$errors["student"]="Student Does not Exist";
		}
		
		$queryerror3="select student_id from issue_return where student_id='$s_id' and book_id='$id'";
		$res4=mysqli_query($connection,$queryerror3);
		$res5 = mysqli_fetch_assoc($res4);
		if(empty($res5["student_id"]))
		{
			$errors["stu"]="Student_id and book_id does not match ";
		}
		
		if(empty($errors))
		{
		
		
				$query12 ="select b.issue_date
									from issue_date a, issue_return b
									where a.issue_date = b.issue_date
									and b.book_id = '$id'
									and b.return_date is null;";
				
				$result12 = mysqli_query($connection,$query12);	
				$issue_date = mysqli_fetch_assoc($result12);
				
				
				//$return_date=date("Y-m-d");
				$return_date=add_days(date("Y-m-d"),3);
				
				
				
				
				if($issue_date["issue_date"] != $return_date)
				
				{
						$query0 = "select status_id from book
									where book_id = '$id';";
							$result0 = mysqli_query($connection,$query0);	
							$stat = mysqli_fetch_assoc($result0);
						
						if($stat["status_id"] == 1){
							
						
							$query1 ="select a.due_date, b.issue_date
										from issue_date a, issue_return b
										where a.issue_date = b.issue_date
										and b.book_id = '$id'
										and b.return_date is null;";
							
							$result1 = mysqli_query($connection,$query1);	
							$due = mysqli_fetch_assoc($result1);
							
							$return12= strtotime($return_date);
							$due11 = strtotime($due["due_date"]);

							
							if($return12> $due11)
							{	
								$diff = days_between($return_date,$due["due_date"]);
								$fine = $diff * 10;
							}
							else
							{
							
								$fine=0;
							}
						
							
							$a=$due['issue_date'];
								
							
							if($fine > 0)
							{
									
									$query2="update issue_return
									set return_date = '$return_date', fine = $fine
									where book_id='$id'
									and issue_date = '$a';";
									$result2 = mysqli_query($connection,$query2);
									
									
							}
							else if($fine <= 0)
							{
									
									$query3="update issue_return
									set return_date = '$return_date', fine = 0
									where book_id='$id'
									and issue_date = '$a'";
									$result3 = mysqli_query($connection,$query3);
									
							}
							if($result3 || $result2)
							{
								$query4="update book
										set status_id=2
										where book_id='$id'";

								$result4 = mysqli_query($connection,$query4);
								echo"<script>alert('Book has been Returned.')</script>";
							}
						}
						ELSE
						{
							$errors["issue"] = "Book is not Issued.";
						}
				}
				else
				{
					$errors["issue"] = "Can not return The book on same day.";
				}
		}
		
	}
	else
	{
		$id = "";
		$s_id = "";
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
				<div class="button"> <li>  <a class="active" class="ban" href="return_book.php"> Return Book </a> </div>
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
				Return Book
				
			</h2>
			
			<div class="issue">
					
					<form action="return_from_student.php" method ="post">
						Book Id:		<input   class="inputs"  type="text" name="book_id" value="<?php echo htmlspecialchars($id); ?>" /> <br />
						Student Id:		<input   class="inputs"  type="text" name="Student_id" value="<?php echo htmlspecialchars($s_id); ?>" /> <br />
						
	
	
						<div class="space">
							<div class="button">
								<input type="submit" name="submit" value="Return Book" />
							</div>
						</div>
						
					</form>
					<?php 
						global $fine;
						if($fine){
							echo "Fine: " . $fine ; 
						}
						else{
							echo "Fine: 0";
						}
							
							?>
					<br>
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