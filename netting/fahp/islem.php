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
    unlink("alt1.csv");
    unlink("alt2.csv");
    unlink("alt3.csv");
    unlink("alt4.csv");
    unlink("tablo5.csv");
    unlink("sonuc.csv");
    for($i = 0; $i<10; $i++) {
        $name = "altsonuc".$i.".csv";
        try {
            unlink( $name);
        }catch (ErrorException $e){}
    }
    header("Location:../../fahp/listeleme/");
    exit();
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
                    $z = isset($_POST[$j . ';' . $i . ";" . $b]) ? $_POST[$j . ';' . $i . ";" . $b] : 0;
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

if (isset($_POST['altfaktorekleme'])) {

    $kriter = $_POST['kriter'];
    $id = $_POST['id'];
    $deger = "";
    if (file_exists("alt1.csv")) {
        $dosya = fopen(__DIR__ . "/alt1.csv", 'r');
        $icerik = fread($dosya, filesize(__DIR__ . "/alt1.csv"));
        $deger = $icerik . "\n";
    }
    $ac = fopen(__DIR__ . "/alt1.csv", "w+");
    $deger = $deger . $id . ",";
    $deger = $deger . $kriter;

    fwrite($ac, $deger);
    fclose($ac);
    header("Location:../../fahp/listeleme/");
    exit();
}

if (isset($_POST['faktorkaydet'])) {

    $dosya = fopen(__DIR__ . "/alt1.csv", 'r');
    $icerik = fread($dosya, filesize(__DIR__ . "/alt1.csv"));
    $altfaktor = explode("\n", $icerik);

    $item = null;
    foreach($altfaktor as $alt) {
        if ($_POST['id'] == substr($alt,0,1)) {
            $item = $alt;
            break;
        }
    }

    $item = substr($item,2);
    $kriterler = explode(",", $item);

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
                    $k = isset($_POST[$i . ';' . $j . ";" . $a]) ? $_POST[$i . ';' . $j . ";" . $a] : 0;
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
                    $z = isset($_POST[$j . ';' . $i . ";" . $b]) ? $_POST[$j . ';' . $i . ";" . $b] : 0;
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

    $ac = fopen(__DIR__ . "/alt2.csv", "w");
    fwrite($ac, $deger);
    fclose($ac);
    $id = $_POST['id'];
    header("Location:../../fahp/alt2/?id=$id");
    exit();

}

if (isset($_POST['testsonuclari'])) {

    $dosya = fopen(__DIR__ ."/altfaktordegerler.csv", 'r');
    $icerik = fread($dosya, filesize(__DIR__ ."/altfaktordegerler.csv"));

    $kriterler = explode("\n", $icerik);
    fclose($dosya);
    $deger = "";
    $puan = "";
    for($i = 0; $i<count($kriterler)-1; $i++) {
        $kriterbol = explode(",", $kriterler[$i]);
        $c = 0;
        while ($c < 3 ){
            $sonuc = 0;
            $b = $c+1;
            if($c ==2) {
                $sonuc = $_POST["$i;$c"] * $kriterbol[$b];
                $deger =  $deger. $sonuc;
                $puan = $puan.$_POST["$i;$c"];
            }else{
                $sonuc = $_POST["$i;$c"] * $kriterbol[$b];
                $deger = $deger.$sonuc.",";
                $puan = $puan.$_POST["$i;$c"].",";

            }
            $c++;
        }
         $deger = $deger."\n";
        $puan = $puan."\n";

    }
    $ac = fopen(__DIR__ . "/testsonuc.csv", "w+");
    fwrite($ac, $deger);
    fclose($ac);

    $ac2 = fopen(__DIR__ . "/puan.csv", "w+");
    fwrite($ac2,  $puan);
    fclose($ac2);
    header("Location:../../fahp/testsonuc/");
    exit();
}

if (isset($_POST['testkaydet'])) {

    $deger =$_POST["aday"].",".$_POST["toplam1"].",".$_POST["toplam2"].",".$_POST["toplam3"]."\n";
    $ac = fopen(__DIR__ . "/sonuc.csv", "a+");
    fwrite($ac, $deger);
    fclose($ac);
    header("Location:../../fahp/listeleme/");
    exit();
}
?>
