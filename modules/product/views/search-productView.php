<?php get_header() ?>
<?php
$total_num_row = 10;
$page  = isset($_GET['page']) ? $_GET['page'] : 1;
if(isset($_GET['search-product'])){
    $search = urldecode($_GET['search-product']);
}else{
    $search = $_POST['search-input'];
}
$product = search_product($search, $total_num_row, $page);
$num_page = search_page($search, $total_num_row);
?>

<?php $list_cat_product = get_list_cat_product() ?>
<div id="page-body" class="d-flex">
    <?php get_sidebar() ?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">  
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h5 class="m-0 ">Danh sách sản phẩm</h5>
                    <div class="form-search form-inline">
                    <form action="?mod=product&controllers=index&action=search_product" method="POST" class="search-form">
                            <div class="input-group">
                                <input type="text" name="search-input" class="form-control search-input" placeholder="Tìm kiếm(Tên hoặc mã sp)">
                                <div class="input-group-append">
                                    <button type="submit" name="search-button" class="btn btn-primary search-button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <!-- <div class="analytic">
                        <a href="" class="text-primary">Trạng thái 1<span class="text-muted">(10)</span></a>
                        <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                        <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
                    </div>
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="">
                            <option>Chọn</option>
                            <option>Tác vụ 1</option>
                            <option>Tác vụ 2</option>
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div> -->
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th scope="col">code</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($product as $value) {
                            ?>
                                <tr>
                    
                                    <td><?php echo $value['code_product'] ?></td>
                                    <td><img width="40px" src="<?php echo $value['product_img'] ?>" alt=""></td>
                                    <td><?php echo $value['product_name'] ?></td>
                                    <td><?php echo currency_format($value['product_price']) ?></td>
                                    <td><?php foreach ($list_cat_product as $cat) {
                                            if ($cat['id'] == $value['list_product_id']) {
                                                echo $cat['list_product_name'];
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $value['create_at'] ?></td>
                                    <td><span class="badge badge-success">Còn hàng</span></td>
                                    <td>
                                        <a href="?mod=product&controllers=index&action=change_product&id=<?php echo $value['product_id'] ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="?mod=product&controllers=index&action=delete_product&id=<?php echo $value['product_id'] ?>" class="btn btn-danger btn-sm rounded-0 text-white delelte-product" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php if($num_page != 0){ ?>
                            <li class="page-item">
                            </li>

                            <?php   for ($i = 1; $i <= $num_page; $i++) {   ?>
                                <li class="page-item"><a class="page-link" href="?mod=product&controllers=index&action=search_product&search-product=<?php echo $search ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php }?>
                            <?php }else{} ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>