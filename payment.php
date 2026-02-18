<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db.php";

if (isset($_POST['name'])) {

    $name   = $_POST['name'];
    $amount = $_POST['amount'];
    $method = $_POST['method'];

    $sql = "INSERT INTO payments (name, amount, method)
            VALUES ('$name', '$amount', '$method')";

    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo mysqli_error($conn);
    }
}
?>