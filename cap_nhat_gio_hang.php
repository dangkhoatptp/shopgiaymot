<?php
    ob_start();
    session_start();

    $conn = mysqli_connect("sql310.byethost7.com", "b7_33078131", "dangkhoatptp", "b7_33078131_dbmot");
    mysqli_set_charset($conn, "UTF8");

    $id_account = $_GET['idaccount'];
    $id_giay = $_GET['idgiay'];
    $id_size = $_GET['idsize'];
    $soLuong = $_GET['soluong'];

    $sql = "UPDATE giohang SET soluong = $soLuong WHERE id_taikhoan = $id_account AND id_giay = $id_giay AND id_size = $id_size";
    $result = mysqli_query($conn, $sql);

    header("location:giohang.php");
?>