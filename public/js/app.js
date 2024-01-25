$(document).ready(function () {
    // Hàm để xử lý sự kiện nhấp vào danh mục
    function handleNavClick() {
        // Loại bỏ lớp "active" từ tất cả các danh mục
        $('.nav-link').removeClass('active');

        // Thêm lớp "active" vào danh mục được nhấp vào
        $(this).addClass('active');

        // Toggle lớp "fa-angle-right" và "fa-angle-down" của phần tử "arrow" bên trong phần tử có lớp "nav-link"
        var arrow = $(this).find('.arrow');
        arrow.toggleClass('fa-angle-right fa-angle-down');

        // Lưu trạng thái của phần tử "arrow" vào Local Storage
        var arrowState = arrow.hasClass('fa-angle-down');
        localStorage.setItem('arrowState', arrowState);

        // Lưu trạng thái của danh mục vào Local Storage
        localStorage.setItem('activeCategory', $(this).text());
    }



    // Gọi hàm khôi phục trạng thái danh mục
    restoreActiveCategory();

    // Xử lý sự kiện nhấp vào danh mục
    $('.nav-link').click(handleNavClick);

    // Xử lý sự kiện nhấp vào mũi tên

    $('#sidebar-menu .arrow').click(function () {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });


    $("input[name='checkall']").click(function () {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });

    //  form đăng nhập
    $('#eye').click(function () {
        $(this).toggleClass('open');
        $(this).children('i').toggleClass('fa-eye-slash fa-eye');
        if ($(this).hasClass('open')) {
            $(this).prev().attr('type', 'text');
        } else {
            $(this).prev().attr('type', 'password');
        }
    });

    // Hàm để khôi phục trạng thái danh mục từ localStorage
    function restoreActiveCategory() {
        var activeCategory = localStorage.getItem('activeCategory');
        if (activeCategory) {
            $('.nav-link').removeClass('active');
            $('.nav-link:contains(' + activeCategory + ')').addClass('active');
            $('.nav-link.active .sub-menu').slideDown();
        }
    }


    $(".delete_bill").click(function (e) {
        e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết

        Swal.fire({
            title: "Xóa sản phẩm",
            text: "Bạn có chắc chắn muốn xóa sản phẩm không",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Xóa Đơn hàng",
            cancelButtonText: "Không xóa",
        }).then((result) => {
            if (result.isDismissed) {
                // Chuyển hướng tới trang giỏ hàng
                // window.location.href = $(this).attr('href');

            } else {
                // Thêm sản phẩm vào giỏ hàng
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function () {
                        Swal.fire("Xóa đơn hàng", "Xóa đơn hàng thành công", "success").then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload(); // Tải lại trang
                            }
                        });
                    },
                    error: function () {
                        Swal.fire("Lỗi", "Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng", "error");
                    }
                });
            }
        });
    });
    $(".delelte-product").click(function (e) {
        e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết

        Swal.fire({
            title: "Xóa sản phẩm",
            text: "Bạn có chắc chắn muốn xóa sản phẩm không",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Xóa sản phẩm",
            cancelButtonText: "Không xóa",
        }).then((result) => {
            if (result.isDismissed) {
                // Chuyển hướng tới trang giỏ hàng
                // window.location.href = $(this).attr('href');

            } else {
                // Thêm sản phẩm vào giỏ hàng
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function () {
                        Swal.fire("Xóa đơn hàng", "Xóa đơn hàng thành công", "success").then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload(); // Tải lại trang
                            }
                        });
                    },
                    error: function () {
                        Swal.fire("Lỗi", "Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng", "error");
                    }
                });
            }
        });
    });

});


function previewImage(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var previewElement = document.getElementById("preview");
            previewElement.src = e.target.result;
            previewElement.style.display = "block";
        };

        reader.readAsDataURL(input.files[0]);
    }
}


