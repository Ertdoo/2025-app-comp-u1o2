<?php
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
$message = ""; //msg var
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']); 
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?"); //sql shi
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // If passwords are hashed in DB, use password_verify()
        // if (password_verify($password, $user['password'])) { // Assuming password field is named 'password'
        if ($password === $user['password']) { // Assuming password field is named 'password'
            // Login successful
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username']; 
            $_SESSION["session_logged"] = $username;
            $message = "Login successful!";
        } else {
            $message = "Incorrect password!";
        }
    } else {
        $message = "User not found!";
    }

    $stmt->close();
    $conn->close();
}
?>

<?php
include_once "header.php";
?>

<?php
include_once "menubar_new.php";
?>

<div class="d-flex justify-content-center align-items-center vh-100 bg-dark">
    <form action="#" method="POST" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4 text-white">Login to existing Account</h2>
        <?php if ($message): ?>
            <div class="alert <?php echo (strpos($message, 'successful') !== false) ? 'alert-success' : 'alert-danger'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <label for="username" class="form-label text-white">Username:</label>
        <input type="text" id="username" name="username" class="form-control mb-3" required>

        <label for="password" class="form-label text-white">Password:</label>
        <input type="password" id="password" name="password" class="form-control mb-3" required>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
