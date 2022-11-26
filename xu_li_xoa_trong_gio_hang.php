<?php
    ob_start();
    session_start();

    $conn = mysqli_connect("sql310.byethost7.com", "b7_33078131", "dangkhoatptp", "b7_33078131_dbmot");
    mysqli_set_charset($conn, "UTF8");

    $idAccount = $_GET['idaccount'];
    $idGiay = $_GET['idgiay'];
    $idSize = $_GET['idsize'];

    $sql = "DELETE FROM giohang WHERE id_taikhoan = $idAccount AND id_giay = $idGiay AND id_size = $idSize";
    $result = mysqli_query($conn, $sql);

    header("location:giohang.php");
?>