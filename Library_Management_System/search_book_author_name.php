<?php
	//form detection
	require_once("include_function.php");
	require_once("validation_functions.php");
	require_once("connection.php");
	$errors = array();
	$message ="";
	if(isset($_POST['submit']))
	{
		$book_name = mysqli_real_escape_string($connection ,strtolower(trim($_POST['book_name'])));
		$a_Fname =  mysqli_real_escape_string($connection ,strtolower(trim($_POST['author_Fname'])));
		$a_Lname = mysqli_real_escape_string($connection ,strtolower( trim($_POST['author_Lname'])));
		
		//validations
		
		$fields_required =array("book_name","author_Fname","author_Lname");
		foreach($fields_required as $field){
			$value = trim($_POST[$field]);
			if(!has_presence($value))
			{		
				$errors[$field] = ucfirst($field) . " can't be Blank";
			}		
		}
		
		$fields_with_max_lengths = array("book_name" => 20,"author_Fname" => 10, "author_Lname" => 10);
		validate_max_lengths($fields_with_max_lengths);
		
		
		
		$query = "select a.isbn,b.book_id, a.book_name,concat(e.author_first_name, ' ', e.author_last_name) as author,a.book_edition, d.status_type
						from isbn a, book b, status d, author e
						where b.isbn = a.isbn
						and b.status_id = d.status_id
						and a.author_id = e.author_id
						and a.book_name = '$book_name'
						and e.author_first_name='$a_Fname'
						and e.author_last_name='$a_Lname' ";
		
		$result = mysqli_query($connection, $query);
		

		$result0 = mysqli_query($connection, $query);
		
		$b_id = mysqli_fetch_assoc($result0);
		
		
		if(empty($b_id["author"]))
		{
			
			$errors["exist"]="No Record Found";
		}
	}
	else
	{
		$book_name = "";
		$a_Fname = "";
		$a_Lname ="";
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
				<div class="button"> <li>  <a class="active" class="ban" href="search_book.php"> Search Book </a></div>
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

			<?php
				$username="User Name";
				//$username = trim($_POST['username']);
			?>
		
		<div id="content">
			
			
		
				<div class="log">			
			<?php echo $username;  ?>
			
			</div>
			<h2 style="text-shadow: 0 0 4px black; color:#4CAF50;  text-align:center; text-decoration:blink; font:18pt Impact; ">
				Search Book
				
			</h2>
			
			<div class="issue">
					<form action="search_book_author_name.php" method ="post">
			
						Book Name:		<input   class="inputs"  type="text" name="book_name" value="<?php echo htmlspecialchars($book_name); ?>" /> <br />
						Author First Name:		<input   class="inputs"  type="text" name="author_Fname" value="<?php echo htmlspecialchars($a_Fname); ?>" /> <br />
						Author Last Name:		<input   class="inputs"  type="text" name="author_Lname" value="<?php echo htmlspecialchars($a_Lname); ?>" /> <br />
							
						<div class="space">
							<div class="button">
								<input type="submit" name="submit" value="Search" />
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