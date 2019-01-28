<?php
	//form detection
	require_once("include_function.php");
	require_once("validation_functions.php");
	require_once("connection.php");
	$errors = array();
	$message ="";
	if(isset($_POST['submit']))
	{
		$idbook = mysqli_real_escape_string($connection ,trim($_POST['book_id']));
		
		$isbn = mysqli_real_escape_string($connection ,strtolower(trim($_POST['book_isbn'])));
		$edition = mysqli_real_escape_string($connection ,strtolower(trim($_POST['book_edition'])));
		$bname = mysqli_real_escape_string($connection ,strtolower(trim($_POST['book_name'])));
		$a_fname = mysqli_real_escape_string($connection ,strtolower(trim($_POST['author_Fname'])));
		$a_lname = mysqli_real_escape_string($connection ,strtolower(trim($_POST['author_Lname'])));
		$category = mysqli_real_escape_string($connection ,strtolower(trim($_POST['book_category'])));
		
		//validations
		
		//1
		$fields_required =array("book_id", "book_isbn", "book_edition", "book_name", "author_Fname", "author_Lname", "book_category");
		foreach($fields_required as $field){
			$value = trim($_POST[$field]);
			if(!has_presence($value))
			{		
				$errors[$field] = ucfirst($field) . " can't be Blank";
			}		
		}
		
		
		
		$fields_with_max_lengths = array("book_id" => 50, "book_isbn" => 11, "book_edition" => 50, "book_name" => 15, 
		"author_Fname" => 15, "author_Lname" => 15, "book_category" => 20);
		validate_max_lengths($fields_with_max_lengths);
		
		$queryerror="select book_id from book where book_id='$idbook'";
		$res1=mysqli_query($connection,$queryerror);
		$res2=mysqli_fetch_assoc($res1);
		if(!empty($res2["book_id"]))
		{
			$errors["exist"]="Book already exist";
			
		}
		
		
		
		if(empty($errors))
		//if(!$res1)
		{
			
			$query="select author_id from author where author_first_name='$a_fname' and author_last_name='$a_lname'";
			$r1=mysqli_query($connection,$query);
			$r2=mysqli_fetch_assoc($r1);
			
			if(empty($r2["author_id"]))
			{
					$query1="insert into author(author_first_name,author_last_name)
					values('$a_fname','$a_lname')";
					$r3=mysqli_query($connection,$query1);
					
			}
			
			$query0="select author_id from author where author_first_name='$a_fname' and author_last_name='$a_lname'";
			$r11=mysqli_query($connection,$query0);
			$r20=mysqli_fetch_assoc($r11);
			$id_author=$r20["author_id"];
			
			

			
			$query2="select category_id from category where category_type='$category'";
			$r4=mysqli_query($connection,$query2);
			$r5=mysqli_fetch_assoc($r4);
			
			if(empty($r5["category_id"]))
			{
				$query3="insert into category(category_type) values('$category')";
				$r6=mysqli_query($connection,$query3);
			}
			$query01="select category_id from category where category_type='$category'";
			$r14=mysqli_query($connection,$query01);
			$r15=mysqli_fetch_assoc($r14);
			$id_category=$r15["category_id"];
			
			
			
			$query4="insert into isbn(category_id,author_id,isbn,book_name,book_edition) 
			values($id_category,$id_author,$isbn,'$bname','$edition')";
			$r7=mysqli_query($connection,$query4);
			
			
			$query5="insert into book(book_id,status_id,isbn) values('$idbook',2,$isbn)";
			$r8=mysqli_query($connection,$query5);
	
			if($r8)
			{
				echo"<script>alert('Book has been Added.')</script>";
			}				
			
			
		}
	}
	else
	{
		$idbook ="";		
		$isbn ="";
		$edition = "";
		$bname = "";
		$a_fname = "";
		$a_lname = "";
		$category = "";
	}
	
?>



<html>
<head>
	<title> Librarian </title>
	<link rel="stylesheet" type="text/css" href="adminstyle.css">
	<link rel="stylesheet" type="text/css" href="add_book.css">
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
				
				<div class="button"> <li>  <a class="active" class="ban" href="add_book.php" >  Add Books </a> </div>
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
				<div class="button"> <li>  <a class="ban" href="display_book.php"> Display Book </a></div>
				<hr align="left" width=80% size=1 color="black">				<div class="button"> <li>  <a class="ban" href="add_category.php"> Add Category </a></div>
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
				 Add Book  
				
			</h2>
			
			<div class="addbook">
					<form action="Add_book.php" method ="post">
						Book Id:			<input   class="inputs"  type="text" name="book_id" value="<?php echo htmlspecialchars($idbook); ?>" /> <br />
						ISBN:				<input   class="inputs"  type="number" name="book_isbn" min="1" value="<?php echo htmlspecialchars($isbn); ?>" /> <br />
						Edition:			<input   class="inputs"  type="text" name="book_edition" value="<?php echo htmlspecialchars($edition); ?>" /> <br />
						Book Name:			<input   class="inputs"  type="text" name="book_name" value="<?php echo htmlspecialchars($bname); ?>" /> <br />
						Author First Name:		<input   class="inputs"  type="text" name="author_Fname" value="<?php echo htmlspecialchars($a_fname); ?>" /> <br />
						Author Last Name:		<input   class="inputs"  type="text" name="author_Lname" value="<?php echo htmlspecialchars($a_lname); ?>" /> <br />
						Book Category:		<input   class="inputs"  type="text" name="book_category" value="<?php echo htmlspecialchars($category); ?>" /> <br />
	
	
						<div class="space">
							<div class="button">
								<input type="submit" name="submit" value="Add book" />
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