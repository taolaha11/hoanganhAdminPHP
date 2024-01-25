<?php

function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('helper', 'format');
    load('helper', 'datatree');
}



function list_productAction()
{
    load_view('list-product');
}


function add_productAction()
{
    global $error;
    global $re_usedata;
    $re_usedata = array();
    if (isset($_POST['btn_add_product'])) {
        $check_input = array(
            'product_name' => 'tên sản phẩm',
            'price' => 'giá',
            'detail_product' => 'chi tiết sản phẩm',
            'list_product' => 'danh mục sản phẩm',
            'description_product' => 'mô tả sản phẩm',
            'code' => 'mã sản phẩm'
        );

        foreach ($check_input as $key => $value) {
            if (empty($_POST[$key])) {
                $error[$key] = 'Bạn chưa nhập' . ' ' . $value;
            } else {
                $re_usedata[$key] = $_POST[$key];
            }
        }

        // Kiểm tra trường 'product_img' đã được chọn hay chưa
        if (!empty($_FILES['product_img_add']['name'])) {
            $file_dir = "public/uploads/product/";
            $file_name = $_FILES['product_img_add']['name'];
            $file_path = $file_dir . $file_name;
            $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $file_type_allow  = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array(strtolower($file_type), $file_type_allow)) {
                move_uploaded_file($_FILES['product_img_add']['tmp_name'], $file_path);
            } else {
                $error['product_img']  = 'Bạn phải chọn tệp là ảnh';
            }
        } else {
            $error['product_img'] = 'Bạn chưa nhập ảnh';
        }

        if (empty($error)) {
            // Lấy dữ liệu up vào database
            $product_name = $_POST['product_name'];
            $price = $_POST['price'];
            $description_product = $_POST['description_product'];
            $detail_product = $_POST['detail_product'];
            $list_product = $_POST['list_product'];
            $code = $_POST['code'];

            if (add_product($product_name, $list_product, $code, $file_path, $price, $detail_product, $description_product)) {
                redirect("?mod=product&controllers=index&action=list_product");
            }
        }
    }


    load_view('add-product');
}


function  cat_productAction()
{
    global $error;
    global $re_usedata;
    $re_usedata = array();
    if (isset($_POST['btn_add_list_product'])) {
        $check_input = array(
            'list_product_name' => 'danh mục',
            'parent_id' => 'danh mục cha'
        );

        foreach ($check_input as $key => $value) {
            if (empty($_POST[$key]) && $_POST[$key] !== '0') {
                $error[$key] = 'Bạn chưa nhập ' . $value;
            } else {
                $re_usedata[$key] = $_POST[$key];
            }
        }

        if (empty($error)) {
            $list_product_name = htmlspecialchars($_POST['list_product_name']);
            $parent_id = $_POST['parent_id'];
            if (add_list_product($list_product_name, $parent_id)) {
                echo 'Thêm thành công';
                // redirect('?mod=product&controllers=index&action=cat_product');
            } else {
                echo 'Lỗi';
            }
        }
    }

    load_view('cat-product');
}


function delete_catAction()
{
    $id = $_GET['id'];
    if (delete_list_cat_product($id)) {
        redirect('?mod=product&controllers=index&action=cat_product');
    }
}


function delete_productAction()
{;
    $id = $_GET['id'];
    $list_product = get_list_product();
    show_array($list_product);

    if (delete_list_product($id)) {
        foreach ($list_product as $value) {
            if ($value['product_id'] === $id) {
                $img_path  = $value['product_img'];
                unlink($img_path);
            }
        }
        redirect('?mod=product&controllers=index&action=list_product');
    }
}


function change_productAction()
{
    global $error;
    global $re_usedata;
    $id = $_GET['id'];
    $re_usedata = array();
    if (isset($_POST['btn_change_product'])) {


        $product_by_id = get_product_by_id($id);
        $check_input = array(
            'product_name' => 'tên sản phẩm',
            'price' => 'giá',
            'detail_product' => 'chi tiết sản phẩm',
            'list_product' => 'danh mục sản phẩm',
            'description_product' => 'mô tả sản phẩm',
            'code' => 'mã sản phẩm'
        );

        foreach ($check_input as $key => $value) {
            if (empty($_POST[$key])) {
                $error[$key] = 'Bạn chưa nhập' . ' ' . $value;
            } else {
                $re_usedata[$key] = $_POST[$key];
            }
        }

        // Kiểm tra trường 'product_img' đã được chọn hay chưa
        if (!empty($_FILES['product_img']['name'])) {
            $file_dir = "public/uploads/product/";
            $file_name = $_FILES['product_img']['name'];
            $file_path = $file_dir . $file_name;
            $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $file_type_allow  = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array(strtolower($file_type), $file_type_allow)) {
                move_uploaded_file($_FILES['product_img']['tmp_name'], $file_path);
            } else {
                $error['product_img']  = 'Bạn phải chọn tệp là ảnh';
            }
        } else {
            $file_path = $product_by_id['product_img'];
        }

        if (empty($error)) {
            // Lấy dữ liệu up vào database
            $product_name = $_POST['product_name'];
            $price = $_POST['price'];
            $description_product = $_POST['description_product'];
            $detail_product = $_POST['detail_product'];
            $list_product = $_POST['list_product'];
            $code = $_POST['code'];

            if (update_product($product_name, $list_product, $code, $file_path, $price, $detail_product, $description_product, $id)) {
                redirect("?mod=product&controllers=index&action=list_product");
            }
        }
    }
    load_view("change-product");
}


function search_productAction()
{
    if (isset($_POST['search-button']) || isset($_GET['search-product'])) {
        if(empty($_POST['search-input'])&& !isset($_GET['search-product'])){
            echo "<script>alert('Bạn không được để trống trường này')</script>";
            echo "<script> window.location.href = '?mod=product&controllers=index&action=list_product'</script>";
        }else{
            load_view('search-product');
        }

    }else{
        redirect("?mod=product&controllers=index&action=list_product");
    }
}
