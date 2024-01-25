<?php
function construct()
{
    load_model('index');
    load('helper', 'format');
}

function indexAction()
{

    load_view('list_order');
}

function detail_billAction()
{

    load_view('detail_list_order');
}


function change_billAction()
{
    if (isset($_POST['btn_change_bill'])) {
        $id = $_GET['id'];
        $value = $_POST['payment_status'];

        if (change_bill($value, $id)) {
            echo "<script>alert('Đã thay đổi thành công ');</script>";
            echo "<script>window.location.href = '?mod=order&controllers=index&action=change_bill&id=$id';</script>";
            exit();
        }
    }

    load_view("change_list_order");
}


function delete_billAction(){
    $id = $_GET['id'];
    if(delete_bill($id)){
        redirect("?mod=dashboard&controller=index&action=index");
    }else{
        echo "Xóa không thành công";
    }
}