<?php
include 'pill.php';
include "../includes/projectConn.php";

$dbConn = getDatabaseConnection('medical');

$pills = array();

$sql = "SELECT * FROM drug ORDER BY Trade_Name ASC";
$statement= $dbConn->prepare($sql); 
$statement->execute();
$records = $statement->fetchALL(PDO::FETCH_ASSOC); 


    if (empty($_GET['filterByPrice'])) {
        $filterByPrice = 65535; //A default high price for no filtering
    }else {
        $filterByPrice = $_GET['filterByPrice'];
    }

foreach($records as $record) {
    $tn = $record['Trade_Name'];
    $n = $record['Name'];
    $f = $record['Formula'];
    $p = $record['Price'];
    $tempPill = new Pill($tn, $n, $f, $p);
    $pills[$tempPill->getLowerName()] = $tempPill;
}

?>

<html>
    <head>
        <title>Welcome to Crazy Eddie's Pill-porium!</title>
    </head>
    <h2> Welcome  <?=$_SESSION['loginName']?>  </h2>
    <form method="get">
    <input type="text" name="filterByPrice"  size="15" maxlength="25" placeholder="Price less than"/>;
    <input type="submit" name="filter" value="Filter by price">
    </form>
    <form action="cart.php" method="get">
    <table border>
    <tr><th>Select</th><th>Name</th><th>Price</th><th>Image</th></tr>
    <?php
    foreach($pills as $pill) {
    //    echo "$j <br>"
        if ($pill -> getPrice() <= $filterByPrice) {
            echo "<tr><td>" . $pill -> showCheckbox() . "</td><td>" . $pill -> getTradeName(). "</td><td>" . $pill -> getPrice() . "</td><td>" . $pill -> showBottle(). "</td></tr>"; 
        }
            
    }
    ?>

    </table>
        <input type="submit" name="submitForm" value="Add to Cart">

</form>
</html>