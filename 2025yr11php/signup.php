<?php
// Delete cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "users_db"; 

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$form_error = ""; 
$success = "";
$form_username = "";
$form_email = "";
$form_password = "";
$form_confirm_password = "";

// process the form if it is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // data from the form
    $form_username = $_POST['username'];
    $form_email = $_POST['email'];
    $form_password = $_POST['password'];
    $form_confirm_password = $_POST['confirm_password'];

    // basic validation
    if (empty($form_username) || empty($form_email) || empty($form_password) || empty($form_confirm_password)) {
        $form_error = "Please fill in all fields.";
    } elseif ($form_password !== $form_confirm_password) {
        $form_error = "Passwords do not match.";
    } elseif (!filter_var($form_email, FILTER_VALIDATE_EMAIL)) {
        $form_error = "Invalid email format.";
    } else {
      // check username
      $stmt_check_username = $conn->prepare("SELECT id FROM users WHERE username = ?"); //sql command
      $stmt_check_username->bind_param("s", $form_username);
      $stmt_check_username->execute();
      $stmt_check_username->store_result(); //get num_rows

      if ($stmt_check_username->num_rows > 0) {
          $form_error = "Username already taken.";
      }
      $stmt_check_username->close();

      // check email (after username)
      if (empty($form_error)) {
          $stmt_check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
          $stmt_check_email->bind_param("s", $form_email);
          $stmt_check_email->execute();
          $stmt_check_email->store_result(); 

          if ($stmt_check_email->num_rows > 0) {
              $form_error = "Email already registered.";
          }
          $stmt_check_email->close();
      }

        //$hashed_password = password_hash($form_password, PASSWORD_DEFAULT);

        // prepare and bind the sql statement
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $form_username, $form_email, $form_password);

        // execute statement
        if ($stmt->execute()) {
            $success = "Registration successful!";
            // Redirect to login page
            // header("Location: login.php");
        }
        $stmt->close();
    }
}
$conn->close();
?>

<?php 
include_once "header.php";
?>

<?php 
include_once "menubar_new.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-dark">
  <form action="signup.php" method="POST" style="width: 100%; max-width: 400px;">
    <h2 class="text-center mb-4 text-white">Create an Account</h2>

    <?php if (!empty($form_error)): ?>
      <div class="alert alert-danger">
        <?php echo $form_error; ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
      <div class="alert alert-success">
        <?php echo $success; ?>
      </div>
    <?php endif; ?>

    <label for="username" class="form-label text-white">Username:</label>
    <input type="text" id="username" name="username" class="form-control mb-3" required>

    <label for="email" class="form-label text-white">Email:</label>
    <input type="email" id="email" name="email" class="form-control mb-3" required>

    <label for="password" class="form-label text-white">Password:</label>
    <input type="password" id="password" name="password" class="form-control mb-3" required>

    <label for="confirm_password" class="form-label text-white">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" class="form-control mb-4" required>

    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
  </form>
</body>
</html>


