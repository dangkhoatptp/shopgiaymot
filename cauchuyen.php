<?php
    session_start();
    ob_start();

    $conn = mysqli_connect("sql310.byethost7.com", "b7_33078131", "dangkhoatptp", "b7_33078131_dbmot");
    mysqli_set_charset($conn, "UTF8");
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!-- Icon và tên cửa sổ -->
            <link rel="shortcut icon" type="image/png" href="./images/logo-da-cat-nen-den.png"/>
            <title>câu chuyện | MỘT</title>

            <!-- Css nhà làm -->
            <link rel="stylesheet" href="./css/css_chung.css">
            <link rel="stylesheet" href="./css/css_mau.css">
            <link rel="stylesheet" href="./css/main_cauchuyen.css">

            <!-- Css icon -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

            <!-- Font chữ có sẵn -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        </head>

        <body>
            <!-- 

                ------------------------------HEADER------------------------------

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
                                                echo '<li onclick="logout(\'cauchuyen\');">đăng xuất</li>';
                                            echo '</ul>';
                                        echo '</div>';
                                    echo '</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="header__box"></div>
                <div class="header__header-2">
                    <div class="header-2__title">Một cho tất cả.</div>
                    <div class="header-2__content">
                        Một được sinh ra từ nhu cầu dành cho những sản
                        phẩm <b>thiết-kế lấy người-dùng làm trung tâm</b>, có
                        chất lượng <b>gia công tỉ mỉ</b> và hướng đến <b>tiêu-dùng</b>
                        <b>bền vững.</b>
                    </div>
                </div>
            </div>
            <!-- 

                -------------------------------BODY---------------------------------

             -->
            <div class="body">
                <div class="body__box">
                    <div class="box__image"></div>
                    <div class="box__content">
                        <div class="content__title">thiết-kế lấy người-dùng làm trung-tâm</div>
                        <div class="content__text-1">
                            Một quan tâm đến bạn và những gì bạn cần.
                        </div>
                        <div class="content__text-2">
                            thiết-kế của Một hướng đến công năng và sự hài hoà về mặt mỹ thuật, để bạn luôn dễ chịu và thong dong mỗi ngày, mỗi ngày.
                        </div>
                        <div class="content__text-3">
                            Một cho tất cả.
                        </div>
                        <a href="shop.php" class="content__button">mua thôi!</a>
                    </div>
                </div>
                <div class="body__box">
                    <div class="box__content">
                        <div class="content__title">gia-công tỉ-mỉ</div>
                        <div class="content__text-1">
                            Một quan tâm đến chất lượng từng sản-phẩm xuất xưởng.
                        </div>
                        <div class="content__text-2">
                            mọi sản-phẩm Một làm đều được đảm bảo bền đẹp theo thời gian, để bạn sử dụng hàng ngày - dài lâu.
                        </div>
                        <div class="content__text-3">
                            Một cho tất cả.
                        </div>
                        <a href="shop.php" class="content__button">mua thôi!</a>
                    </div>
                    <div class="box__image"></div>
                </div>
                <div class="body__box">
                    <div class="box__image"></div>
                    <div class="box__content">
                        <div class="content__title">tiêu-dùng bền vững</div>
                        <div class="content__text-1">
                            Một quan tâm đến tính bền-vững.
                        </div>
                        <div class="content__text-2">
                            sản phẩm Một làm đều đơn giản, ít lỗi thời, dành cho mọi người, sử dụng mọi ngày, trong mọi dịp. mua Một lần, dùng hoài hoài. để bạn dành thời gian làm việc bạn thích.
                        </div>
                        <div class="content__text-3">
                            Một cho tất cả.
                        </div>
                        <a href="shop.php" class="content__button">mua thôi!</a>
                    </div>
                </div>
            </div>
            <!-- 

                ------------------------------------FOOTER-----------------------------------

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

            <!-- Javacsript nhà làm -->
            <script src="./javascript/chuyengiao.js"></script>
        </body>
    </html>