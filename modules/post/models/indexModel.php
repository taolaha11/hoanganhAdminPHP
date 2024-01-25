<?php
function get_list_post()
{
    global $conn;
    $sql = "SELECT * FROM `tbl_list_post`";
    $result = mysqli_query($conn, $sql);
    $tbl_list_post = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $tbl_list_post[] = $row;
    }
    return $tbl_list_post;
}

function get_post()
{
    global $conn;
    $sql = "SELECT * FROM `tbl_post`";
    $result = mysqli_query($conn, $sql);
    $tbl_post = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $tbl_post[] = $row;
    }
    return $tbl_post;
}




function add_list_post($list_post_name, $parent_id)
{
    global $conn;
    global $error;
    // Kiểm tra xem list_product_name đã tồn tại hay chưa
    $sql_check = "SELECT * FROM `tbl_list_post` WHERE `list_post_name` = '{$list_post_name}'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        $error['add_list_post'] = 'Danh mục đã tồn tại';
    }else{

    // Nếu chưa tồn tại, thực hiện thêm dữ liệu vào bảng tbl_list_product
    $sql_insert = "INSERT INTO `tbl_list_post` (`list_post_name`, `parent_id`) VALUES( '{$list_post_name}', '{$parent_id}')";
    mysqli_query($conn, $sql_insert);
    }
}


function delete_list_post($id){
    global $conn;
    $sql_delete = "DELETE FROM tbl_list_post WHERE `id` = '{$id}'";
    if(mysqli_query($conn, $sql_delete)){
        return true;
    };
}

function delete_post($id){
    global $conn;
    $sql_delete = "DELETE FROM tbl_post WHERE `id` = '{$id}'";
    if(mysqli_query($conn, $sql_delete)){
        return true;
    };
}

function add_post($post_name, $list_post, $post_img, $post_content){
    global $conn;
    mysqli_set_charset($conn, "utf8mb4");
    $sql_add_post = "INSERT INTO `tbl_post` (`post_name`, `list_post_id`,   `post_img`, `post_content`, `create_at`) VALUES ('{$post_name}','{$list_post}','{$post_img}', '{$post_content}', CURDATE())";
    if(mysqli_query($conn, $sql_add_post)){
        return true;
    };
}



function page($total_num_page, $page)
{
    global $conn;
    $sql = "SELECT * FROM `tbl_post`";
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
    $num_page = ceil($num_rows / $total_num_page);
    $start = ($page - 1) * $total_num_page;
    $sql_show = "SELECT * FROM tbl_post LIMIT $start, $total_num_page";
    $result_show = mysqli_query($conn, $sql_show);
    $list_product = mysqli_fetch_all($result_show, MYSQLI_ASSOC);
    return $list_product;
}

function get_list_page_post($total_num_page)
{
    global $conn;
    $sql = "SELECT * FROM `tbl_list_post`";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    return $count;
}




function search_post($search, $total_num_row, $page){
    global $conn;
    $search_save = mysqli_real_escape_string($conn, $search);
    $search = explode(' ', $search_save);
    $string = '';
    foreach($search as $searchs){
        $string .= "AND `post_name` LIKE '%$searchs%'";
    }

    $string = ltrim($string, 'AND');
    $start = ($page -1) * $total_num_row;
    $sql = "SELECT * FROM `tbl_post` WHERE $string LIMIT $start, $total_num_row";
    $result = mysqli_query($conn, $sql);
    $post = array();
    while($row = mysqli_fetch_assoc($result)){
        $post[] = $row;
    }
    return $post;
}

function search_page($search, $total_num_row){
    global $conn;
    $search_save = mysqli_real_escape_string($conn, $search);
    $search = explode(' ', $search_save);
    $string = '';
    foreach($search as $searchs){
        $string .= "AND `post_name` LIKE '%$searchs%'";
    }

    $string = ltrim($string, 'AND');
    $sql = "SELECT * FROM `tbl_post` WHERE $string";
    $result = mysqli_query($conn, $sql);
    $page = mysqli_num_rows($result);
    $num_page = ceil($page/$total_num_row);
    return $num_page;
}
