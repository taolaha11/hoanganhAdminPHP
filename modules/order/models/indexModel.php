<?php
function get_bill()
{
    global $conn;
    $sql = "SELECT * FROM `tbl_bill`";
    $result = mysqli_query($conn, $sql);
    $bill = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $bill[] = $row;
    }
    return $bill;
}
function get_bill_by_id($id)
{
    global $conn;
    $sql = "SELECT * FROM `tbl_bill` WHERE `id` = '{$id}'";
    $result = mysqli_query($conn, $sql);
    $bill_by_id = mysqli_fetch_array($result);

    return $bill_by_id;
}

function get_product_by_bill_id($id)
{
    global $conn;
    $sql = "SELECT `product_buy` FROM `tbl_bill` WHERE `id` = '{$id}'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $product_buy = $row[0];

        // Kiểm tra nếu chuỗi JSON hợp lệ
        if (is_string($product_buy) && !empty($product_buy)) {
            $product_array = json_decode($product_buy, true);
            return $product_array;
        }
    }
    return array(); // Trả về một mảng rỗng nếu không tìm thấy dữ liệu hoặc dữ liệu không hợp lệ
}


function change_bill($value, $id){
    global $conn;
    $sql = "UPDATE `tbl_bill` SET `payment_status` = '$value' WHERE `id` = $id";
    if(mysqli_query($conn, $sql)){
        return true;
    }else{
        return false;
    }
}

function delete_bill($id){
    global $conn;
    $sql = "DELETE  FROM `tbl_bill` WHERE `id` = '{$id}'"; 
    if(mysqli_query($conn, $sql)){
        return true;
    }else{
        return false;
    }
}