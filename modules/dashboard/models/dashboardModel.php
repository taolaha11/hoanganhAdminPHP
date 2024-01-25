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

function get_bill_success()
{
    global $conn;
    $sql = "SELECT COUNT(*) AS total FROM `tbl_bill` WHERE `payment_status` = '1'";
    $result = mysqli_query($conn, $sql);
    $bill = array();
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $bill['total'] = $row['total'];
    }
    return $bill;
}

function get_bill_processing()
{
    global $conn;
    $sql = "SELECT COUNT(*) AS total FROM `tbl_bill` WHERE `payment_status` = '0'";
    $result = mysqli_query($conn, $sql);
    $bill = array();
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $bill['total'] = $row['total'];
    }
    return $bill;
}
function get_bill_cancel()
{
    global $conn;
    $sql = "SELECT COUNT(*) AS total FROM `tbl_bill` WHERE `payment_status` = '2'";
    $result = mysqli_query($conn, $sql);
    $bill = array();
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $bill['total'] = $row['total'];
    }
    return $bill;
}


function get_sales()
{
    global $conn;

    $sqlSum = "SELECT SUM(total_amount) AS total_amount FROM `tbl_bill` WHERE `payment_status` = '1'";


    $resultSum = mysqli_query($conn, $sqlSum);

    $bill = array();



    if ($resultSum && mysqli_num_rows($resultSum) > 0) {
        $rowSum = mysqli_fetch_assoc($resultSum);
        $bill['total_amount'] = $rowSum['total_amount'];
    }

    return $bill['total_amount'];
}


function search_bill($search)
{
    global $conn;
    $check = explode(' ', $search);
    $check_sql = "";
    foreach ($check as $value) {
        $check_sql .= "AND `customer_name` LIKE '%$value%' ";
    }
    $check_sql = ltrim($check_sql, 'AND');
    $sql = "SELECT * FROM `tbl_bill` WHERE `customer_number` = '$search' OR ($check_sql)";
    $result = mysqli_query($conn, $sql);
    $bill = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $bill[] = $row;
    }
    return $bill;
}

 
function page($total_num_page, $page)
{
    global $conn;
    $sql = "SELECT * FROM `tbl_bill`";
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
    $num_page = ceil($num_rows / $total_num_page);
    $start = ($page - 1) * $total_num_page;
    $sql_show = "SELECT * FROM tbl_bill LIMIT $start, $total_num_page";
    $result_show = mysqli_query($conn, $sql_show);
    $list_product = mysqli_fetch_all($result_show, MYSQLI_ASSOC);
    return $list_product;
}

function get_list_page_post($total_num_page)
{
    global $conn;
    $sql = "SELECT * FROM `tbl_bill`";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if($count <= $total_num_page ){$count = 0;};
    return $count;
}
