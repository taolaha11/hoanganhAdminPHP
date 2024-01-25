<?php

function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('helper', 'format');
    load('helper', 'datatree');
}

function indexAction()
{
    load_view('list-post');
}

function cat_postAction()
{
    global $error;
    global $re_usedata;
    $re_usedata = array();
    if (isset($_POST['btn_add_list_product'])) {
        $check_input = array(
            'list_post_name' => 'danh mục',
            'parent_id' => 'danh mục cha'
        );

        foreach ($check_input as $key => $value) {
            if (empty($_POST[$key]) && $_POST[$key] !== '0') {
                $error[$key] = 'Bạn chưa nhập ' . $value;
            }else{
                $re_usedata[$key] = $_POST[$key];
            }
        }

        if (empty($error)) {
            $list_post_name = htmlspecialchars($_POST['list_post_name']);
            $parent_id = $_POST['parent_id'];
            if (add_list_post($list_post_name, $parent_id)) {

                redirect('?mod=product&controllers=index&action=cat_product');
            } else {
                echo 'Lỗi';
            }
        }
    }
    load_view('cat');
}


function add_postAction()
{
    global $error;
    global $re_usedata;
    $re_usedata = array();
    if (isset($_POST['btn_add_post'])) {
        $check_input = array(
            'post_name' => 'tiêu đề bài viết',
            'post_content' => 'chi tiết sản phẩm',
            'list_post' => 'danh mục sản phẩm',
        );

        foreach ($check_input as $key => $value) {
            if (empty($_POST[$key])) {
                $error[$key] = 'Bạn chưa nhập' . ' ' . $value;
            }else{
                $re_usedata[$key] = $_POST[$key];
            }
        }

        // Kiểm tra trường 'product_img' đã được chọn hay chưa
        if (!empty($_FILES['post_img']['name'])) {
            $file_dir = "public/uploads/post/";
            $file_name = $_FILES['post_img']['name'];
            $file_path = $file_dir . $file_name;
            $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $file_type_allow  = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array(strtolower($file_type), $file_type_allow)) {
                move_uploaded_file($_FILES['post_img']['tmp_name'], $file_path);
            } else {
                $error['post_img']  = 'Bạn phải chọn tệp là ảnh';
            }
        } else {
            $error['post_img'] = 'Bạn chưa nhập ảnh';
        }

        if (empty($error)) {
            // Lấy dữ liệu up vào database
            $post_name = $_POST['post_name'];
            $post_content = $_POST['post_content'];
            $list_post = $_POST['list_post'];
            if (add_post($post_name, $list_post, $file_path,  $post_content)) {
                redirect("?mod=post&controllers=index&action=index");
            }
        }
    }
    load_view('add-post');
}
function delete_list_postAction()
{
    $id = $_GET['id'];
    if (delete_list_post($id)) {
        redirect('?mod=post&controllers=index&action=cat_post');
    }
}

function delete_postAction()
{
    $id = $_GET['id'];
    $post=get_post();
    if (delete_post($id)) {
        foreach ($post as $value) {
            if ($value['id'] === $id) {
                $img_path  = $value['post_img'];
                unlink($img_path);
            }
        }
        redirect('?mod=post&controllers=index&action=index');
    }
}

function searchAction()
{
    if (isset($_POST['btn-search']) || isset($_GET['search-post'])) {
        if(empty($_POST['search-input'])&& !isset($_GET['search-post'])){
            echo "<script>alert('Bạn không được để trống trường này')</script>";
            echo "<script> window.location.href = '?mod=post&controllers=index&action=index'</script>";
        }else{
            load_view('search-post');
        }

    }else{
        redirect("?mod=post&controllers=index&action=index");
    }
}
