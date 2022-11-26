<?php
    session_start();
    $_SESSION["login"] = "false";

    $conn = mysqli_connect('localhost', 'root', '', 'dbmot');
    mysqli_set_charset($conn, 'utf8');
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!-- Icon và tên cửa sổ -->
            <link rel="shortcut icon" type="image/png" href="../images/logo-da-cat-nen-den.png"/>
            <title>Đăng nhập | MỘT</title>

            <!-- Css nhà làm -->
            <link rel="stylesheet" href="../css/css_dangnhap.css">
            <link rel="stylesheet" href="../css/css_mau.css">
            <link rel="stylesheet" href="../css/css_chung.css">

            <!-- Css icon -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

            <!-- Font chữ có sẵn -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        </head>
        <body>
            <div class="background"></div>
            <form class="form" action="" method="POST">
                <div class="group">
                    <label class="label" for="username">tên đăng nhập</label>
                    <input class="username" type="text" name="username">
                </div>
                <div class="group">
                    <label class="label" for="password">mật khẩu</label>
                    <input class="password" type="password" name="password">
                </div>
                <button class="button_submit" type="submit" name="login">đăng nhập</button>
                <a class="link_register" href="../html/taotaikhoan.php">Tạo tài khoản</a>
            </form>
            <!-- <div class="error">Mật khẩu hoặc tên đăng nhập không đúng!</div> -->

            <?php
                $linkpage = null;
                if(isset($_GET["linkpage"])) $linkpage = $_GET["linkpage"]; 
                if(isset($_POST["login"])) {
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    $rows = mysqli_query($conn, "SELECT * FROM taikhoan WHERE tendangnhap = '$username' AND matkhau = '$password'");
                    $count = mysqli_num_rows($rows);

                    if($count == 1) {
                        $_SESSION["login"] = "true";
                        $row = mysqli_fetch_assoc($rows);
                        $_SESSION["id_account"] = $row["id_taikhoan"];
                        $_SESSION["username"] = $row["tendangnhap"];
                        $_SESSION["password"] = $row["matkhau"];
                        $_SESSION["fullname"] = $row["hoten"];
                        $_SESSION["phonenumber"] = $row["sdt"];
                        $_SESSION["email"] = $row["email"];
                        $_SESSION["avatar"] = $row["avatar"];
                        $_SESSION["address"] = $row["diachi"];
                        header("location:$linkpage.php");
                    } else {
                        echo "<div class=\"error\">Mật khẩu hoặc tên đăng nhập không đúng!</div>";
                    }
                }
            ?>
        </body>
    </html>