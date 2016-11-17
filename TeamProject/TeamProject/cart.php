<?php
include 'pill.php';
include "../includes/projectConn.php";
session_start();
$dbConn = getDatabaseConnection('medical');

$pills = array();
$cart = array();

$i = 0;
$price = 0;

$sql = "SELECT * FROM drug ORDER BY Trade_Name ASC";
$statement= $dbConn->prepare($sql); 
$statement->execute();
$records = $statement->fetchALL(PDO::FETCH_ASSOC); 

foreach($records as $record) {
    $tn = $record['Trade_Name'];
    $n = $record['Name'];
    $f = $record['Formula'];
    $p = $record['Price'];
    $tempPill = new Pill($tn, $n, $f, $p);
    $pills[$tempPill->getLowerName()] = $tempPill;
    $i++;
}

foreach($pills as $pill) {
    if(isset($_GET[$pill->getLowerName()])) {
        $cart[$pill->getLowerName()] = $pill;
    }
}


?>
<html>
    <head>
        <title>Welcome to Crazy Eddie's Pill-porium!</title>
    </head>
    <table border>
    <tr><th>Name</th><th>Price</th><th>Image</th></tr>
    <?php
    foreach($cart as $pill) {
    //    echo "$j <br>"
        echo "<tr><td>" .  $pill -> getTradeName(). "</td><td>" . $pill -> getPrice() . "</td><td>" . $pill -> showBottle(). "</td></tr>"; 
        $price = $price + $pill -> getPrice();
        
    }
    $_SESSION['cart'] = $cart;
    ?>
    </table>
    <?php
        echo "Total: $price <br>";
    ?>
<form action="paymentprocess.php">
<input type="submit" name="submitForm" value="Confirm">
    
</form>
</html>