<?php
function get_list_cat_product()
{
    global $conn;
    $sql = "SELECT * FROM `tbl_list_product`";
    $result = mysqli_query($conn, $sql);
    $tbl_list_product = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $tbl_list_product[] = $row;
    }
    return $tbl_list_product;
}

function get_list_product()
{
    global $conn;
    $sql = "SELECT * FROM `tbl_product`";
    $result = mysqli_query($conn, $sql);
    $tbl_product = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $tbl_product[] = $row;
    }
    return $tbl_product;
}

function add_list_product($list_product_name, $parent_id)
{
    global $conn;
    global $error;
    // Kiểm tra xem list_product_name đã tồn tại hay chưa
    $sql_check = "SELECT * FROM `tbl_list_product` WHERE `list_product_name` = '{$list_product_name}'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        $error['add_list_product'] = 'Danh mục đã tồn tại';
    } else {

        // Nếu chưa tồn tại, thực hiện thêm dữ liệu vào bảng tbl_list_product
        $sql_insert = "INSERT INTO `tbl_list_product` (`list_product_name`, `parent_id`) VALUES( '{$list_product_name}', '{$parent_id}')";
        mysqli_query($conn, $sql_insert);
    }
}


function delete_list_cat_product($id)
{
    global $conn;
    $sql_delete = "DELETE FROM tbl_list_product WHERE `id` = '{$id}'";
    if (mysqli_query($conn, $sql_delete)) {
        return true;
    };
}

function delete_list_product($id)
{
    global $conn;
    $sql_delete = "DELETE FROM tbl_product WHERE `product_id` = '{$id}'";
    if (mysqli_query($conn, $sql_delete)) {
        return true;
    };
}

function add_product($product_name, $list_product, $code, $product_img, $price, $detail_product, $description_product)
{
    global $conn;
    mysqli_set_charset($conn, "utf8mb4");
    $sql_add_product = "INSERT INTO `tbl_product` (`list_product_id`, `product_name`, `code_product`, `product_price`, `product_img`, `detail_product`, `product_description`, `create_at`) VALUES ('{$list_product}', '{$product_name}', '{$code}', '{$price}', '{$product_img}', '{$detail_product}', '{$description_product}', CURRENT_TIMESTAMP())";

    if (mysqli_query($conn, $sql_add_product)) {
        return true;
    };
}



function page($total_num_page, $page)
{
    global $conn;
    $start = ($page - 1) * $total_num_page;
    $sql_show = "SELECT * FROM tbl_product LIMIT $start, $total_num_page";
    $result_show = mysqli_query($conn, $sql_show);
    $list_product = mysqli_fetch_all($result_show, MYSQLI_ASSOC);
    return $list_product;
}

function get_list_page_product($total_num_page)
{
    global $conn;
    $sql = "SELECT * FROM `tbl_list_product`";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if($count <= $total_num_page ){$count = 0;};
    return $count;
}


function get_product_by_id($id){
    global $conn;
    $sql = "SELECT * FROM `tbl_product` WHERE `product_id` = '{$id}'";
    $result = mysqli_query($conn, $sql);
    $tbl_product = mysqli_fetch_array($result);
    return $tbl_product;
}

function update_product($product_name, $list_product, $code, $product_img, $price, $detail_product, $description_product, $id)
{
    global $conn;
    mysqli_set_charset($conn, "utf8mb4");
    $sql_update_product = "UPDATE `tbl_product` SET `list_product_id` = '{$list_product}', `product_name` = '{$product_name}', `code_product` = '{$code}', `product_price` = '{$price}', `product_img` = '{$product_img}', `detail_product` = '{$detail_product}', `product_description` = '{$description_product}', `create_at` = CURRENT_TIMESTAMP() WHERE `product_id` = '{$id}'";

    if (mysqli_query($conn, $sql_update_product)) {
        return true;
    };
}


function search_product($search, $total_num_row, $page){
    global $conn;
    $search_save = mysqli_real_escape_string($conn, $search);
    $search = explode(' ', $search_save);
    $string = '';
    foreach($search as $searchs){
        $string .= "AND (`product_name` LIKE '%$searchs%' OR `code_product` LIKE  '%$searchs%')";
    }

    $string = ltrim($string, 'AND');
    $start = ($page -1) * $total_num_row;
    $sql = "SELECT * FROM `tbl_product` WHERE $string LIMIT $start, $total_num_row";
    $result = mysqli_query($conn, $sql);
    $product = array();
    while($row = mysqli_fetch_assoc($result)){
        $product[] = $row;
    }
    return $product;
}

function search_page($search, $total_num_row){
    global $conn;
    $search_save = mysqli_real_escape_string($conn, $search);
    $search = explode(' ', $search_save);
    $string = '';
    foreach($search as $searchs){
        $string .= "AND (`product_name` LIKE '%$searchs%' OR `code_product` LIKE  '%$searchs%')";
    }

    $string = ltrim($string, 'AND');
    $sql = "SELECT * FROM `tbl_product` WHERE $string";
    $result = mysqli_query($conn, $sql);
    $page = mysqli_num_rows($result);
    $num_page = ceil($page/$total_num_row);
    return $num_page;
}
