<?php
require_once("connection.php");


	$query = "select count(book_id) total_book
				from book";
	$result = mysqli_query($connection,$query);
	$total_book = mysqli_fetch_assoc($result);
	
	$query1 = "select count(book_id) total_issued_book
				from book
				where status_id = 1"; 
	$result1 = mysqli_query($connection,$query1);
	$total_issued_book = mysqli_fetch_assoc($result1);
	
	$query2 = "select count(book_id) total_avalible_book
				from book
				where status_id = 2"; 
	$result2 = mysqli_query($connection,$query2);
	$total_avalible_book = mysqli_fetch_assoc($result2);
	
	$query3 = "select count(student_id) total_student
				from student"; 
	$result3 = mysqli_query($connection,$query3);
	$total_student = mysqli_fetch_assoc($result3);
	
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

				<div class="button"> <li>  <a class="active" class="ban" href="admin.php" >  Home </a> </div>
				
				<hr align="left" width=80% size=1 color="black"> 
				
				<div class="button"> <li>  <a class="ban" href="add_book.php" >  Add Books </a> </div>
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
			
			
			
			<BR> <BR>
			<h2 style="text-shadow: 0 0 4px black; color:#4CAF50;  text-align:center; text-decoration:blink; font:18pt Impact; ">
				 Library Management System  
				
			</h2>
			
			
			
					
			 
	 				
				
			
			<a href="total_books.php" class="i_button"><?php echo "Total Books: " . $total_book['total_book']; ?></a>
			<a href="total_avbooks.php" class="i_button"> <?php echo "Available Books: " . $total_avalible_book['total_avalible_book']; ?></a>
			<a href="total_issubooks.php" class="i_button"><?php echo "Issued Books: " . $total_issued_book['total_issued_book']; ?></a>
			<a href="total_student.php" class="i_button"> <?php echo "Total Students: " . $total_student['total_student']; ?></a>
		
			
		</div>
</div>
</body>
</html>