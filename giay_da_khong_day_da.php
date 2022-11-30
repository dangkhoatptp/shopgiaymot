<?php include("SQLConnect.php"); ?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!-- Icon và tên cửa sổ -->
            <link rel="shortcut icon" type="image/png" href="./images/logo-da-cat-nen-den.png"/>
            <title>giày da Đá không dây | MỘT</title>

            <!-- Css nhà làm -->
            <link rel="stylesheet" href="./css/css_chung.css">
            <link rel="stylesheet" href="./css/css_mau.css">
            <link rel="stylesheet" href="./css/main_chitietsanpham.css">

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
                <div class="header__header-1 fixed">
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
                <div class="header__header-2">
                    <div class="header-2__button-left">
                        <i onclick="clickButtonLeft();" class="fa-solid fa-arrow-left-long icon"></i>
                    </div>
                    <div class="header-2__slides">
                        <img src="./images/images_san-pham/giay_da_khong_day/mau_da/DT_gem_profile.webp" alt="" class="slides__slide show">
                        <img src="./images/images_san-pham/giay_da_khong_day/mau_da/DSC03714-LOWRES.webp" alt="" class="slides__slide">
                        <img src="./images/images_san-pham/giay_da_khong_day/mau_da/DSC03693-LOWRES-3-2.webp" alt="" class="slides__slide">
                        <img src="./images/images_san-pham/giay_da_khong_day/mau_da/DSC03327-LOWRES.webp" alt="" class="slides__slide">
                        <img src="./images/images_san-pham/giay_da_khong_day/mau_da/DSC01901-1-HIGHRES.webp" alt="" class="slides__slide">
                        <img src="./images/images_san-pham/giay_da_khong_day/mau_da/DT_gem_top.webp" alt="" class="slides__slide">
                        <img src="./images/images_san-pham/giay_da_khong_day/mau_da/DT_gem_sole.webp" alt="" class="slides__slide">
                        <img src="./images/images_san-pham/giay_da_khong_day/mau_da/DT_gem_rear.webp" alt="" class="slides__slide">
                        <img src="./images/images_san-pham/giay_da_khong_day/mau_da/DT_gem_front.webp" alt="" class="slides__slide">
                    </div>
                    <div class="header-2__button-right">
                        <i onclick="clickButtonRight();" class="fa-solid fa-arrow-right-long icon"></i>
                    </div>
                </div>
            </div>
            <!-- 

                ---------------------------BODY-------------------------------

            -->
            <div class="body">
                <div class="body__product-details">
                    <div class="product-details__content-product">
                        <h1 class="content-product__name-product">giày da Đá không dây</h1>
                        <p class="content-product__price-product"><b>1,789,000 VND</b></p>
                        <p>
                            Một thiết kế trên <b>Một làn da mới</b><br>
                            giới thiệu đến bạn <b>Một đôi giày Đá</b> – tên cứng nhưng rất mềm bởi lớp da-bò-thật cao cấp phủ lớp chống bám nước : êm vượt trội, bất chấp nắng mưa !<br>
                            chỉ Một màu đen-ánh-tím rắn rỏi mà tinh tế, thâm trầm. mong bạn cũng như Đá : bên ngoài bền bỉ, bên trong kiên định; hiểu được giá trị của mình để thành công theo cách của mình.
                        </p>
                        <p>
                            trước mọi sức nặng Đời-thường, chúc bạn chân luôn vững và lòng luôn êm !
                        </p>
                        <p>____</p>
                        <p>
                            giày Đá chỉ duy nhất Một dòng Đời-thường mang thiết kế mới và màu đen-ánh-tím thâm trầm đế cao su đúc nguyên khối cao 2,5cm cùng Một làn da-thật phủ lớp chống thấm : êm bền và không thấm nước
                        </p>
    
                        <iframe width="660px" height="420px" src="https://youtube.com/embed/QfKoU2NtBTc?controls=1" poster="" frameborder="0"></iframe>
                    </div>
                    <div class="product-details__option-product">
                        <div class="option-product__colors">
                            <span class="colors__name-color"><b>da Đá</b></span>
                            <div class="colors__list-color">
                                <div onclick="clickLink(8);" class="colors__color-outside checked">
                                    <div class="color-outside__color" style="background-color: var(--mau-da);"></div>
                                </div>
                                <div onclick="clickLink(9);" class="colors__color-outside">
                                    <div class="color-outside__color" style="background-color: var(--mau-xam-nhe);"></div>
                                </div>
                            </div>
                        </div>
                        <div class="option-product__sizes">
                            <div class="sizes__list-size">
                                <?php
                                    $id_giay = null;
                                    if(isset($_GET['idgiay'])) {
                                        $id_giay = $_GET['idgiay'];
                                        $sql = "SELECT * FROM sizegiay WHERE id_giay = $id_giay";
                                        $rows = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($rows) > 0) {
                                            for($i = 35 ; $i <= 45 ; ++$i) {
                                                $index = $i - 35;
                                                $row = mysqli_fetch_assoc($rows);
                                                if($row['soluong'] > 0) {
                                                    echo "<div onclick=\"clickSize($index);\" class=\"list-size__size\" style=\"border: 1px solid var(--mau-chu-footer-hover);\">$i</div>";
                                                } else {
                                                    echo "<div class=\"list-size__size\">$i</div>";
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <a href="trogiup_mangsizenaovua.php" class="option-product__how-to-foot-measurement">
                            <i class="fa-solid fa-ruler icon"></i>
                            đo chân làm sao ?
                        </a>
                        <div onclick="clickButtonAddCart(<?php echo $id_giay; ?>, 'giay_da_khong_day_da');" class="option-product__button-add-cart inactive">thêm vào giỏ hàng</div>

                        <div class="option-product__product-other">
                            <span class="product-other__title">biết đâu bạn thích ?</span>

                            <div onclick="clickLink(11);" class="product-other__product">
                                <img src="./images/images_san-pham/khac/3x2_DT_qua-do_profile-750x500.webp" alt="" class="product__image">
                                <span class="product-other__name">
                                    <b>giày vải không dây Quá đỏ</b><br>
                                    720,000 VND
                                </span>
                            </div>
                            <div onclick="clickLink(0);" class="product-other__product">
                                <img src="./images/images_san-pham/khac/3x2_DM_da-den_profile-750x500.webp" alt="" class="product__image">
                                <span class="product-other__name">
                                    <b>giày da có dây Đen tuyền</b><br>
                                    1,470,000 VND
                                </span>
                            </div>
                            <div onclick="clickLink(1);" class="product-other__product">
                                <img src="./images/images_san-pham/khac/3x2_DT_da-xam-nhat_profile-750x500.webp" alt="" class="product__image">
                                <span class="product-other__name">
                                    <b>giày da không dây Xám nhẹ</b><br>
                                    1,470,000 VND
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="body__product-benefits">
                    <div class="product-benefits__box">
                        <hr>
                        <h1 class="box__title">phom dáng dễ mang</h1>
                        <p class="box__content">rộng bề ngang; đơn giản - dễ phối đồ - ai mang cũng được - đi đâu cũng đẹp !</p>
                    </div>
                    <div class="product-benefits__box">
                        <hr>
                        <h1 class="box__title">chất liệu tốt</h1>
                        <p class="box__content">
                            - da bò thật 100% êm ru<br>
                            - đế đúc cao su nguyên khối nâng đỡ tuyệt đối<br>
                            - lót giày làm bằng mút-xốp polyurethane tế-bào mở - êm lâu, thoáng khí
                        </p>
                    </div>
                    <div class="product-benefits__box">
                        <hr>
                        <h1 class="box__title">bảo quản đơn giản</h1>
                        <p class="box__content">với các sản phẩm da bạn nhớ tránh dính nước, dính mưa và nếu cần làm sạch xin hãy tìm đến cách dịch vụ uy tín !</p>
                    </div>
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
            <script src="./javascript/main_chitietsanpham.js"></script>
            <script src="./javascript/chuyengiao.js"></script>
        </body>
    </html>