<?php
get_header();
?>

<?php
global $re_usedata;
$list_cat_post = get_list_post();
$list_cat_tree_post = data_tree($list_cat_post);
?>


<div id="page-body" class="d-flex">
    <?php get_sidebar(); ?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm bài viết
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Tiêu đề bài viết</label>
                                    <input class="form-control" type="text" name="post_name" id="name" value="<?php if (!empty($re_usedata['post_name'])) { echo set_value($re_usedata['post_name']);} else {echo '';} ?>">
                                    <?php echo form_error('post_name'); ?>
                                </div>

                            </div>

                        </div>

                        <div class="form-group">
                            <label for="intro">Chi tiết bài viết</label>
                            <textarea name="post_content" class="form-control ckeditor" id="intro" cols="60" rows="5"><?php if (!empty($re_usedata['post_content'])) { echo set_value($re_usedata['post_content']);} else {echo '';} ?></textarea>
                        </div>
                        <?php echo form_error('post_content'); ?>
                        <div class="form-group">
                            <label for="">Danh mục</label>
                            <select name="list_post" class="form-control" id="">
                                <option value="">Chọn danh mục</option>
                                <?php foreach ($list_cat_tree_post as $value) { ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo str_repeat('->', $value['level']) . $value['list_post_name']; ?></option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('list_post'); ?>
                        </div>

                        <div class="form-group">
                            <label for="">Chọn ảnh</label>
                            <div class="custom-file">
                                <input type="file" name="post_img" id="post_img" class="custom-file-input" onchange="previewImage(event)">
                                <label class="custom-file-label" for="post_img">Chọn ảnh</label>
                            </div>
                            <img id="preview" src="#" alt="Preview" style="display: none; max-width: 300px; margin-top: 10px;">
                            <?php echo form_error('post_img'); ?>
                        </div>


                        <button type="submit" name="btn_add_post" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>