<?php

require_once '../Db.conn.php';
session_start();

$sql = "TRUNCATE TABLE  commition_total";
$result = mysqli_query($conn , $sql);

header("Location: ../../AdminPanel/AllCommitions.php");


?>