<?php get_header() ?>

<?php
$id = $_GET['id'];
$bill_by_id = get_bill_by_id($id);
$product_by_bill_id = get_product_by_bill_id($id);
?>
<style>
    th,td{
        text-align: center;
    }
</style>
<div id="page-body" class="d-flex">
    <?php
    get_sidebar();
    ?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">
                <div style="padding:20px">
                    <h4>Chi tiết đơn hàng</h4>
                    <p>Mã-đơn hàng: <b><?php echo $bill_by_id['code'] ?></b></p>
                    <p>Tên khách hàng: <b><?php echo $bill_by_id['customer_name'] ?></b></p>
                    <p>Số điện thoại: <b><?php echo $bill_by_id['customer_number'] ?></b></p>
                    <p>Tổng hóa đơn: <b><?php echo currency_format($bill_by_id['total_amount']) ?></b><p>
                    <p>Trạng thái: <b>
                            <?php
                            if ($bill_by_id['payment_status'] == 0) {
                                echo "Đang xử lý đơn hàng";
                            } elseif ($bill_by_id['payment_status'] == 1) {
                                echo "Hoàn thành";
                            } else {
                                echo "Đã hủy";
                            }
                            ?>
                        </b></p>
                        <p>Ghi chú: <b><?php if(empty($bill_by_id['note'])){ echo "Không";}else{echo $bill_by_id['note'];} ?></b></p>        
                </div>
                <div id="product_bill">
                <a style="padding: 20px;" class="back" href="?mod=dashboard&controller=index&action=index"><i class="fa-solid fa-arrow-left"></i>  Quay về trang hóa đơn</a>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>

                                <th scope="col">#</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá</th>
                                <th>Tổng giá đã mua với sản phẩm này </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0;
                            foreach ($product_by_bill_id as $value) {
                                $count++; ?>
                                <tr>

                                    <td><?php echo $count ?></td>
                                    <td><img width="40px" src="<?php echo $value['product_img'] ?>" alt=""></td>
                                    <td><a href="#"><?php echo $value['product_name'] ?></a></td>
                                    <td><?php echo $value['qty'] ?></td>
                                    <td><?php echo currency_format($value['product_price']) ?></td>
                                    <td><?php echo currency_format($value['total']) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>