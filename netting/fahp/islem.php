<?php
include '../netting/baglan.php';
include '../include/helper.php';
date_default_timezone_set('Europe/Istanbul');

ini_set('display_errors', 1);

if (isset($_POST['anafaktorekleme'])) {

    $kriter = $_POST['kriter'];

    $ac = fopen(__DIR__ . "/tablo1.csv", "w+");

    $deger = $kriter;

    fwrite($ac, $deger);
    fclose($ac);

    header("Location:../../fahp/listeleme/");
    exit();
}
?>
