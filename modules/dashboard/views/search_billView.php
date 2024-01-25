<?php get_header() ?>
<?php $bill = get_bill();
$bill_success = get_bill_success();
$bill_cancel = get_bill_cancel();
$bill_processing = get_bill_processing();
$sales = get_sales();
$search = $_POST['search'];
$check = search_bill($search);
?>
<div id="page-body" class="d-flex">
    <?php get_sidebar() ?>
    <div id="wp-content">
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $bill_success['total'] ?></h5>
                            <p class="card-text">Đơn hàng giao dịch thành công</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                        <div class="card-header">ĐANG XỬ LÝ</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $bill_processing['total'] ?></h5>
                            <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">DOANH SỐ</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo currency_format($sales) ?></h5>
                            <p class="card-text">Doanh số hệ thống</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header">ĐƠN HÀNG HỦY</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $bill_cancel['total'] ?></h5>
                            <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                        </div>
                    </div>
                </div>
            </div>
            <form action="?mod=dashboard&controllers=index&action=search_bill" method="POST">
                <div class="input-group">
                    <input type="text" name="search" class="form-control form-search" placeholder="Tìm kiếm">
                    <div class="input-group-append">
                        <button type="submit" name="btn-search" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <p><a style="color: red;" href="">Click vào đây để quay về toàn bộ đơn hàng</a></p>

            <!-- end analytic  -->
            <div class="card">
                <div class="card-header font-weight-bold">
                    ĐƠN HÀNG MỚI
                </div>
                <div class="card-body">
                    <?php if (!empty($check)) { ?>
                        <table class="table table-striped table-checkall">
                            <thead>
                                <tr>

                                    <th scope="col">Mã</th>
                                    <th scope="col">Khách hàng</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Giá trị</th>
                                    <th scope="col">Hình thức thanh toán</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0;
                                foreach ($check as $value) { ?>
                                    <tr>


                                        <td><?php echo $value['code'] ?></td>
                                        <td>
                                            <?php echo $value['customer_name'] ?> <br>
                                            <?php echo $value['customer_number'] ?>
                                        </td>
                                        <td><a class="detail-link" href="?mod=order&controllers=index&action=detail_bill&id=<?php echo $value['id'] ?>">Click vào đây để xem chi tiết</a></td>

                                        <td><?php echo currency_format($value['total_amount']) ?></td>
                                        <?php if ($value['payment_method'] == 'payment-home') { ?>
                                            <td>Thanh toán tại nhà</td>
                                        <?php } elseif ($value['payment_method'] == 'direct-payment') { ?>
                                            <td>Thanh toán tại cửa hàng</td>
                                        <?php } ?>

                                        <?php if ($value['payment_status'] == 0) { ?>
                                            <td><span class="badge badge-warning">Đang xử lý</span></td>
                                        <?php } elseif ($value['payment_status'] == 1) { ?>
                                            <td><span class="badge badge-success">Hoàn thành</span></td>
                                        <?php } elseif ($value['payment_status'] == 2) { ?>
                                            <td><span class="badge badge-secondary">Đã hủy</span></td>
                                        <?php } ?>

                                        <td><?php echo $value['create_at'] ?></td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    <?php } else {  ?>
                        <p>Không có đơn hàng nào mà bạn vừa tìm kiếm</p>
                    <?php } ?>
                    <nav aria-label="Page navigation example">
                    
                    </nav>
                </div>
            </div>

        </div>
    </div>

</div>