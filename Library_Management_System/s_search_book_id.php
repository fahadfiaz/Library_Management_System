<?php
	//form detection
	require_once("include_function.php");
	require_once("validation_functions.php");
	require_once("connection.php");
	$errors = array();
	$message ="";
	if(isset($_POST['submit']))
	{
		$book_id =  mysqli_real_escape_string($connection ,strtolower(trim($_POST['book_id'])));
		
		//validations
		
		$fields_required =array("book_id");
		foreach($fields_required as $field){
			$value = trim($_POST[$field]);
			if(!has_presence($value))
			{		
				$errors[$field] = ucfirst($field) . " can't be Blank";
			}		
		}
		
		$fields_with_max_lengths = array("book_id" => 20);
		validate_max_lengths($fields_with_max_lengths);
		
		
		$query = "select a.isbn,b.book_id, a.book_name,concat(e.author_first_name, ' ', e.author_last_name) as author,a.book_edition, d.status_type
						from isbn a, book b, status d, author e
						where b.isbn = a.isbn
						and b.status_id = d.status_id
						and a.author_id = e.author_id
						and b.book_id = '$book_id'";
		
		$result = mysqli_query($connection, $query);
		$result112 = mysqli_query($connection, $query);
		$test112 = mysqli_fetch_assoc($result112);
		if(empty($test112["book_id"]))
		{
			$errors["aid"]="No record Exist.";		
		}
		
	}
	else{
		$book_id ="";
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

				
				<div class="button"> <li>  <a class="active" class="ban" href="student.php"> Search Book </a></div>
				<hr align="left" width=80% size=1 color="black">
			
				<div class="button"> <li>  <a class="ban" href="login.php"> Log Out </a></div>
				<hr align="left" width=80% size=1 color="black">
				
			</ul>
		</div>

			
		
		<div id="content">
			
			
		
				<div class="log">			
		
			
			</div>
			<h2 style="text-shadow: 0 0 4px black; color:#4CAF50;  text-align:center; text-decoration:blink; font:18pt Impact; ">
				Search Book
				
			</h2>
			
			<div class="issue">
					<form action="s_search_book_id.php" method ="post">
			
						Book Id:		<input   class="inputs"  type="text" name="book_id" value="<?php echo htmlspecialchars($book_id); ?>" /> <br />
	
						<div class="space">
							<div class="button">
								<input type="submit" name="submit" value="Serch" />
							</div>
						</div>
					</form>
				</div>

			<table>
					<tr>
						<th>ISBN</th>
						<th>Book Id</th>
						<th>Book name</th>
					    <th>Author name</th>
						<th>Edition</th>
						<th>Status</th>
					</tr>
					<?php
							global $result;
							if($result){
							while($display = mysqli_fetch_assoc($result))
							{
					?>
					<tr>
						<td><?php echo ucfirst($display['isbn']); ?> </td>
						<td><?php echo ucfirst($display['book_id']); ?></td>
						<td><?php echo ucfirst($display['book_name']); ?></td>
						<td><?php echo ucfirst($display['author']); ?></td>
						<td><?php echo ucfirst($display['book_edition']); ?></td>
						<td><?php echo ucfirst($display['status_type']); ?></td>
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