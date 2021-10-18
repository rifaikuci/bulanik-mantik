<?php

if($_GET['id']){


    $id = $_GET['id'];

    include '../../../netting/fahp/baglan.php';
    $sql = "SELECT * FROM models WHERE id = '$id'";
    $result = mysqli_query($db, $sql);
    $row = $result->fetch_assoc();

    $kriter = $_POST['kriter'];
//  Tablo 1 için
    $tablo1 = fopen( "../../../netting/fahp/tablo1.csv", "w+");
    $tabloDeger1 = $row['dbKriter'];
    fwrite($tablo1, $tabloDeger1);
    fclose($tablo1);



    // alt1 için
    $alt1Deger = explode(";",$row['dbAltKriter']);
    $tempDeger1="";
    for($i = 0; $i< count($alt1Deger); $i++ ) {
        $alt1Deger[$i] = $i.",".$alt1Deger[$i];
        $tempDeger1 = $tempDeger1."\n".$alt1Deger[$i];
    }
    $tempDeger1 = substr($tempDeger1,1);

    $alt1 = fopen( "../../../netting/fahp/alt1.csv", "w+");
    fwrite($alt1, $tempDeger1);
    fclose($alt1);

    // Alt Sonuc İçin okunma işlemleri yapıldı.
     $bol = explode(';',$row['dbKriterSonuc']);
    for($i = 0; $i<count($bol); $i++) {
        $parcala = explode("-",$bol[$i]);
        $tabloDegerlerSonuclari = "";
        for($k = 0; $k< count($parcala); $k++) {
            $tabloDegerlerSonuclari= $tabloDegerlerSonuclari.$parcala[$k]."\n";
        }
        $dosyaname = "altsonuc".$i.".csv";
        $degerlerTablosu = fopen( "../../../netting/fahp/$dosyaname", "w+");
        fwrite( $degerlerTablosu,$tabloDegerlerSonuclari);
        fclose($degerlerTablosu);

    }
    
        // tablo 5 için

    $tablo5Gecici = str_replace(";","\n",$row['dbAnaFaktorDegerleri']);
    $tablo5 = fopen( "../../../netting/fahp/tablo5.csv", "w+");
    $tablo5Gecici = $tablo5Gecici."\n";

    fwrite($tablo5, $tablo5Gecici);
    fclose($tablo5);


    // tablo 4 için






}

?>

<?php
$dosya = fopen("../../../netting/fahp/tablo1.csv", 'r');
$icerik = fread($dosya, filesize("../../../netting/fahp/tablo1.csv"));

$kriterler = explode(",", $icerik);
$kriterUzunluk = count($kriterler);

$dbKriter = "";
$dbAltKriter = "";
$dbKriterSonuc = "";
$dbAnaFaktorDegerleri = "";
$dbAnaFaktorOrtalamasi = "";
$dbGlobalAgirliklari = "";

fclose($dosya);
if (file_exists("../../../netting/fahp/alt1.csv")) {
    $dosya2 = fopen("../../../netting/fahp/alt1.csv", 'r');
    $faktorler = fread($dosya2, filesize("../../../netting/fahp/alt1.csv"));

    $altfaktor = explode("\n", $faktorler);
    fclose($dosya2);
}
?>


<div style="text-align:  center">
    <h1 style="color: #2b6b4f"> <?php echo $row['name'];?></h1>

