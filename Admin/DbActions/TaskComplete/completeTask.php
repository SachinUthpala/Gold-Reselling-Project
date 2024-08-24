<?php

require_once '../Db.conn.php';
session_start();


if (isset($_POST['completeTask'])) {
    // Retrieve POST data
    $idTask = $_POST['taskId'];
    $id = $_POST['ID_Number'];
    $weight = $_POST['weight'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $price = (int)$_POST['price'];
    $completedBy = $_POST['userName'];

    // Jewelry image upload
    if (isset($_FILES['jewelry'])) {
        $jewelry_img = $_FILES['jewelry'];
        $j_img_name = $jewelry_img['name'];
        $j_img_tmp = $jewelry_img['tmp_name'];
        $j_img_separate = explode('.', $j_img_name);
        $file_extension = strtolower(end($j_img_separate)); // Use end() to get the last element
        $extensions = array('jpeg', 'jpg', 'png');

        if (in_array($file_extension, $extensions)) {
            $j_upload_path = '../../WebImages/JewelaryImg/' . $j_img_name;
            move_uploaded_file($j_img_tmp, $j_upload_path);
            $j_img_path = 'WebImages/JewelaryImg/' . $j_img_name;
        } else {
            echo "Jewelry file not supported";
        }
    }

    // ID image upload
    if (isset($_FILES['id_image']) ) {
        $id_img = $_FILES['id_image'];
        $id_name = $id_img['name'];
        $id_tmp = $id_img['tmp_name'];
        $id_separate = explode('.', $id_name);
        $file_extension = strtolower(end($id_separate));
        $extensions = array('jpeg', 'jpg', 'png');

        if (in_array($file_extension, $extensions)) {
            $id_upload_path = '../../WebImages/UserId/' . $id_name;
            move_uploaded_file($id_tmp, $id_upload_path);
            $id_img_path = 'WebImages/UserId/' . $id_name;
        } else {
            echo "ID file not supported";
        }
    }

    // Receipt image upload
    if (isset($_FILES['recipt_image']) ) {
        $recit_img = $_FILES['recipt_image'];
        $recit_name = $recit_img['name'];
        $recit_tmp = $recit_img['tmp_name'];
        $recit_separate = explode('.', $recit_name);
        $file_extension = strtolower(end($recit_separate));
        $extensions = array('jpeg', 'jpg', 'png');

        if (in_array($file_extension, $extensions)) {
            $recit_upload_path = '../../WebImages/Recepts/' . $recit_name;
            move_uploaded_file($recit_tmp, $recit_upload_path);
            $recit_img_path = 'WebImages/Recepts/' . $recit_name;
        } else {
            echo "Receipt file not supported";
        }
    }

    if($price <= 49999){
        $commition = 0;
    }else if($price > 49999 &&  $price <=99999){
        $commition = 1000;
    }else if($price > 99999 && $price <= 149999){
        $commition = 1500;
    }else if($price > 149999 && $price <= 199999){
        $commition = 2000;
    }else if($price > 199999 && $price <= 249999){
        $commition = 2500;
    }else if($price > 249999 && $price <= 299999){
        $commition = 3000;
    }else if($price > 299999 && $price <= 349999){
        $commition = 3500;
    }else if($price > 349999 && $price <= 399999){
        $commition = 4000;
    }else if($price > 399999 && $price <= 449999){
        $commition = 4500;
    }else if($price > 449999 && $price <= 499999){
        $commition = 5000;
    }else{
        $commition = 5000;
    }

    $sql = "INSERT INTO `complete_task`(`IdNumber`,`weight`,`price`,`commition`, `jewelryImg`, `Id_image`, `receipt_img`, `taskID`, `compteled_date`, `completedTime`) 
    VALUES ('$id' , '$weight' ,'$price','$commition', '$j_img_path' ,'$id_img_path' ,'$recit_img_path' ,'$idTask' ,'$date' ,'$time')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Task completed successfully";

        $sql_taskUpdate = "UPDATE `task` SET `completion`= 2 WHERE  `task_id` = $idTask";
        $result_taskUpdate = mysqli_query($conn, $sql_taskUpdate);

        $checkCommition_sql = "SELECT `completedBy` FROM commition_total WHERE completedBy = '$completedBy'";
        $resultCheckCommition = mysqli_query($conn , $checkCommition_sql);
        
        if( $resultCheckCommition->num_rows > 0){
            $updaateCommitionsql =  "UPDATE commition_total
                                        SET Commition = Commition + $commition
                                        WHERE completedBy = '$completedBy'";
            $resultUpdatecommi = mysqli_query($conn,$updaateCommitionsql);
        }else{
            $sql_commition = "INSERT INTO `commition_total`( `taskId`, `completedBy`, `Commition`) 
            VALUES ('$idTask' , '$completedBy' , '$commition')";
            $resultCommitions = mysqli_query($conn , $sql_commition);
        }



        header('Location: ../../AdminPanel/MyAllTask.php');
    } else {
        echo "Error: " . mysqli_error($conn);
        header('Location: ../../AdminPanel/MyAllTask.php');
    }

    



}



































// Jewelry image upload
if (isset($_FILES['jewelry_image']) ) {
    $j_img = $_FILES['jewelry_image'];
    $j_img_name = $j_img['name'];
    $j_img_tmp = $j_img['tmp_name'];
    $j_img_separate = explode('.', $j_img_name);
}















?>