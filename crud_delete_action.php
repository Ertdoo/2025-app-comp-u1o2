<?php
include_once "header.php";
?>
 
  <h1>Crud Delete Action</h1>
<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "pay_db";
$conn = new mysqli($servername, $username, $password, $dbname);

$id = $_POST["id"];
$status = $_POST["status"];
 
 
 
$query0 = "UPDATE crud
           SET status = '" . $status . "'
           WHERE id = " . $id;
 
$result = mysqli_query($conn, $query0);
 
$conn->close();
echo("result variable stores: " . $result . "<br>");
 
if ($result) {
    echo("Updated successfully");
   
  } else {
    echo("failed");
  }
$conn->close();
?>

<?php
include_once "footer.php";  
?>