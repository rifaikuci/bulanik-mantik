<?php
$dosya = fopen("../../netting/fahp/alt1.csv", 'r');
$icerik = fread($dosya, filesize("../../netting/fahp/alt1.csv"));
$altfaktor = explode("\n", $icerik);

$item = null;
foreach($altfaktor as $alt) {
    if ($_GET['id'] == substr($alt,0,1)) {
        $item = $alt;
        break;
    }
}

$item = substr($item,2);
$ayirac = explode(",", $item);

$kriterUzunluk = count($ayirac);

fclose($dosya);


$dosyaDegerler = fopen("../../netting/fahp/alt3.csv", 'r');
$icerikDegerler = fread($dosyaDegerler, filesize("../../netting/fahp/alt3.csv"));

$ayiracSatirlar = explode("\n", $icerikDegerler);
array_pop($ayiracSatirlar);

$degerler = [];


for ($i = 0; $i < count($ayiracSatirlar); $i++) {
    $ekle = "ekle" . $i;
    $ekle = explode(",", $ayiracSatirlar[$i]);
    array_push($degerler, $ekle);
}


fclose($dosyaDegerler);

$dosya1 = fopen("../../netting/fahp/alt4.csv", 'r');
$icerik1 = fread($dosya1, filesize("../../netting/fahp/alt4.csv"));
fclose($dosya1);
$bolenler = explode(",", $icerik1);


$dosyaname = "altsonuc".$_GET['id'].".csv";
$dosyaSonuc= fopen("../../netting/fahp/$dosyaname", 'r');
$icerikSonuc= fread($dosyaSonuc, filesize("../../netting/fahp/$dosyaname"));

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
<section class="content">

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <br><br>

                    <u><strong>Kriterler</strong></u>

                    <ul>
                        <?php for ($i = 0; $i < count($ayirac); $i++) { ?>
                            <li style="margin: 5px">
                                <?php $a = $i + 1;
                                echo "K" . $a . " => " . $ayirac[$i]; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="col-sm-6">
                    <br><br>

                    <u><strong>Bulanık ölçek değerleri</strong></u>
                    <ul>
                        <li style="margin: 5px">
                            Yeterli => 1
                        </li>
                        <li style="margin: 5px">
                            Orta => 3
                        </li>
                        <li style="margin: 5px">
                            Güçlü => 5
                        </li>
                        <li style="margin: 5px">
                            Çok Güçlü => 7
                        </li>
                        <li style="margin: 5px">
                            Aşırı Güçlü => 9
                        </li>
                        <li style="margin: 5px">
                            Ara değerler => 2, 4, 6, 8
                        </li>
                    </ul>
                </div>
            </div>
            <br><br><br>
            <form action="../../netting/fahp/islem.php"
                  method="post"
                  class="form-horizontal">
                <div style="text-align: center">
                    <h3 style="color: #0b93d5"> Fuzzy AHP Ağırlık Değerleri </h3>
                </div>
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

                            <?php
                            $deger = "(";
                            for ($i = 0; $i < 3; $i++) {
                                if ($i + 1 == 3) {

                                    $sonuc = round($degerler[$k][$i] * $bolenler[$i], 3);
                                    $deger = $deger . $sonuc;
                                    $yazilacak = $yazilacak . $sonuc;


                                } else {

                                    $sonuc = round($degerler[$k][$i] * $bolenler[$i], 3);
                                    $deger = $deger . $sonuc . ",";
                                    $yazilacak = $yazilacak . $sonuc . ",";


                                }
                            }
                            $yazilacak = $yazilacak . "\n";
                            $deger = $deger . ")";
                            ?>

                            <b> <?php echo $deger; ?></b>
                        </td>

                        <td style="text-align: center">

                            <?php

                            $degerOrtalamasi =0;
                            for ($i = 0; $i < 3; $i++) {
                                $degerOrtalamasi = $degerOrtalamasi + $sonuclar[$k][$i];
                            }

                            ?>

                            <b> <?php
                                $degerOrtalamasi = round($degerOrtalamasi/3,3);
                                array_push($agirlikOrtalamaSonuclari,$degerOrtalamasi);
                                echo $degerOrtalamasi; ?></b>
                        </td>
                    </tr>
                <?php } ?>

            </table>
                <br>

                <div style="text-align: center"><h3><b><?php
                            $index = array_search(max($agirlikOrtalamaSonuclari), $agirlikOrtalamaSonuclari);
                            echo "En iyi Seçim : " . $ayirac[$index] . ", Değer = " . max($agirlikOrtalamaSonuclari);
                            ?></b></h3></div>
                <div class="card-footer">
                    <div>
                        <a href='../listeleme' class="btn btn-info float-right">Devam Et<a/>
                        <a href='javascript:history.back(1)' type="submit"
                           class="btn btn-default float-left">Geri</a>
                    </div>
                </div>
            </form>
        </div>


    </div>
</section>
