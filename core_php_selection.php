<?php include_once "header.php"; ?>
 
 
<h1>Selection</h1>
 
<?php
$t = 24;
if ($t < "20") {
    echo "Have a good day!<br><br>";
} else {
    echo "Have a good night!<br><br>";
}
//if-elseif-else
$marks = 69;
if ($marks <= "30") {
    echo "Fail!<br>";
} elseif ($marks >= "70") {
    echo "Good!<br>";
} else {
    echo "Acceptable<br>";
}
?>
 
<?php
$marks = 69;
//switch-case
switch (true) {
    case ($marks <= 30):
        echo "Fail!<br>";
        break;
    case ($marks >= 70):
        echo "Good!<br>";
        break;
    default:
        echo "Acceptable<br>";
        break;
}

$favcolor = "red"; //varible that can change

switch ($favcolor) {
  case "red":
    echo "Your favorite color is red!";
    break;
  case "blue":
    echo "Your favorite color is blue!";
    break;
  case "green":
    echo "Your favorite color is green!";
    break;
  default:
    echo "Your favorite color is neither red, blue, nor green!";
}
?>
 
<?php include_once "footer.php"; ?>