<?php
	//form detection
	require_once("include_function.php");
	require_once("validation_functions.php");
	require_once("connection.php");
	$errors = array();
	$message ="";
	if(isset($_POST['submit']))
	{
		
		$student_id = mysqli_real_escape_string($connection ,strtolower(trim($_POST['Student_id'])));
		$student_Fname = mysqli_real_escape_string($connection ,strtolower(trim($_POST['student_Fname'])));
		$student_Lname =mysqli_real_escape_string($connection ,strtolower(trim($_POST['student_Lname'])));
		$semester = trim($_POST['current_semester']);
		$department = mysqli_real_escape_string($connection ,strtolower(trim($_POST['department_name'])));
	
		
		//validations
		
		//1
		$fields_required =array( "Student_id", "student_Fname", "student_Lname", "current_semester", "department_name");
		foreach($fields_required as $field){
			$value = trim($_POST[$field]);
			if(!has_presence($value))
			{		
				$errors[$field] = ucfirst($field) . " can't be Blank";
			}		
		}
		
		
		$fields_with_max_lengths = array("Student_id" => 10, "student_Fname" => 10, "student_Lname" => 10, "current_semester" => 1, "department_name" => 255);
		validate_max_lengths($fields_with_max_lengths);
		
		if(Empty($errors))
		{
			$query="insert into student(student_id ,student_first_name,student_last_name,current_semester,department_id) 
			values ('$student_id', '$student_Fname', '$student_Lname',$semester,$department)";

			$result = mysqli_query($connection,$query);
			if(!$result)
			{
				$errors["exist"]="Student Already exist.";
			}
			else{
				echo"<script>alert('Student has been registered.')</script>";
			}
		}
	}
	else{
		$student_id = "";
		$student_Fname = "";
		$student_Lname ="";
		$semester = "";
		$department = "";
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
				<div class="button"> <li>  <a class="active" class="ban" href="register_user.php"> Register User </a></div>
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
				Register User
				
			</h2>
			
			<div class="issue">
					<form action="register_student.php" method ="post">
			
						Student Id:		<input   class="inputs"  type="text" name="Student_id" value="<?php echo htmlspecialchars($student_id); ?>" /> <br />
						Student First Name:		<input   class="inputs"  type="text" name="student_Fname" value="<?php echo htmlspecialchars($student_Fname); ?>" /> <br />
						Student Last Name:		<input   class="inputs"  type="text" name="student_Lname" value="<?php echo htmlspecialchars($semester); ?>" /> <br />
						Current Semester:		<input   class="inputs"  type="number" name="current_semester" min="1" max="8" value="<?php echo htmlspecialchars($department); ?>"> <br />
						Derprtment Name:		<select class="inputs" name="department_name">
												<option value="1"selected>computer sciences</option>
												<option value="2">arts & architecture</option>
												<option value="3">pharmacy</option>
												
												</select>
	
	
						<div class="space">
							<div class="button">
								<input type="submit" name="submit" value="Register" />
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