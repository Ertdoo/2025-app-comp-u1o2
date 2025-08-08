<!--crud_create_action.php-->
<?php include_once "header.php"; ?>



<h1>CRUD Create Action</h1>
<!--Code-->
<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "pay_db"; 

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);


/* echo ($f_name . "<br>");
echo ($l_name . "<br>");
echo ($email . "<br>");
echo ($gender . "<br>");
echo ($status . "<br><br>"); */
// Use trim() to remove leading/trailing whitespace
$f_name = isset($_POST['f_name']) ? trim($_POST['f_name']) : '';
$l_name = isset($_POST['l_name']) ? trim($_POST['l_name']) : '';
$email  = isset($_POST['email']) ? trim($_POST['email']) : '';
$gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
$status = isset($_POST['status']) ? trim($_POST['status']) : '';

$f_name = ucfirst(strtolower($f_name));
$l_name = ucfirst(strtolower($l_name));
$email = strtolower($email);
$gender = ucfirst(strtolower($gender));
$status = strtolower($status);

$query0 = "INSERT INTO crud (f_name, l_name, email, gender, status)
            VALUES ('".$f_name."', '".$l_name."', '".$email."', '".$gender."', '".$status."')";
$result = mysqli_query($conn, $query0);

$query1 = "SELECT * FROM crud ORDER BY id DESC LIMIT 1";
//echo ('<br>' . $query1 . '<br>');
$result = mysqli_query($conn, $query1);
//echo ('<br>Result inserted: ' . $query1 . '<br>');
echo('Newest first name: <br>');
if ($result->num_rows === 1) { //gets the whole of row 1
    $crud = $result->fetch_assoc() ; //makes it an assoc array (where you store a string ro a name with a number value (a dictonary))
    echo ($crud['id'] . ": " . $crud['f_name']) ; 
} else {
    echo ("no data brotein shake") ;
}
$conn->close();

 ?>
 
<?php include_once "footer.php"; ?>