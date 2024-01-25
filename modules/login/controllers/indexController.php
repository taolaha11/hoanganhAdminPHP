<?php

function construct()
{

    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

function loginAction()
{
    global $error;
    global $re_usedata;
    $re_usedata = array();
    $input = array(
        'user_login' => 'tên đăng nhập',
        'password' => 'mật khẩu',
    );
    if (isset($_POST['btn_login'])) {

        $error = array();
        foreach ($input as $key => $value) {
            if (empty($_POST[$key])) {
                $error[$key] = 'Bạn chưa nhập ' . $value;
            } else {
                $re_usedata[$key] = $_POST[$key];
            }
        }

        if (!empty($_POST['user_login'])) {
            if (!is_login_name($_POST['user_login'])) {
                $error['user_login'] = 'Tên chỉ được viết từ A-z, 0-9 không được cách và 6-32 ký tự';
            }
        }
        if (!empty($_POST['password'])) {
            if (!is_password($_POST['password'])) {
                $error['password'] = 'Chữ cái đầu tiên phải viết Hoa và dài từ 6-32 ký tự';
            }
        }

        // nếu không có lỗi gì thì add dữ liệu database
        if (empty($error)) {
            $user_login = $_POST['user_login'];
            $password = $_POST['password'];


            if (check_employee($user_login, $password)) {
    
                $_SESSION['is_login'] = true;
                $_SESSION['info_admin'] = $user_login;
                redirect('?mod=dashboard&controllers=index&action=index');
            } else {
                $error['employee_login'] = "tài khoản hoặc mật khẩu không đúng";
            }
        }
    }
    load_view('index');
}


function logoutAction(){
    unset($_SESSION['is_login']);
    unset( $_SESSION['info_admin']);
    redirect('?mod=login&controllers=index&action=login');
}