<!--crud_create-->
<?php include_once "header.php"; ?>

 
<h1>CRUD Create</h1>
<!--Code-->
<form action="crud_create_action.php" method="POST">
First Name: <input type="text" name="f_name" id="f_name"><br>
Last Name: <input type="text" name="l_name" id="l_name"><br>
Email: <input type="email" name="email" id="email"><br>
Gender: <input type="text" name="gender" id="gender"><br>
Status: <input type="text" name="status" id="status"><br>
<input type="submit">
</form>
 
<?php include_once "footer.php"; ?>