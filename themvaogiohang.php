<?php
    ob_start();
    session_start();

    $conn = mysqli_connect("sql310.byethost7.com", "b7_33078131", "dangkhoatptp", "b7_33078131_dbmot");
    mysqli_set_charset($conn, "UTF8");

    if($_SESSION['login'] == "false") {
        header("location:dangnhap.php?linkpage=shop");
    } else if($_SESSION['login'] == "true") {
        $id_account = $_SESSION['id_account'];
        $id_giay = $_GET['idgiay'];
        $size = $_GET['size'];

        $sql = "SELECT * FROM sizegiay WHERE sizegiay = $size";
        $rows = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($rows);

        $id_size = $row['id_sizegiay'];

        $sql = "SELECT * FROM giohang WHERE id_taikhoan = $id_account AND id_giay = $id_giay AND id_size = $id_size";
        $rows = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($rows);

        if($count == 1) {
            $sql = "UPDATE giohang SET soluong = soluong + 1 WHERE id_taikhoan = $id_account AND id_giay = $id_giay AND id_size = $id_size";
            $result = mysqli_query($conn, $sql);
        } else if($count == 0) {    
            $sql = "INSERT INTO giohang (id_taikhoan, id_giay, id_size, soluong) VALUES ($id_account, $id_giay, $id_size, 1);";
            $result = mysqli_query($conn, $sql);
        }

        echo $count;

        $link = $_GET['link'].".php?idgiay=".$id_giay;
        header("location:$link");
    }
?>