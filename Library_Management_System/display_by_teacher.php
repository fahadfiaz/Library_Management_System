<?php
	//form detection
	require_once("include_function.php");
	require_once("validation_functions.php");
	require_once("connection.php");
	$errors = array();
	$message ="";
	if(isset($_POST['submit']))
	{
		
		$teacher_id = mysqli_real_escape_string($connection ,strtolower(trim($_POST['teacher_id'])));
		
	
		
		//validations
		
		//1
		$fields_required =array( "teacher_id");
		foreach($fields_required as $field){
			$value = trim($_POST[$field]);
			if(!has_presence($value))
			{		
				$errors[$field] = ucfirst($field) . " can't be Blank";
			}		
		}
		
		
		$fields_with_max_lengths = array("teacher_id" => 10);
		validate_max_lengths($fields_with_max_lengths);
		
		$query0 ="select teacher_id
						from teacher
						where teacher_id ='$teacher_id'; ";
		$result0 = mysqli_query($connection, $query0);
		$test0 = mysqli_fetch_assoc($result0);
		if(!empty($test0["teacher_id"]))
		{
			
			$query= " select concat(b.teacher_first_name, ' ', b.teacher_last_name) as name,
							a.issue_date, a.return_date, c.due_date, a.book_id
							from issue_return a, teacher b, issue_date c
							where a.teacher_id = b.teacher_id
							and a.issue_date = c.issue_date
							and a.teacher_id= '$teacher_id';";
			$result = mysqli_query($connection, $query);
			
			$result112 = mysqli_query($connection, $query);
			$test112 = mysqli_fetch_assoc($result112);
			 if(empty($test112["book_id"]))
			{
				$errors["exist"]="No record exist";
			}
		}
		else{
			 $errors["exist"]="Teacher is not Registered";
		}
	}
	else
	{
		$teacher_id ="";
	}
?>

<html>
<head>
	<title> Librarian </title>
	<link rel="stylesheet" type="text/css" href="adminstyle.css">
	<link rel="stylesheet" type="text/css" href="issue_book.css">
	<link rel="stylesheet" type="text/css" href="table.css">
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
				<div class="button"> <li>  <a class="active" class="ban" href="display_book.php"> Display Book </a></div>
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
				Display Book
				
			</h2>
			
			<div class="issue">
					<form action="display_by_teacher.php" method ="post">
						
						Teacher Id:		<input   class="inputs"  type="text" name="teacher_id" value="<?php echo htmlspecialchars($teacher_id); ?>"  /> <br />
							
						<div class="space">
							<div class="button">
								<input type="submit" name="submit" value="Display" />
							</div>
						</div>
					</form>
				</div>
			<table>
					<tr>
						
						<th>Teacher Name</th>
						<th>Book Id</th>
						<th>Issue Date</th>
						<th>Return Date</th>
						<th>Due Date</th>
						
					</tr>
					<?php
						global $result; 
						if($result){
							while($display = mysqli_fetch_assoc($result))
							{
					?>
					
					<tr>
						<td><?php echo ucfirst($display['name']); ?> </td>
						<td><?php echo ucfirst($display['book_id']); ?></td>
						<td><?php echo ucfirst($display['issue_date']); ?></td>
						<td><?php echo ucfirst($display['return_date']); ?></td>
						<td><?php echo ucfirst($display['due_date']); ?></td>
					
			
					</tr>
					<?php
							}
						}
					?>
 
			</table>	
				<div class="error" >
						<?php
							echo form_errors($errors);
							?>
				</div>			
		</div>			
		</div>
</div>
</body>
</html>
<?php
	//5. Close database connection
	mysqli_close($connection);

?>