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
    unlink("sonuc.csv");
    header("Location:../../fahp/listeleme/");
    exit();
}

if (isset($_POST['altfaktorekleme'])) {

    $kriter = $_POST['kriter'];
    $id = $_POST['id'];
    $ac = fopen(__DIR__ . "/altfaktorler.csv", "w+");
    $deger = $id.",";
    $deger = $deger.$kriter;

    fwrite($ac, $deger);
    fclose($ac);
    exit();

    header("Location:../../fahp/listeleme/");
}

if (isset($_POST['verikaydet'])) {
    $dosya = fopen(__DIR__ . "/tablo1.csv", 'r');
    $icerik = fread($dosya, filesize(__DIR__ . "/tablo1.csv"));

    $kriterler = explode(",", $icerik);

    $kriterUzunluk = count($kriterler);
    $deger = "";


    for ($i = 0; $i < $kriterUzunluk; $i++) {
        for ($j = 0; $j < $kriterUzunluk; $j++) {
            if ($i == $j) {
                if ($kriterUzunluk == $i + 1) {
                    $deger = $deger . "1,1,1";
                } else {
                    $deger = $deger . "1,1,1;";
                }
            }

            if ($i < $j) {
                $a = 0;
                while ($a < 3) {
                    $k = $_POST[$i . ';' . $j . ";" . $a];
                    $a++;
                    if ($a == 3) {
                        if ($j + 1 == $kriterUzunluk) {
                            $deger = $deger . round($k, 2);
                        } else {
                            $deger = $deger . round($k, 2) . ";";
                        }
                    } else {
                        $deger = $deger . round($k, 2) . ",";
                    }
                }

            } else {
                $b = 2;
                while ($b >= 0) {
                    $z =  isset($_POST[$j . ';' . $i . ";" . $b]) ? $_POST[$j . ';' . $i . ";" . $b] : 0 ;
                    if ($z != 0) {
                        $sonuc = 1 / $z;
                        if ($b == 0) {
                            if ($j + 1 == $kriterUzunluk) {
                                $deger = $deger . round($sonuc, 2);
                            } else {
                                $deger = $deger . round($sonuc, 2) . ";";
                            }
                        } else {
                            $deger = $deger . round($sonuc, 2) . ",";
                        }
                    }
                    $b--;
                }
            }
        }
        $deger = $deger . "\n";
    }

    fclose($dosya);

    $ac = fopen(__DIR__ . "/tablo2.csv", "w+");
    fwrite($ac, $deger);
    fclose($ac);
    header("Location:../../fahp/hesapla2/");
    exit();

}
?>
