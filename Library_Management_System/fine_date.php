<?php
	//form detection
	require_once("include_function.php");
	require_once("validation_functions.php");
	require_once("connection.php");
	$errors = array();
	$message ="";
	if(isset($_POST['submit']))
	{
		
		$start_date = trim($_POST['start_date']);
		$end_date = trim($_POST['end_date']);
		//validations	
		//1
		$fields_required =array( "start_date", "end_date");
		foreach($fields_required as $field){
			$value = trim($_POST[$field]);
			if(!has_presence($value))
			{		
				$errors[$field] = ucfirst($field) . " can't be Blank";
			}		
		}
		
		
			
		
		
		$query="select * from issue_return 
						where issue_date between '$start_date' and '$end_date'
						and fine <> 0;";

		$result = mysqli_query($connection,$query);
		
		$result112 = mysqli_query($connection,$query);
		$test112 = mysqli_fetch_assoc($result112);
		
		if(empty($test112["book_id"]))
		{
			$errors["exist"]="No record found.";
		}
		
	}
	else
	{
		$start_date= "";
		$end_date= "";		
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
				<div class="button"> <li>  <a  class="ban" href="return_book.php"> Return Book </a> </div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="delete_book.php"> Delete Book </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="ban" href="search_book.php"> Search Book </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a  class="ban" href="register_user.php"> Register User </a></div>
				<hr align="left" width=80% size=1 color="black">
				<div class="button"> <li>  <a class="active" class="ban" href="fine_list.php"> Fine List </a> </div>
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
				Fine List
				
			</h2>
			
			<div class="issue">
					<form action="fine_date.php" method ="post">
			
						Start Date:		<input   class="inputs"  type="date" name="start_date" value="<?php echo htmlspecialchars($start_date ); ?>" /> <br />
						End Date:		<input   class="inputs"  type="date" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>" /> <br />
					
						<div class="space">
							<div class="button">
								<input type="submit" name="submit" value="Show" />
							</div>
						</div>
					</form>
				</div>

			<table>
					<tr>
						<th>Issue Date</th>
						<th>Student Id</th>
						<th>Book Id</th>
						<th>Fine Amount</th>
					</tr>
					<?php
						global $result;
						if($result){
							while($fine = mysqli_fetch_assoc ($result))
							{			
					?>					
					</tr>
					<tr>
						<td><?php echo ucfirst($fine["issue_date"])?></td>
						<td><?php echo ucfirst($fine["student_id"])?></td>
						<td><?php echo ucfirst($fine["book_id"])?></td>
						<td><?php echo ucfirst($fine["fine"])?></td>
					
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
</body>
</html>
<?php
	//5. Close database connection
	mysqli_close($connection);

?>