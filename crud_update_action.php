<!--crud_update_action.php-->
<?php include_once "header.php"; ?>


<h1>CRUD Update Action</h1>
<!--Code-->
<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "pay_db"; 

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$id = isset($_POST['id']) ? trim($_POST['id']) : '';
$f_name = isset($_POST['f_name']) ? trim($_POST['f_name']) : '';


$f_name = ucfirst(strtolower($f_name));

 
echo ($f_name . "<br>");
echo ($id . "<br>");
 
$query0 = "UPDATE crud
           SET f_name = '" . $f_name . "'
           WHERE id = " . $id;
$query1 = "SELECT * FROM crud LIMIT 1";
         
$result0 = mysqli_query($conn, $query0);
$result1 = mysqli_query($conn, $query1);
$conn ->close();
 
if ($result1 -> num_rows === 1) {
    //Fetches result as an associative array and stores in crud
    $crud = $result1->fetch_assoc();
    //now f_name is the key, the associative then value of the first record under f_name will be echoed
    echo($crud['id'] . ": " . $crud['f_name']);
   
  } else {
    echo("No date");
}



$conn->close();
?>
 
<?php include_once "footer.php"; ?>