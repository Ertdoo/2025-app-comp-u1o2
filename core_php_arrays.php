<?php include_once "header.php"; ?>

<h1>Arrays</h1>
<?php
$colors = array("red","green","blue","yellow");

foreach ($colors as $color) {

}

//associatative array
$car = array("brand"=>"ford", "model"=>"mustang", "year"=>1974);

echo("the model of the car is " . $car["model"] . "!")
?>
<?php include_once "footer.php"; ?>