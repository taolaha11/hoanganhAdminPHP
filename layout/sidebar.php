<div id="sidebar" class="bg-white">
    <ul id="sidebar-menu">
        <li class="nav-link">
            <a href="?mod=dashboard&controller=index&action=index">
                <div class="nav-link-icon d-inline-flex">
                    <i class="far fa-folder"></i>
                </div>
                Đơn hàng
            </a>
        </li>
        <li class="nav-link">
            <a href="?mod=post&controllers=index&action=index">
                <div class="nav-link-icon d-inline-flex">
                    <i class="far fa-folder"></i>
                </div>
                Bài viết
            </a>
            <i class="arrow fas fa-angle-right"></i>
            <ul class="sub-menu">
                <li><a href="?mod=post&controllers=index&action=add_post">Thêm mới</a></li>
                <li><a href="?mod=post&controllers=index&action=index">Danh sách</a></li>
                <li><a href="?mod=post&controllers=index&action=cat_post">Danh mục</a></li>
            </ul>
        </li>
        <li class="nav-link active">
            <a href="?mod=product&controllers=index&action=list_product">
                <div class="nav-link-icon d-inline-flex">
                    <i class="far fa-folder"></i>
                </div>
                Sản phẩm
            </a>
            <i class="arrow fas fa-angle-right"></i>
            <ul class="sub-menu">
                <li><a href="?mod=product&controllers=index&action=add_product">Thêm mới</a></li>
                <li><a href="?mod=product&controllers=index&action=list_product">Danh sách</a></li>
                <li><a href="?mod=product&controllers=index&action=cat_product">Danh mục</a></li>
            </ul>
        </li>
        <!-- <li class="nav-link">
            <a href="?mod=user&controllers=index&action=list_user">
                <div class="nav-link-icon d-inline-flex">
                    <i class="far fa-folder"></i>
                </div>
                Users
            </a>
            <i class="arrow fas fa-angle-right"></i>
            <ul class="sub-menu">
                <li><a href="?mod=user&controllers=index&action=add_user">Thêm mới</a></li>
                <li><a href="?mod=user&controllers=index&action=list_user">Danh sách</a></li>
            </ul>
        </li> -->
    </ul>
</div>