</div>
<br>
<br>
<br>
<section class="content">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <?php if (!file("../../../netting/fahp/tablo5.csv")) { ?>
                        <div style="text-align: right;margin-right: auto">
                            <a href="../hesapla1" class="btn btn-primary"><i
                                        class="fa fa-calculator"><?php echo "\t\t\t\t" ?>
                                    Bulanık Ağırlıkları Hesapla</i></a>
                        </div>
                    <?php } ?>
                    <br>
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ana Faktörler</th>
                                    <th>Alt Faktörler/Oluştur</th>
                                    <th>Sonuçlar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php for ($i = 0; $i < count($kriterler); $i++) {
                                    $a = $i + 1;

                                    $item = null;
                                    foreach ($altfaktor as $alt) {
                                        if ($i == substr($alt, 0, 1)) {
                                            $item = $alt;
                                            break;
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $a ?></td>
                                        <td><?php echo $kriterler[$i]; ?></td>
                                        <td>
                                            <?php if ($item) {
                                                $item = substr($item, 2);
                                                $dbAltKriter = $dbAltKriter . "," . $item;
                                                $item = str_replace(",", "<br>", $item);
                                                echo $item;
                                            } else { ?>
                                                <a href="../alt-faktor-veri-giris/?id=<?php echo $i; ?>"
                                                   class="btn btn-primary float-left">Alt Faktör Oluştur</a>
                                            <?php } ?>
                                        </td>
                                        <td style="font-weight: bold">
                                            <?php
                                            $name = "altsonuc" . $i . ".csv";
                                            if ($item && file_exists("../../../netting/fahp/$name")) { ?>

                                                <?php
                                                $dosya = fopen("../../../netting/fahp/$name", 'r');
                                                $icerik = fread($dosya, filesize("../../../netting/fahp/$name"));
                                                $icerikAktar = str_replace("\n", "-", $icerik);
                                                $icerik = str_replace("\n", "<br>", $icerik);
                                                echo $icerik;
                                                ?>
                                            <?php } else if ($item) { ?>
                                                <a href="../alt1/?id=<?php echo $i; ?>"
                                                   class="btn btn-primary float-left">Hesapla</a>
                                            <?php } else { ?>
                                                Hesaplayabilmek için alt faktör giriniz
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $dbKriter = $dbKriter . "," . $kriterler[$i];
                                    $dbAltKriter = $dbAltKriter . ";";
                                    $dbKriterSonuc = $dbKriterSonuc . ";" . $icerikAktar;

                                }

                                $dbAltKriter = str_replace(";,", ";", $dbAltKriter);
                                $dbKriterSonuc = str_replace("-;", ";", $dbKriterSonuc);
                                $dbAltKriter[strlen($dbAltKriter) - 1] = " ";
                                $dbKriter = substr($dbKriter, 1);
                                $dbKriterSonuc = substr($dbKriterSonuc, 1);
                                $dbKriterSonuc[strlen($dbKriterSonuc) - 1] = " ";
                                $dbAltKriter = trim(substr($dbAltKriter, 1));

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (file("../../../netting/fahp/tablo5.csv")) { ?>
                <br>
                <hr>
                <div>
                    <div style="text-align: center">
                        <h3 style="color: #0b93d5"> Ana Faktör Bulanık Değerleri </h3>
                    </div>
                </div>
                <?php
                $dosya = fopen("../../../netting/fahp/tablo1.csv", 'r');
                $icerik = fread($dosya, filesize("../../../netting/fahp/tablo1.csv"));

                $ayirac = explode(",", $icerik);
                $kriterUzunluk = count($ayirac);

                fclose($dosya);


                $dosyaSonuc = fopen("../../../netting/fahp/tablo5.csv", 'r');
                $icerikSonuc = fread($dosyaSonuc, filesize("../../../netting/fahp/tablo5.csv"));

                $ayiracSonuc = explode("\n", $icerikSonuc);
                array_pop($ayiracSonuc);

                $sonuclar = [];


                for ($i = 0; $i < count($ayiracSonuc); $i++) {
                    $ekle = "ekle" . $i;
                    $ekle = explode(",", $ayiracSonuc[$i]);
                    array_push($sonuclar, $ekle);
                }

                fclose($dosyaSonuc);
                ?>
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 50px;text-align: center;">#</th>
                        <th style="text-align: center;">Ağırlık Değerleri</th>
                        <th style="text-align: center;">Ağırlık Ortalaması</th>
                    </tr>
                    </thead>


                    <?php
                    $yazilacak = "";

                    $agirlikOrtalamaSonuclari = [];
                    for ($k = 0; $k < $kriterUzunluk; $k++) { ?>
                        <tr>
                            <td style="text-align: center">
                                <b> <?php echo $ayirac[$k]; ?></b>
                            </td>


                            <td style="text-align: center">


                                <b> <?php echo "( " . $ayiracSonuc[$k] . " )";
                                    $dbAnaFaktorDegerleri = $dbAnaFaktorDegerleri . "," . $ayiracSonuc[$k];
                                    ?></b>
                            </td>

                            <td style="text-align: center">

                                <?php

                                $degerOrtalamasi = 0;
                                for ($i = 0; $i < 3; $i++) {
                                    $degerOrtalamasi = $degerOrtalamasi + trim($sonuclar[$k][$i]);
                                }

                                ?>

                                <b> <?php
                                    $degerOrtalamasi = round($degerOrtalamasi / 3, 3);
                                    array_push($agirlikOrtalamaSonuclari, $degerOrtalamasi);
                                    echo $degerOrtalamasi;
                                    $dbAnaFaktorOrtalamasi = $dbAnaFaktorOrtalamasi . "," . $degerOrtalamasi;
                                    ?></b>
                            </td>
                        </tr>

                        <?php
                        $dbAnaFaktorDegerleri = $dbAnaFaktorDegerleri . ";";
                    } ?>

                </table>
                <?php
                $dbAnaFaktorOrtalamasi = $dbAnaFaktorOrtalamasi . ";";

            } ?>

            <?php
            $dbAnaFaktorDegerleri = substr($dbAnaFaktorDegerleri, 1);
            $dbAnaFaktorDegerleri = str_replace(";,", ";", $dbAnaFaktorDegerleri);
            $dbAnaFaktorDegerleri[strlen($dbAnaFaktorDegerleri) - 1] = " ";
            $dbAnaFaktorOrtalamasi = substr($dbAnaFaktorOrtalamasi, 1);
            $dbAnaFaktorOrtalamasi[strlen($dbAnaFaktorOrtalamasi) - 1] = " ";

            $dosyaana = fopen("../../../netting/fahp/tablo5.csv", 'r');
            $icerikana = fread($dosyaana, filesize("../../../netting/fahp/tablo5.csv"));

            $kriterana = explode("\n", $icerikana);
            fclose($dosyaana);
            ?>

            <?php
            $sonucgoster = false;
            for ($i = 0; $i < $kriterUzunluk; $i++) {
                $name = "altsonuc" . $i . ".csv";
                if (file_exists("../../../netting/fahp/$name")) {
                    $sonucgoster = true;
                } else {
                    $sonucgoster = false;
                    break;
                }
            }
            if (file("../../../netting/fahp/tablo5.csv") && $sonucgoster) { ?>
                <br>
                <div>
                    <div style="text-align: center">
                        <h3 style="color: #0b93d5"> Alt faktörler için global bulanık ağırlıklar </h3>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Ana Faktörler</th>
                                <th>Alt Faktörler ve Bulanık Ağırlıklar</th>
                                <th>Alt Faktör Global Bulanık Ağırlıkları</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $deger = "";
                            for ($i = 0; $i < count($kriterler); $i++) {
                                $a = $i + 1;

                                $item = null;
                                foreach ($altfaktor as $alt) {
                                    if ($i == substr($alt, 0, 1)) {
                                        $item = $alt;
                                        break;
                                    }
                                }
                                ?>
                                <tr>
                                    <td><?php echo $a ?></td>
                                    <td><?php
                                        echo $kriterler[$i];
                                        echo "<br>";
                                        echo "<b>(" . $kriterana[$i] . ")</b>";
                                        ?></td>
                                    <td>
                                        <?php
                                        $name = "altsonuc" . $i . ".csv";

                                        $dosya = fopen("../../../netting/fahp/$name", 'r');
                                        $icerik = fread($dosya, filesize("../../../netting/fahp/$name"));
                                        $iceriksonuc = explode("\n", $icerik);
                                        $item = substr($item, 2);
                                        $items = explode(",", $item);
                                        fclose($dosya);

                                        for ($k = 0; $k < count($iceriksonuc) - 1; $k++) {

                                            echo $items[$k] . "<br>" . "<b>(" . $iceriksonuc[$k] . ")</b><br>";
                                        }
                                        ?>

                                    </td>
                                    <td style="font-weight: bold">
                                        <?php
                                        $aktar = "";
                                        $kriterbol = explode(",", $kriterana[$i]);

                                        for ($k = 0; $k < count($iceriksonuc) - 1; $k++) {
                                            $deger = $deger . $items[$k] . ",";

                                            $icerikbol = explode(",", $iceriksonuc[$k]);
                                            echo "<br>(";
                                            for ($c = 0; $c < count($kriterbol); $c++) {

                                                if ($c == count($kriterbol) - 1) {
                                                    $deger = $deger . round(trim($kriterbol[$c]) * trim($icerikbol[$c]), 3);
                                                    $aktar = round(trim($kriterbol[$c]) * trim($icerikbol[$c]), 3);
                                                    $aktarDb = round(trim($kriterbol[$c]) * trim($icerikbol[$c]), 3);
                                                    echo $aktar;
                                                    $dbGlobalAgirliklari = $dbGlobalAgirliklari . "," . $aktarDb;

                                                } else {
                                                    $deger = $deger . round(trim($kriterbol[$c]) *
                                                            trim($icerikbol[$c]), 3) . ",";

                                                    $aktarDb = round(trim($kriterbol[$c]) * trim($icerikbol[$c]), 3);
                                                    $aktar = round(trim($kriterbol[$c]) * trim($icerikbol[$c]), 3) . " , ";
                                                    echo $aktar;
                                                    $dbGlobalAgirliklari = $dbGlobalAgirliklari . "," . $aktarDb;

                                                }
                                            }
                                            $deger = $deger . "\n";
                                            echo ")<br>";
                                            $dbGlobalAgirliklari = $dbGlobalAgirliklari . "-";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                $dbGlobalAgirliklari = $dbGlobalAgirliklari . ";";
                            } ?>
                            </tbody>
                        </table>
                        <?php
                        $ac = fopen("../../../netting/fahp/altfaktordegerler.csv", "w+");

                        fwrite($ac, $deger);
                        fclose($ac);
                        ?>
                    </div>
                </div>
                <a href="../test" class="btn btn-info float-right">Test Et</a>

            <?php } ?>


            <?php

            if (file("../../../netting/fahp/sonuc.csv")) {
                $sonucfaktor = fopen("../../../netting/fahp/sonuc.csv", 'r');
                $sonucana = fread($sonucfaktor, filesize("../../../netting/fahp/sonuc.csv"));

                $sonuclar = explode("\n", $sonucana);
                fclose($sonucfaktor);
                ?>
                <br>
                <div>
                    <div style="text-align: center">
                        <h3 style="color: #0b93d5"> Aday Sonuçları </h3>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Aday</th>
                                <th>Sonuç Değerleri</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $a = 0;
                            for ($i = 0; $i < count($sonuclar) - 1; $i++) {
                                $a = $a + 1;
                                $sonuclarsatir = explode(",", $sonuclar[$i]);
                                ?>
                                <tr>
                                    <td style="font-weight: bold;"> <?php echo $a; ?></td>
                                    <td style="font-weight: bold;"><?php echo $sonuclarsatir[0] ?></td>
                                    <td style="font-weight: bold;">
                                        <?php echo "( $sonuclarsatir[1], $sonuclarsatir[2], $sonuclarsatir[3] )"; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <?php

                $toplam = array();
                $isim = "";
                $maxx = 0;
                for ($i = 0; $i < count($sonuclar) - 1; $i++) {
                    $minsum = 0;
                    $sonuclarsatir = explode(",", $sonuclar[$i]);
                    $minsum = $sonuclarsatir[1] + $sonuclarsatir[2] + $sonuclarsatir[3];
                    $minsum = number_format($minsum / 3, 2);
                    array_push($toplam, $minsum);


                    if (max($toplam) == $minsum) {

                        $isim = $sonuclarsatir[0];

                    }


                }
                ?>
                <br><br>
                <hr>
                <div style="text-align: center">
                    <h4 style="color: #0b93d5"> En iyi Sonuç : <?php echo $isim ?> </h4>
                </div>
            <?php } ?>


        </div>
    </div>

</section>
