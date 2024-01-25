<?php

function randomToken() {
    $token = rand(100000, 999999);
    $expiration = time() + 300; // Hiệu lực trong 60 giây

    // Lưu token và thời gian hết hạn vào cơ sở dữ liệu hoặc lưu vào session
    // Ví dụ:
    // $_SESSION['token'] = $token;
    // $_SESSION['expiration'] = $expiration;

    return $token;
}