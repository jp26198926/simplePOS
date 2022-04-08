<?php
session_start();

//date_default_timezone_set("Asia/Manila");
date_default_timezone_set("Pacific/Port_Moresby");


if (empty($_SESSION['uid'])) {
    session_destroy();
    header("Location: index.php");
} else {
    $uid = $_SESSION['uid'];
    $ufullname = $_SESSION['ufullname'];
    $ufname = $_SESSION['ufname'];
    $udept = $_SESSION['udept'];
    $uaccess = $_SESSION['uaccess'];

    //$dt = date('Y-m-d h:i:s A');
    $dt = date('Y-m-d H:i:s');

    $dtx = date('Y-m-d h:i:s');
}
