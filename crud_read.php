<?php include_once "header.php"; ?>

<h1>CRUD Read</h1>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pay_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT id, f_name, l_name, email, gender, status FROM crud"; //sql query to select everything
$result = $conn->query($sql);

?>

<div class="col-sm-12">
    <h3>CRUD Database</h3>
    <table class="table" id="usersTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { //while row = the num_rows
                    if ($row["status"] == "true") {
                        echo "<tr>";
                        echo "<td>" . ($row["id"]) . "</td>";
                        echo "<td>" . ($row["f_name"]) . "</td>";
                        echo "<td>" . ($row["l_name"]) . "</td>";
                        echo "<td>" . ($row["email"]) . "</td>";
                        echo "<td>" . ($row["gender"]) . "</td>";
                        echo "<td>" . ($row["status"]) . "</td>";
                        echo "</tr>";
                    }
                }
            } else {
                echo "<tr><td colspan='6'>No data bro</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<?php include_once "footer.php"; ?>