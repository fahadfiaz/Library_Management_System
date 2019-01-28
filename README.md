<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackedit.io/style.css" />
</head>

<body class="stackedit">
  <div class="stackedit__html"><p><img src="https://lh3.googleusercontent.com/gesTrv1vJVqs3M6VNRTFSBIILl_w7UMzb3ZzJ8654u-rU30QE8WM3fDvlFz_hQ3uCes-023TPdU" alt="enter image description here"></p>
<h2 id="library-management-system">Library Management System</h2>
<p>Web-Based application to maintain the records related to Book Purchase, Stock Maintenance, Book Search Catalog, Book Issue, Book Returns, Fine Collection, and all the necessary requirements for the Library to manage day to day operations.</p>
<h2 id="quick-start">Quick Start</h2>
<p>To start using Library Management System:</p>
<h2 id="get-code">Get code</h2>
<p>Clone repo via git<br>
<a href="https://github.com/fahadfiaz/Library_Management_System">https://github.com/fahadfiaz/Library_Management_System</a></p>
<h2 id="install-dependencies">Install Dependencies</h2>
<ol>
<li>XAMPP</li>
<li>Php 5.6</li>
<li>Php Mysql</li>
<li>Open phpmyadmin and import sql script file located in Sql_Script folder which will create database and tables with some dummy data</li>
<li>Project is now live on your local machine</li>
</ol>
<h2 id="features">Features</h2>
<h3 id="user-interface">User Interface</h3>
<p>The user interface deals with</p>
<ul>
<li>Students can only access limited features, i.e., public access level features</li>
<li>Display Books (By author name or category)</li>
<li>Search Books (By author name or category)</li>
<li>Issue Books (if the book is not already issued and also show student previous fine for late returning of books).</li>
<li>Reserve Books (it is ensured that the book is not reserved before, and let the user reserve it on a future date).</li>
</ul>
<h3 id="admin-interface">Admin Interface</h3>
<p>The admin interface deals with</p>
<ul>
<li>After logging in librarians can search for a specific books, book issue or students from the home panel.</li>
<li>Admin panel also display all member records (including member with reserved books,issued books etc).</li>
<li>Another responsibility of a librarian is to approve students in situations where approval is needed, i.e. where documents are to be verified or some manual work. Librarians have a panel to simply approve / reject students and to view all approved students. The librarian ID is stored alongside each approved/rejected student to keep track.</li>
<li>Fine is automatically calculated if student does not return the book before specified day. Librarian can see student fine against late returning of books.</li>
</ul>
</div>
</body>

</html>
