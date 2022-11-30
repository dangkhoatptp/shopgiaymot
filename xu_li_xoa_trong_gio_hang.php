<?php
    include("SQLConnect.php");
    $idAccount = $_GET['idaccount'];
    $idGiay = $_GET['idgiay'];
    $idSize = $_GET['idsize'];

    $sql = "DELETE FROM giohang WHERE id_taikhoan = $idAccount AND id_giay = $idGiay AND id_size = $idSize";
    $result = mysqli_query($conn, $sql);

    header("location:giohang.php");
?>