<?php

require_once '../Db.conn.php';
session_start();

$sql = "TRUNCATE TABLE total_expencess";
$result = mysqli_query($conn , $sql);

header("Location: ../../AdminPanel/ExpencessSummery.php");


?>