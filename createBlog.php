 <!--
 File: createBlog.php
 Author: Thomas Zhang
 Class: IS 448
 Assignment: HW3
 Description: PHP page to create database for blog
--->

<!DOCTYPE html>
<html lang="EN">
 <head>
  <title> Create Blog </title>
  <link rel="stylesheet" type="text/css" href="https://swe.umbc.edu/~thomasz1/is448/HW/HW3/blogdesign.css" />
  </head>
  <body>
  <?php
  
  
  #get parameters 
  
  $title = $_POST['title'];
  $blogText = $_POST['postEntry'];
  $tags = $_POST['tags'];
  
  #connect to mysql database
  
  $db = mysqli_connect("studentdb-maria.gl.umbc.edu","thomasz1","thomasz1","thomasz1");

  if (mysqli_connect_errno())
		exit("Error - could not connect to MySQL"); 


  #creates database table
  $createTable = "create table blog
  (
    blogID int PRIMARY KEY not null auto_increment , 
	title varchar(20) ,
	postEntry varchar(255),
	tags varchar(20)
    )";

  #runs createTable query
  $createT = mysqli_query($db, $createTable); 
  
    #inserting into table
  $insertBlog = "insert into blog (blogID, title, postEntry, tags)
  values (null, '$title', '$blogText', '$tags')";
 
  $insertB = mysqli_query($db, $insertBlog); 
  

?>

<!-- Shows recent blog -->
<h1>Your Most Recent Post</h1> 

<div class="display">
    
	<?php echo "Title: " . $title ?>
	<br><br>

	<?php echo "Blog Contents: " . $blogText ?>
	<br><br>
	
	<?php echo "Tags: " . $tags ?>
</div>

<br><br><br>


<!-- Button to return to new entry page -->
<form action="createPost.html">
<button type="submit">Post Another Entry</button>

<br><br><br>

<h1> All Blog Posts </h1>

<?php

     #display table
	$displayTable = "select * from blog";  
	

	$displayT = mysqli_query($db, $displayTable); 

	
	
    $rowNum = mysqli_num_rows($displayT); 

    
    //Displays posts if table is not empty
    if (mysqli_num_rows($displayT) > 0) {
    
		for ($iteration = 1; $iteration <= $rowNum; $iteration++) {
			$rowArray = mysqli_fetch_array($displayT);
			    
				print
				("<p> ------------------------- </p>
				<p> Blog: $iteration </p>
				<h2> Title: $rowArray[title] </h2>
				<p> Blog Contents: $rowArray[postEntry] </p> 
				<h5> Tags: $rowArray[tags] </h5>"); 
				

	}
	} 
    

?>
</body>
</html>
