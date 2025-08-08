<!--crud_delete-->
<?php include_once "header.php"; ?>

 
<h1>CRUD Delete</h1>
<!--Code-->
<form action="crud_delete_action.php" method="POST">
ID: <input type="number" name="id" id="id"><br>
Change Status: <select name="status" id="status"><br>
  <option value="true">True</option>
  <option value="false">False</option>
</select>
<input type="submit">
</form>
 
<?php include_once "footer.php"; ?>

