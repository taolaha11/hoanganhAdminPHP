<?php
get_header();
?>

<?php 
global $re_usedata;
$list_cat_product = get_list_cat_product();
$list_cat_tree_product = data_tree($list_cat_product);
?>


<div id="page-body" class="d-flex">
    <?php get_sidebar() ?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            Danh mục sản phẩm
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="name">Tên danh mục</label>
                                    <input class="form-control" type="text" name="list_product_name" id="name" value="<?php if (!empty($re_usedata['list_product_name'])) { echo set_value($re_usedata['list_product_name']);} else {echo '';} ?>">
                                    <?php echo form_error('list_product_name') ?>
                                    <?php echo form_error('add_list_product') ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Danh mục cha</label>
                                    <select class="form-control" name="parent_id" id="">
                                        <option value="">Chọn danh mục</option>
                                        <option value="0">Không thuộc danh mục cha nào</option>
                                        <?php foreach ($list_cat_tree_product as $value) { ?>
                                            <option value=<?php echo $value['id'] ?>><?php echo str_repeat('->', $value['level']).$value['list_product_name'] ?></option>
                                        <?php } ?>
                                    </select>

                                    <?php echo form_error('parent_id') ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng thái</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Chờ duyệt
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Công khai
                                        </label>
                                    </div>
                                </div>



                                <input type="submit" name="btn_add_list_product" class="btn btn-primary" value="Thêm mới">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            Danh sách
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">tên danh mục</th>
                                        <th scope="col">danh mục cha</th>

                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 0;
                                    foreach ($list_cat_tree_product as $value) {
                                        $count++ ?>
                                        <tr>
                                            <th scope="row"><?php echo $count ?></th>
                                            <td><?php  echo str_repeat('->', $value['level']).$value['list_product_name'] ?></td>
                                            <td>
                                                <?php
                                                if ($value['parent_id'] == 0) {
                                                    echo 'Không';
                                                }
                                                foreach ($list_cat_tree_product as $key) {

                                                    if ($value['parent_id'] == $key['id']) {
                                                        echo $key['list_product_name'];
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td><a href="?mod=product&controllers=index&action=delete_cat&id=<?php echo $value['id'] ?>">xóa</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>