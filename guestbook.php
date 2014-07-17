<?php 
//Connect to the database
$connection= mysql_connect("localhost", "db_usr_name", "db_pass");
mysql_select_db("db_name");
//if txt_name is in action -->
$name = $_POST["txt_name"];
$len = strlen($name);//check the length of the $name

 if ($len > 0){ //if name is not empty
 	
 	$email = $_POST["txt_email"];
 	$comment = $_POST["txt_comment"];	
 	$date = time();
 	
 	//Let's insert all the information to our database
 	
 	$query= "INSERT INTO guestbook(id,name,email,comment,date) VALUES(NULL,'$name','$email','$comment','$date')";
 	mysql_query($query,$connection) or die(mysql_error());// if the query dies give an error. It's a good practice to make error handling.
 }


?>



<!DOCTYPE html>
<html>


<head>

<title>Guestbook</title>

</head>

<body>
<center>
<form action="guestbook.php" method="post">
<font face="Arial" size="1"/></font> 
Name: <input type="text" name="txt_name"> &nbsp;
Email: <input type="text" name="txt_email"><br><br>
Comment: <br>
<textarea style="width:%75" rows="10" name="txt_comment"></textarea>

<center><input type="submit" value="submit"></center>
</form>



<?php 
//Fetch all the infromation from the database
$query = "SELECT * FROM guestbook ORDER BY date DESC";
$result = mysql_query($query,$connection);
// We need a loop to show all the records that is stored in the database
for($i=0; $i<mysql_num_rows($result); $i++){

$name=mysql_result($result, $i, "name");
$email=mysql_result($result, $i, "email");
$email_len = strlen($email);

$comment=mysql_result($result, $i, "comment");
$date=mysql_result($result, $i, "date");
$show_date=date("h:i:s m/d/Y",$date);


		


echo "<div>

		<br>
		<b>Name: </b>$name
		<br>
		<b>Comment: </b> $comment
		<br>
		<b>Date: </b> $show_date
		<br>

</div> <hr />";






}

?>


</center>
</body>

</html>
