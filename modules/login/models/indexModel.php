<?php
function check_employee($user_login, $password){
    global $conn;
    $password_encode =  md5($password);
    $sql = "SELECT * FROM `tbl_employee` WHERE `employee_login` = '{$user_login}' AND `password` = '{$password_encode}'";
    // $sql1 = "UPDATE `employee` SET `password` = '{$password}' WHERE `employee_id`=1";
    // mysqli_query($conn, $sql1);
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        return true;
    }else{return false;}
}