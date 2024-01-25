<?php

function is_username($username)
{
    if (preg_match('/^[a-zA-ZÀ-ỹ\ ]{6,32}$/u', $username)) {
        return true;
    }
    return false;
}


function is_login_name($login_name)
{
    if (preg_match('/^[A-Za-z0-9._]{6,32}$/', $login_name)) {
        return true;
    }
    return false;
}


function is_password($password)
{
    if (preg_match('/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/', $password)) {
        return true;
    }
    return false;
}


function is_phonenumber($phone)
{
    if (preg_match('/^[0-9]{10}$/', $phone)) {
        return true;
    }
    return false;
}

function form_error($error_check)
{
    global $error;
    if (!empty($error[$error_check])) {
        return "<p class = 'error'>{$error[$error_check]}</p>";
    }
}

function set_value($hidden_field)
{
    return $hidden_field;
}
