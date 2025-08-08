<!--crud_update-->
<?php include_once "header.php"; ?>

 
<h1>CRUD Update</h1>
<!--Code-->
<form action="crud_update_action.php" method="POST">
ID: <input type="number" name="id" id="id"><br>
First Name: <input type="text" name="f_name" id="f_name"><br>
<input type="submit">
</form>
 
<?php include_once "footer.php"; ?>