<?php

require_once '../Db.conn.php';
session_start();

if(isset($_POST['createTask'])){
    $date = date('Y-m-d');
    $userID = (int)$_POST['userID'];
    $exType = $_POST['expences_type'];
    $amount = (int)$_POST['amount'] * 6;
    $userName = $_POST['userNAme'];
    $image = $_FILES['image'];

    $findUserAvailableSql = "SELECT * FROM total_expencess WHERE userID = '$userID'";
    $resultAvailableSql = mysqli_query($conn , $findUserAvailableSql);
    
    if($resultAvailableSql->num_rows > 0){
        $sqlForTotal = "SELECT amount FROM total_expencess WHERE userID = '$userID'";
        $TotalResult = mysqli_query($conn , $sqlForTotal);
        $totalFeeRow = $TotalResult->fetch_assoc();
    
        $totalFee_last = (int)$totalFeeRow['amount'] + (int)$amount; 

        $sqlForUpdateTotal = "UPDATE `total_expencess` SET `amount`='$totalFee_last' WHERE userID = '$userID'";
        $sqlForUpdateTotal_result = mysqli_query($conn , $sqlForUpdateTotal);

        // ///////////////////////
        if (isset($_FILES['image'])) {
            $jewelry_img = $_FILES['image'];
            $j_img_name = $jewelry_img['name'];
            $j_img_tmp = $jewelry_img['tmp_name'];
            $j_img_separate = explode('.', $j_img_name);
            $file_extension = strtolower(end($j_img_separate)); // Use end() to get the last element
            $extensions = array('jpeg', 'jpg', 'png');
    
            if (in_array($file_extension, $extensions)) {
                $j_upload_path = '../../WebImages/expencess/' . $j_img_name;
                move_uploaded_file($j_img_tmp, $j_upload_path);
                $j_img_path = 'WebImages/expencess/' . $j_img_name;

                $sqlInsertExpences = "INSERT INTO `expencess`( `user_id`, `expencess_type`, `amount`, `date` , `reciptImg`) 
                VALUES ('$userID' , '$exType' , '$amount' , '$date' , '$j_img_path' )";
                $resultsqlInsertExpences = mysqli_query($conn , $sqlInsertExpences);
            } else {
                echo "Jewelry file not supported";
            }
        }
        // ///////////////////////

        

    }else{
        $sqlInsetUerEx = "INSERT INTO `total_expencess`(`userID`, `userName`, `amount`) 
        VALUES ('$userID' , '$userName' , $amount)";
        $resultsqlInsetUerEx = mysqli_query($conn , $sqlInsetUerEx);


        // ///////////////////////
        if (isset($_FILES['image'])) {
            $jewelry_img = $_FILES['image'];
            $j_img_name = $jewelry_img['name'];
            $j_img_tmp = $jewelry_img['tmp_name'];
            $j_img_separate = explode('.', $j_img_name);
            $file_extension = strtolower(end($j_img_separate)); // Use end() to get the last element
            $extensions = array('jpeg', 'jpg', 'png');
    
            if (in_array($file_extension, $extensions)) {
                $j_upload_path = '../../WebImages/expencess/' . $j_img_name;
                move_uploaded_file($j_img_tmp, $j_upload_path);
                $j_img_path = 'WebImages/expencess/' . $j_img_name;

                $sqlInsertExpences = "INSERT INTO `expencess`( `user_id`, `expencess_type`, `amount`, `date` , `reciptImg`) 
                VALUES ('$userID' , '$exType' , '$amount' , '$date' , '$j_img_path' )";
                $resultsqlInsertExpences = mysqli_query($conn , $sqlInsertExpences);
            } else {
                echo "Jewelry file not supported";
            }
        }
        // ///////////////////////
    }

        $_SESSION['TaskCreated'] = 1;
        header("Location: ../../AdminPanel/CreateExpencess.php");
        echo "Task Created Successfully";

    





}


?>