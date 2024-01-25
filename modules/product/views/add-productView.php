<?php
get_header();
?>
<?php
global $re_usedata;
$list_product = get_list_cat_product();
$list_cat_tree_product = data_tree($list_product);
?>



<div id="page-body" class="d-flex">
    <?php get_sidebar(); ?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm sản phẩm
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Tên sản phẩm</label>
                                    <input class="form-control" type="text" name="product_name" id="name" value="<?php if (!empty($re_usedata['product_name'])) { echo set_value($re_usedata['product_name']);} else {echo '';} ?>">
                                    <?php echo form_error('product_name'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="name">Giá</label>
                                    <input class="form-control" type="text" name="price" id="name" value="<?php if (!empty($re_usedata['price'])) { echo set_value($re_usedata['price']);} else {echo '';} ?>">
                                    <?php echo form_error('price'); ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="intro">Chi tiết sản phẩm</label>
                                    <textarea name="detail_product" class="form-control" id="intro" cols="30" rows="5"><?php if (!empty($re_usedata['detail_product'])) { echo set_value($re_usedata['detail_product']);} else {echo '';} ?></textarea>
                                    <?php echo form_error('detail_product'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="intro">Mô tả sản phẩm tiết sản phẩm</label>
                            <textarea name="description_product" class="form-control ckeditor" id="intro" cols="30" rows="5"><?php if (!empty($re_usedata['description_product'])) { echo set_value($re_usedata['description_product']);} else {echo '';} ?></textarea>
                            <?php echo form_error('description_product') ?>
                        </div>
                        <div class="form-group">
                            <label for="name">Mã sản phẩm</label>
                            <input class="form-control" type="text" name="code" id="name" value="<?php if (!empty($re_usedata['code'])) { echo set_value($re_usedata['code']);} else {echo '';} ?>">
                            <?php echo form_error('code'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Danh mục</label>
                            <select name="list_product" class="form-control" id="">
                                <option value="">Chọn danh mục</option>
                                <?php foreach ($list_cat_tree_product as $value) { ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo str_repeat('->', $value['level']) . $value['list_product_name']; ?></option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('list_product'); ?>
                        </div>

                        <div class="form-group">
                            <label for="">Chọn ảnh</label>
                            <div class="custom-file">
                                <input type="file" name="product_img_add" id="product_img" class="custom-file-input" onchange="previewImage(event)">
                                <label class="custom-file-label" for="product_img">Chọn ảnh</label>
                            </div>
                            <img id="preview" src="#" alt="Preview" style="display: none; max-width: 300px; margin-top: 10px;">
                            <?php echo form_error('product_img'); ?>
                        </div>

                        <!-- <div class="form-group">
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
                        </div> -->

                        <button type="submit" name="btn_add_product" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>