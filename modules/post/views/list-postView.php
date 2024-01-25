<?php get_header() ?>
<?php $list_post = get_list_post() ?>
<?php
$total_num_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$post = page($total_num_page, $page);
$check_num_page = get_list_page_post($total_num_page);

$num_page = ceil($check_num_page / $total_num_page); ?>
<div id="page-body" class="d-flex">
    <?php get_sidebar() ?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h5 class="m-0 ">Danh sách sản phẩm</h5>
                    <div class="form-search form-inline">
                        <form action="?mod=post&controllers=index&action=search" method="POST" class="search-form">
                            <div class="input-group">
                                <input type="text" name="search-input" class="form-control search-input" placeholder="Tìm kiếm">
                                <div class="input-group-append">
                                    <button type="submit" name="btn-search" class="btn btn-primary search-button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-checkall">
                        <thead>
                            <?php if (!empty($post)) { ?>
                                <tr>

                                    <th scope="col">Stt</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Tiêu đề</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php
                                $count = 0;
                                foreach ($post as $value) {
                                    $count++ ?>

                                <tr>

                                    <td scope="row"><?php echo $count ?></td>
                                    <td><img width="80px" src="<?php echo $value['post_img'] ?>" alt=""></td>
                                    <td><a href=""><?php echo $value['post_name'] ?></a></td>
                                    <td><?php foreach ($list_post as $item) {
                                            if ($item['id'] == $value['list_post_id']) {
                                                echo $item['list_post_name'];
                                            }
                                        } ?></td>
                                    <td><?php echo $value['create_at'] ?></td>
                                    <td><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                        <a href="?mod=post&controllers=index&action=delete_post&id=<?php echo $value['id'] ?>"> <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        <?php } else { ?>
                            <p>Không có bài viết nào hiện tại</p>
                        <?php  } ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $num_page; $i++) {   ?>
                                <li class="page-item"><a class="page-link" href="?mod=post&controllers=index&action=index&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>