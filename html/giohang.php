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
            <link rel="shortcut icon" type="image/png" href="../images/logo-da-cat-nen-den.png"/>
            <title>Giỏ hàng | MỘT</title>

            <!-- Css nhà làm -->
            <link rel="stylesheet" href="../css/css_chung.css">
            <link rel="stylesheet" href="../css/css_mau.css">
            <link rel="stylesheet" href="../css/main_giohang.css">

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
                            <li class="menu__item"><a href="../html/cauchuyen.php" class="item__text">câu chuyện</a></li>
                            <li class="menu__item"><a href="../html/shop.php" class="item__text">shop</a></li>
                            <li class="menu__item"><a href="../html/noiban.php" class="item__text">Một & nơi bán</a></li>
                        </ul>
                    </div>
                    <a href="../html/trangchu.php" class="header-1__logo"></a>
                    <div class="header-1__right-menu">
                        <ul class="right-menu__menu">
                            <li class="menu__item"><a href="../html/trogiup_mangsizenaovua.php" class="item__text">trợ giúp</a></li>
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
                                        
                                        echo "<img class=\"avatar__avatar\" src=\"../avatar/$avatar\" style=\"width: $widthIcon"."px; "."height: $heightIcon"."px; "."left: $leftIcon"."px; "."top: $topIcon"."px;\">";
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
                <a href="" class="header__header-2">Giỏ hàng</a>
            </div>
            <!-- 

                ---------------------------BODY-------------------------------

             -->
            <div class="body">
                <?php
                    $id_account = $_SESSION['id_account'];
                    
                    $sql = "SELECT * FROM giohang WHERE id_taikhoan = $id_account";
                    $rows = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows(($rows));

                    if($count == 0) {
                        echo '<div class="body__notice-empty">Chưa có sản phẩm nào trong giỏ hàng.</div>';
                        echo '<a href="../html/shop.php" class="body__button-return-shop">QUAY TRỞ LẠI CỬA HÀNG</a>';
                    } else if($count > 0) {
                        echo '<form class="body__form-list-product" action="">';
                            echo '<table class="body__list-product-in-cart" rules="rows" frame="box">';
                                echo '<tr class="list-product-in-cart__row">';
                                    echo '<td class="row__button-remove-and-image-product"></td>';
                                    echo '<td class="row__name-product">Sản phẩm</td>';
                                    echo '<td class="row__price">Giá</td>';
                                    echo '<td class="row_count">Số lượng</td>';
                                    echo '<td class="row__temp-price">Tạm tính</td>';
                                echo '</tr>';

                        $tamtinh = 0;
                        $tong = 0;
                        while($row = mysqli_fetch_assoc($rows)) {
                            $id_giay = $row['id_giay'];
                            $id_size = $row['id_size'];
                            $soluongtronggiohang = $row['soluong'];
                            $sql = "SELECT * FROM giay WHERE id_giay = $id_giay";
                            $result = mysqli_query($conn, $sql);
                            $temp = mysqli_fetch_assoc($result);

                            $name = $temp['tengiay'];
                            $gia = $temp['gia'];
                            $image = $temp['hinhanh'];

                            $sql = "SELECT * FROM sizegiay WHERE id_sizegiay = $id_size AND id_giay = $id_giay";
                            $result = mysqli_query($conn, $sql);
                            $temp = mysqli_fetch_assoc($result);

                            $size = $temp['sizegiay'];
                            $soluongtrongkho = $temp['soluong'];

                            $tamtinh = $gia * $soluongtronggiohang;
                            $tong = $tong + $tamtinh;
                            
                            echo '<tr class="list-product-in-cart__row">';
                                echo '<td class="row__button-remove-and-image-product">';
                                    echo "<i onclick=\"clickButtonDeleteProduct($id_account, $id_giay, $id_size);\" class=\"fa-solid fa-x\"></i>";
                                    echo "<img src=\"$image\" alt=\"\" height=\"82px\">";
                                echo '</td class="row__name-product">';
                                echo "<td>$name, $size</a>";
                                echo '</td>';
                                echo "<td class=\"row__price\">".number_format($gia, 0, '.', ',')." VND</td>";
                                echo "<td onchange=\"changeValue();\" class=\"row_count\"><input class=\"inputSoLuong\" min=\"1\" max=\"$soluongtrongkho\" value=\"$soluongtronggiohang\" type=\"number\" name=\"inputSoLuong\"></td>";
                                echo "<td class=\"row__temp-price\">".number_format($tamtinh, 0, '.', ',')." VND</td>";
                            echo '</tr>';
                        }
                            echo '</table>';
                            echo "<button onclick=\"clickButtonUpdate($id_account, $id_giay, $id_size);\" class=\"body__button-update\">CẬP NHẬT GIỎ HÀNG</button>";
                        echo '</form>';
                        echo '<div class="body__box">';
                            echo '<div class="box__title">Cộng giỏ hàng</div>';
                            echo '<table class="box__table" rules="rows" frame="box">';
                                echo '<tr class="table__row">';
                                    echo '<td class="row__header-table"><b>Tạm tính</b></td>';
                                    echo "<td class=\"row__body-table\">".number_format($tong, 0, '.', ',')." VND</td>";
                                echo '</tr>';
                                echo '<tr class="table__row">';
                                    echo '<td class="row__header-table"><b>Giao hàng</b></td>';
                                    echo '<td class="row__body-table">'; 
                                        echo '<div class="body-table__content">';
                                            echo '<div class="content__text">';
                                                echo '<input onclick="clickRadio(0, 0);" name="radio" type="radio" value="0"  class="radio" checked>';
                                                echo 'Giao hàng miễn phí';
                                            echo '</div>';
                                            echo '<div class="content__sub-text">3-5 ngày làm việc</div>';
                                        echo '</div>';
                                        echo '<div class="body-table__content">';
                        if($_SESSION['address'] != "") {
                            $address = $_SESSION['address'];
                            echo "Vận chuyển đến <b>$address</b>";
                        }
                                        echo '</div>';
                                    echo '</td>';
                                echo '</tr>';
                                echo '<tr class="table__row">';
                                    echo '<td class="row__header-table"><b>Tổng</b></td>';
                                    echo "<td class=\"row__body-table\"><b>".number_format($tong, 0, '.', ',')." VND</b></td>";
                                echo '</tr>';
                            echo '</table>';
                            echo "<button onclick=\"nextPage('thanh_toan');\" class=\"box__button-buy\">TIẾN HÀNH THANH TOÁN</button>";
                        echo '</div>';
                    }
                ?>
                <!-- GIAO DIỆN HIỂN THỊ KHI KHÔNG CÓ SẢN PHẨM TRONG GIỎ HÀNG -->
                <!-- <div class="body__notice-empty">Chưa có sản phẩm nào trong giỏ hàng.</div>
                <a href="../html/shop.php" class="body__button-return-shop">QUAY TRỞ LẠI CỬA HÀNG</a> -->

                <!-- GIAO DIỆN KHI CÓ SẢN PHẨM TRONG GIỎ HÀNG -->
                <!-- <form action="">
                    <table class="body__list-product-in-cart" rules="rows" frame="box">
                        <tr class="list-product-in-cart__row">
                            <td class="row__button-remove-and-image-product"></td>
                            <td class="row__name-product">Sản phẩm</td>
                            <td class="row__price">Giá</td>
                            <td class="row_count">Số lượng</td>
                            <td class="row__temp-price">Tạm tính</td>
                        </tr>
                        <tr class="list-product-in-cart__row">
                            <td class="row__button-remove-and-image-product">
                                <i class="fa-solid fa-x"></i>
                                <img src="../images/images_san-pham/giay_da_co_day/mau_den_tuyen/1500x1000_DM_da-den_profile.webp" alt="" height="82px">
                            </td class="row__name-product">
                            <td>Giày da có dây Đen tuyền, 40</a>
                            </td>
                            <td class="row__price">1,470,000 VND</td>
                            <td class="row_count"><input min="1" max="3" value="1" type="number"></td>
                            <td class="row__temp-price">1,470,000 VND</td>
                        </tr>
                    </table>
                    <button class="body__button-update">CẬP NHẬT GIỎ HÀNG</button>
                </form>
                <div class="body__box">
                    <div class="box__title">Cộng giỏ hàng</div>
                    <table class="box__table" rules="rows" frame="box">
                        <tr class="table__row">
                            <td class="row__header-table"><b>Tạm tính</b></td>
                            <td class="row__body-table">790,000 VND</td>
                        </tr>
                        <tr class="table__row">
                            <td class="row__header-table"><b>Giao hàng</b></td>
                            <td class="row__body-table">    
                                <div class="body-table__content">
                                    <div class="content__text">
                                        <input name="radio" type="radio" checked>
                                        Giao hàng miễn phí
                                    </div>
                                    <div class="content__sub-text">3-5 ngày làm việc</div>
                                </div>
                                <div class="body-table__content">
                                    <div class="content__text">
                                        <input name="radio" type="radio">
                                        Hỏa tốc trong ngày: <b>50,000 VND</b>
                                    </div>
                                    <div class="content__sub-text">
                                        Điều kiện áp dụng:<br>
                                        <ul>
                                            <li>Nếu bạn đặt hàng sau 17h00: Giao hàng ngày kế tiếp</li>
                                            <li>Nếu bạn đặt hàng từ thứ Hai đến thứ Sáu: Giao hàng trong ngày</li>
                                            <li>Nếu bạn đặt hàng vào thứ Bảy, Chủ nhật: Giao hàng thứ Hai</li>
                                            <li>Nếu bạn đặt hàng vào các ngày Lễ, Tết: Giao hàng trong ngày đầu tiên sau khi hết ngày nghỉ Lễ, Tết</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="body-table__content">
                                    Vận chuyển đến <b>159 Hưng Phú, Quận 8, Hồ Chí Minh</b>
                                </div>
                            </td>
                        </tr>
                        <tr class="table__row">
                            <td class="row__header-table"><b>Tổng</b></td>
                            <td class="row__body-table"><b>790,000 VND</b></td>
                        </tr>
                    </table>
                    <button class="box__button-buy">TIẾN HÀNH THANH TOÁN</button>
                </div> -->
            </div>
            <!-- 

                ----------------------------FOOTER------------------------------------

             -->
            <div class="footer">
                <div class="footer-1">
                    <div class="footer-1__links">
                        <a href="../html/cauchuyen.php" class="links__link">câu chuyện</a>
                        <a href="../html/shop.php" class="links__link">shop</a>
                    </div>
                    <div class="footer-1__links">
                        <a href="../html/noiban.php" class="links__link">Một & nơi bán</a>
                        <a href="../html/trogiup_mangsizenaovua.php" class="links__link">trợ giúp</a>
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
            <script src="../javascript/main_giohang.js"></script>
            <script src="../javascript/chuyengiao.js"></script>
        </body>
    </html>