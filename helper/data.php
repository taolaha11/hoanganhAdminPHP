<?php

function show_array($data) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
}


function redirect($data = "") {
    if (empty($data)) {
        echo "Bạn phải cung cấp đường dẫn để chuyển hướng";
    } else {
        header("Location: $data");
        exit();
    }
}
