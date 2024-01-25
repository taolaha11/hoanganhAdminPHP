<?php global $re_usedata; ?>
<html>

<head>
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <title>Form login unitop.vn</title>
</head>


<body>
    <div class="container">
        <h2>Đăng nhập</h2>
        <form method="POST">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" value="<?php if (!empty($re_usedata['user_login'])) { echo set_value($re_usedata['user_login']);} else {echo '';} ?>" name="user_login" placeholder="Nhập tên đăng nhập">
            <?php echo form_error('user_login') ?>
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" placeholder="Nhập mật khẩu">
            <?php echo form_error('password') ?>
            <?php echo form_error('employee_login') ?>
            <input type="submit" name="btn_login" value="Đăng nhập">
        </form>
    </div>
</body>

</html>