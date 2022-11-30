<?php
    ob_start();
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "dbmot");
    mysqli_set_charset($conn, "utf-8");
?>