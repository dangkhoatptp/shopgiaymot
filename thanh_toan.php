<?php
    session_start();
    ob_start();

    $conn = mysqli_connect("localhost", "root", "", "dbmot");
    mysqli_set_charset($conn, "utf-8");
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!-- Icon và tên cửa sổ -->
            <link rel="shortcut icon" type="image/png" href="./images/logo-da-cat-nen-den.png"/>
            <title>Giỏ hàng | MỘT</title>

            <!-- Css nhà làm -->
            <link rel="stylesheet" href="./css/css_chung.css">
            <link rel="stylesheet" href="./css/css_mau.css">
            <link rel="stylesheet" href="./css/main_thanhtoan.css">

            <!-- Css icon -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

            <!-- Font chữ có sẵn -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        </head>
        <body>
            <!-- 

                ----------------------------HEADER---------------------------

             -->
            <div class="header">
                <div class="header__header-1">
                    <div class="header-1__left-nemu">
                        <ul class="left-menu__menu">
                            <li class="menu__item"><a href="cauchuyen.php" class="item__text">câu chuyện</a></li>
                            <li class="menu__item"><a href="shop.php" class="item__text">shop</a></li>
                            <li class="menu__item"><a href="noiban.php" class="item__text">Một & nơi bán</a></li>
                        </ul>
                    </div>
                    <a href="trangchu.php" class="header-1__logo"></a>
                    <div class="header-1__right-menu">
                        <ul class="right-menu__menu">
                            <li class="menu__item"><a href="trogiup_mangsizenaovua.php" class="item__text">trợ giúp</a></li>
                            <?php
                                $countProductInCart = 0;
                                $href = null;
                                if($_SESSION['login'] == "true") {
                                    $id_account = $_SESSION['id_account'];
                                    $sql = "SELECT * FROM giohang WHERE id_taikhoan = '$id_account'";
                                    $rows = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_assoc($rows)) {
                                        $countProductInCart = $countProductInCart + $row['soluong'];
                                    }

                                    $href = "giohang.php";
                                } else if($_SESSION['login'] == "false") {
                                    $href = "dangnhap.php?linkpage=shop";
                                }
                            ?>
                            <li class="menu__item"><a href="<?php echo $href; ?>" class="item__text" name="buttonClickCart">giỏ hàng (<?php echo $countProductInCart; ?>)</a></li>
                            <?php
                                if($_SESSION["login"] == "false") {
                                    echo '<li class="menu__item" style="display: block;"><span onclick="login(\'trangchu\')" class="item__text">đăng nhập</span></li>';
                                } else {
                                    $avatar = $_SESSION['avatar'];
                                    
                                    echo '<li class="menu__item" style="border-bottom: none;">';
                                    echo '<div class="item__avatar">';
                                    if($_SESSION['avatar'] == null || $_SESSION['avatar'] == "") {
                                        echo '<i class="fa-solid fa-user icon"></i>';
                                    } else {
                                        $id_account = $_SESSION['id_account'];
                                        
                                        $sql = "SELECT * FROM thongso_avatar WHERE id_taikhoan = $id_account";
                                        $result = mysqli_query($conn, $sql);
                                        
                                        $row = mysqli_fetch_assoc($result);
                                        
                                        $width = $row['chieurong_goc'];
                                        $height = $row['chieudai_goc'];
                                        $left = $row['trai_goc'];
                                        $top = $row['tren_goc'];
                                        
                                        $widthIcon = $width * 17 / 100;
                                        $heightIcon = $height * 17 / 100;
                                        $leftIcon = $left * 17 / 100;
                                        $topIcon = $top * 17 / 100;
                                        
                                        echo "<img class=\"avatar__avatar\" src=\"./avatar/$avatar\" style=\"width: $widthIcon"."px; "."height: $heightIcon"."px; "."left: $leftIcon"."px; "."top: $topIcon"."px;\">";
                                    }
                                        echo '</div>';
                                        echo '<div class="item__options">';
                                            echo '<ul>';
                                                echo '<li onclick="nextPage(\'thongtintaikhoan\');">thông tin tài khoản</li>';
                                                echo '<li onclick="logout(\'shop\');">đăng xuất</li>';
                                            echo '</ul>';
                                        echo '</div>';
                                    echo '</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="header__box"></div>
                <a href="" class="header__header-2">Thanh toán</a>
            </div>
            <!-- 

                ---------------------------BODY-------------------------------

             -->
            <div class="body">
                <div class="box__container">
                    <div class="container__title">Thông tin thanh toán</div>
                    <form class="container__form-info-pay" action="">
                        <div class="form-info-pay__group">
                            <label for="input-info-pay__fullname" class="group__label-info-pay">Họ tên</label>
                            <input type="text" class="group__input-info-pay" name="input-info-pay__fullname" value="<?php echo $_SESSION['fullname']; ?>" required>
                        </div>
                        <div class="form-info-pay__group">  
                            <label for="input-info-pay__email" class="group__label-info-pay">Địa chỉ Email</label>
                            <input type="text" class="group__input-info-pay" name="input-info-pay__email" value="<?php echo $_SESSION['email']; ?>" required>
                        </div>
                        <div class="form-info-pay__group">
                            <label for="input-info-pay__phonenumber" class="group__label-info-pay">Số điện thoại</label>
                            <input type="text" class="group__input-info-pay" name="input-info-pay__phonenumber" value="<?php echo $_SESSION['phonenumber']; ?>" required>
                        </div>
                        <div class="form-info-pay__group">
                            <label for="input-info-pay__address" class="group__label-info-pay">Địa chỉ</label>
                            <input type="text" class="group__input-info-pay" name="input-info-pay__address" value="<?php echo $_SESSION['address']; ?>" required>
                        </div>
                    </form>
                </div>
                <div class="box__container">
                    <div class="container__title">Đơn hàng của bạn</div>
                    <table class="container__table-bill" rules="rows" frame="box">
                        <tr>
                            <td><b>Sản phẩm</b></td>
                            <td><b>Tạm tính</b></td>
                        </tr>
                        <?php
                            $id_account = $_SESSION['id_account'];
                            $sql = "SELECT * FROM giohang WHERE id_taiKhoan = $id_account";
                            $rows = mysqli_query($conn, $sql);

                            $tong = 0;

                            while($row = mysqli_fetch_assoc($rows)) {
                                $id_giay = $row['id_giay'];
                                $id_size = $row['id_size'];
                                $soLuong = $row['soluong'];

                                $sql = "SELECT * FROM giay WHERE id_giay = $id_giay";
                                $result = mysqli_query($conn, $sql);
                                $temp = mysqli_fetch_assoc($result);

                                $tengiay = $temp['tengiay'];
                                $gia = $temp['gia'];

                                $tamtinh = $soLuong * $gia;
                                $tong = $tong + $tamtinh;
                                $size = $id_size + 34;

                                echo '<tr>';
                                    echo "<td>$tengiay, $size <b>x$soLuong</b></td>";
                                    echo "<td>".number_format($tamtinh, 0, '.', ',')." VND</td>";
                                echo '</tr>';
                            }
                        ?>
                        <tr>
                            <td><b>Tạm tính</b></td>
                            <td><b><?php echo number_format($tong, 0, '.', ','); ?> VND</b></td>
                        </tr>
                        <tr>
                            <td><b>Giao hàng</b></td>
                            <td>
                                <b>Giao hàng miễn phí</b><br>
                                3-5 ngày làm việc
                            </td>
                        </tr>
                        <tr>
                            <td><b>Tổng</b></td>
                            <td><b><?php echo number_format($tong, 0, '.', ','); ?> VND</b></td>
                        </tr>
                    </table>
                    <div class="container__payment-methods">
                            <div class="payment-methods__item">
                                <input class="item__input" type="radio" name="method" checked>
                                <label class="item__label" for="">thanh toán khi nhận hàng</label>
                            </div>
                            <div class="payment-methods__item">
                                <input type="radio" name="method">
                                <label class="item__label" for="">chuyển khoản ngân hàng</label>
                            </div>
                    </div>
                    <div class="container__button-order">ĐẶT HÀNG</div>
                </div>
            </div>
            <!-- 

                ----------------------------FOOTER------------------------------------

             -->
            <div class="footer">
                <div class="footer-1">
                    <div class="footer-1__links">
                        <a href="cauchuyen.php" class="links__link">câu chuyện</a>
                        <a href="shop.php" class="links__link">shop</a>
                    </div>
                    <div class="footer-1__links">
                        <a href="noiban.php" class="links__link">Một & nơi bán</a>
                        <a href="trogiup_mangsizenaovua.php" class="links__link">trợ giúp</a>
                    </div>
                    <div class="footer-1__icon">
                        <i class="fa-brands fa-instagram icon"></i>
                        <i class="fa-brands fa-facebook-f icon"></i>
                    </div>
                </div>
                <div class="footer-2">
                    <a href="" class="footer-2__link">ĐIỀU KHOẢN SỬ DỤNG</a>
                    <a href="" class="footer-2__link">CHÍNH SÁCH BẢO MẬT</a>
                </div>
            </div>

            <!-- Javascript nhà làm -->
            <script src="./javascript/main_thanhtoan.js"></script>
            <script src="./javascript/chuyengiao.js"></script>
        </body>
    </html>