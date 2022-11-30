<?php include("SQLConnect.php"); ?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!-- Icon và tên cửa sổ -->
            <link rel="shortcut icon" type="image/png" href="./images/logo-da-cat-nen-den.png"/>
            <title>Một đôi nguyên ngày | MỘT</title>

            <!-- Css nhà làm -->
            <link rel="stylesheet" href="./css/css_chung.css">
            <link rel="stylesheet" href="./css/css_mau.css">
            <link rel="stylesheet" href="./css/main_trangchu.css">

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
                                                echo '<li onclick="logout(\'trangchu\');">đăng xuất</li>';
                                            echo '</ul>';
                                        echo '</div>';
                                    echo '</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="header__header-2">
                    <a href="cauchuyen.php" class="header-2__image-cauchuyen"></a>
                    <a href="" class="header-2__logo"></a>
                    <a href="shop.php" class="header-2__image-shop"></a>
                </div>
            </div>
            <!-- 

                ---------------------------BODY-------------------------------

             -->
            <div class="body">
                <div class="body__content-1">
                    <div class="content-1__icon"></div>
                    <div class="content-1__text">tươm tất, đơn giản, và bền đẹp</div>
                    <div class="content-1__text">Một đôi giày cho mọi hoạt động hàng ngày</div>
                </div>

                <div class="body__content-2">Một đôi nguyên ngày</div>

                <div class="body__content-3">
                    <div class="content-3__slides-image">
                        <div class="slides-image__header">Một đôi giày</div>
                        <div class="slides-image__slides-contain">
                            <div class="slides-contain__slides">
                                <div class="slides__image"></div>
                                <div class="slides__image"></div>
                                <div class="slides__image"></div>
                                <div class="slides__image"></div>
                                <div class="slides__image"></div>
                                <div class="slides__image"></div>
                                <div class="slides__image"></div>
                                <div class="slides__image"></div>
                            </div>
                        </div>
                        <div class="slides-image__button-slides">
                            <div onclick="slidesContent3(0)" class="button-slides__button selected"></div>
                            <div onclick="slidesContent3(1)" class="button-slides__button no-select"></div>
                            <div onclick="slidesContent3(2)" class="button-slides__button no-select"></div>
                            <div onclick="slidesContent3(3)" class="button-slides__button no-select"></div>
                            <div onclick="slidesContent3(4)" class="button-slides__button no-select"></div>
                            <div onclick="slidesContent3(5)" class="button-slides__button no-select"></div>
                            <div onclick="slidesContent3(6)" class="button-slides__button no-select"></div>
                            <div onclick="slidesContent3(7)" class="button-slides__button no-select"></div>
                        </div>
                        <a class="slides-image__button" href="shop.php">SHOP</a>
                    </div>
                    <div class="content-3__image"></div>
                </div>

                <div class="body__content-4">
                    <div class="content-4__header">
                        <div class="header__line"></div>
                        <div class="header__text">biết thêm về Một</div>
                        <div class="header__line"></div>
                    </div>
                    <div class="content-4__images">
                        <a href="cauchuyen.php" class="images__cau-chuyen">
                            <div class="cau-chuyen__text">câu chuyện</div>
                        </a>
                        <a href="shop.php" class="images__shop">
                            <div class="shop__text">shop</div>
                        </a>
                        <a href="trogiup_mangsizenaovua.php" class="images__tro-giup">
                            <div class="tro-giup__text">trợ giúp</div>
                        </a>
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
            <script src="./javascript/main_trangchu.js"></script>
            <script src="./javascript/chuyengiao.js"></script>
        </body>
    </html>