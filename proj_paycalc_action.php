<!--pay_calc_action.php-->
<?php include_once "connect.php"; ?>

<?php
//error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pay_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

//for rates table
if (isset($_POST['rates_btn'])) { //when the button for rates is pressed
    $id = 1;
    $rate = isset($_POST['rateHr']) ? trim($_POST['rateHr']) : '';
    $uniform = isset($_POST['uniform']) ? trim($_POST['uniform']) : '';
    $laundry = isset($_POST['laundry']) ? trim($_POST['laundry']) : '';
    $pm_allowance = isset($_POST['pmAllowance']) ? trim($_POST['pmAllowance']) : '';
    $ext_allowance = isset($_POST['ext_income']) ? trim($_POST['ext_income']) : '';
    $deductions = isset($_POST['deductions']) ? trim($_POST['deductions']) : '';
         
    $query0 = "UPDATE rates SET base_rate = ?, uniform = ?, laundry = ?, pm_allowance = ?, ext_allowance = ?, deductions = ? WHERE id = ?";

    if ($stmt = $conn->prepare($query0)) {
        // Bind parameters: 'ssssssi' means 6 strings and 1 integer
        $stmt->bind_param("ssssssi", $rate, $uniform, $laundry, $pm_allowance, $ext_allowance, $deductions, $id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Handle error if prepare fails
        error_log("Failed to prepare statement for rates update: " . $conn->error);
    }
}

//for shifts table
if (isset($_POST['shift_btn'])) { //when the button for shifts is pressed
    $date = isset($_POST['date']) ? trim($_POST['date']) : '';
    $start_time = isset($_POST['startTime']) ? trim($_POST['startTime']) : '';
    $end_time = isset($_POST['endTime']) ? trim($_POST['endTime']) : '';
    $start_holiday = isset($_POST['start_holiday']) ? 1 : 0;
    $end_holiday = isset($_POST['end_holiday']) ? 1 : 0;
    $status = 1;

    //update shifts table
    $query1 = "INSERT INTO shifts (date, start_time, end_time, start_holiday, end_holiday, status) VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query1)) {
        // Bind parameters: 'sssiii' means 3 strings and 3 integers
        $stmt->bind_param("sssiii", $date, $start_time, $end_time, $start_holiday, $end_holiday, $status);
        $stmt->execute();
        $stmt->close();
    } else {
        // Handle error if prepare fails
        error_log("Failed to prepare statement for shift insert: " . $conn->error);
    }
}

//edit shift logic
if (isset($_POST['edit_shift_btn'])) {
    $shift_id = $_POST['shift_id']; //get the ID from the hidden field
    $date = isset($_POST['date']) ? trim($_POST['date']) : '';
    $start_time = isset($_POST['startTime']) ? trim($_POST['startTime']) : '';
    $end_time = isset($_POST['endTime']) ? trim($_POST['endTime']) : '';
    $start_holiday = isset($_POST['start_holiday']) ? 1 : 0;
    $end_holiday = isset($_POST['end_holiday']) ? 1 : 0;
    $status = 1;

    $query2 = "UPDATE shifts SET date = ?, start_time = ?, end_time = ?, start_holiday = ?, end_holiday = ?, status = ? WHERE id = ?";

    if ($stmt = $conn->prepare($query2)) {
        // Bind parameters: 'sssiiii' means 3 strings and 4 integers
        $stmt->bind_param("sssiiii", $date, $start_time, $end_time, $start_holiday, $end_holiday, $status, $shift_id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Handle error if prepare fails
        error_log("Failed to prepare statement for shift update: " . $conn->error);
    }
}

//delete shift logic
if (isset($_POST['delete_shift_btn'])) {
    $shift_id = $_POST['shift_id']; //get the ID from the hidden field
    $status_null = 0; //make status 0 to hide it from user view

    $query3 = "UPDATE shifts SET status = ? WHERE id = ?";

    if ($stmt = $conn->prepare($query3)) {
        // Bind parameters: 'ii' means 2 integers
        $stmt->bind_param("ii", $status_null, $shift_id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Handle error if prepare fails
        error_log("Failed to prepare statement for shift deletion: " . $conn->error);
    }
}
    

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>