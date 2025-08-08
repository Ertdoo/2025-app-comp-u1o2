<?php include_once "header.php"; ?>

<h1>Variables</h1>

<?php
echo ("Learning Intention:<br> Store different data types in variables and display them on the screen." . "<br>");

$var_num = "69"; // php automatically converts it to an integer :O
echo ("the variable var_num stores this number: $var_num <br>");
echo ("the variable var_num stores this number: " . $var_num . "<br>");

$add_num = 2234;
$var_num = $var_num + $add_num;
echo ("<br> var_num after increasing the value by $add_num stores this number: $var_num. <br>");
?>

<?php include_once "footer.php"; ?>