<?php

require_once '../Db.conn.php';
session_start();




    $id = $_POST['expId'];
    $sql = "UPDATE `expencess` SET `approved_exp`= 0 WHERE expenxess_id = $id";
    $result = mysqli_query($conn , $sql);
    header("Location: ../../AdminPanel/AllExpencess.php");