<?php

$dosya = fopen("../../netting/fahp/tablo1.csv", 'r');
$icerik = fread($dosya, filesize("../../netting/fahp/tablo1.csv"));

$ayirac = explode(",", $icerik);
$kriterUzunluk = count($ayirac);

fclose($dosya);


$dosyaDegerler = fopen("../../netting/fahp/tablo2.csv", 'r');
$icerikDegerler = fread($dosyaDegerler, filesize("../../netting/fahp/tablo2.csv"));

$ayiracSatirlar = explode("\n", $icerikDegerler);
array_pop($ayiracSatirlar);

$satirlar = [];

for ($i = 0; $i < count($ayiracSatirlar); $i++) {
    $ekle = "ekle" . $i;
    $ekle = explode(";", $ayiracSatirlar[$i]);
    array_push($satirlar, $ekle);
}

$sutunlar = [];

for ($i = 0; $i < count($satirlar); $i++) {
    for ($j = 0; $j < count($satirlar); $j++) {

        $ekle = "ekle" . $i . "-" . $j;
        $ekle = explode(",", $satirlar[$i][$j]);
        array_push($sutunlar, $ekle);

    }
}

$geometrikDegerlek = [];

$toplamHucre = count($satirlar) * count($satirlar);
$kriterUzunluk = count($satirlar);

for ($a = 0; $a < $kriterUzunluk; $a++) {

    if ($a != 0) {
        $satir = floor($a * $kriterUzunluk / $kriterUzunluk);
    } else {
        $satir = 0;
    }

    $c = 0;
    $gDeger = 1;
    $gDeger1 = 1;
    $gDeger2 = 1;
    while ($c < $kriterUzunluk) {

        $deger = $sutunlar[$satir * $kriterUzunluk + $c][0];
        $deger1 = $sutunlar[$satir * $kriterUzunluk + $c][1];
        $deger2 = $sutunlar[$satir * $kriterUzunluk + $c][2];

        $gDeger = $deger * $gDeger;
        $gDeger1 = $deger1 * $gDeger1;
        $gDeger2 = $deger2 * $gDeger2;
        $c++;
    }
    $gDeger = round(pow($gDeger, 1 / $kriterUzunluk), 2);
    $gDeger1 = round(pow($gDeger1, 1 / $kriterUzunluk), 2);
    $gDeger2 = round(pow($gDeger2, 1 / $kriterUzunluk), 2);

    array_push($geometrikDegerlek, $gDeger);
    array_push($geometrikDegerlek, $gDeger1);
    array_push($geometrikDegerlek, $gDeger2);

}

fclose($dosyaDegerler);
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
                    <h3 style="color: #0b93d5"> Fuzzy AHP Değerleri </h3>
                </div>
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 50px;text-align: center;">#</th>
                    <?php for ($i = 0; $i < count($ayirac); $i++) { ?>
                        <th style="width: 50px;text-align: center">
                            <?php echo $ayirac[$i]; ?>
                        </th>
                    <?php } ?>
                    <th style="text-align: center; ">
                        Geometik D.
                    </th>
                </tr>
                </thead>



                            <?php $deger = "";

                            for ($k = 0; $k < $kriterUzunluk; $k++) { ?>
                                <tr>
                                    <td style="text-align: center">
                                        <b> <?php echo $ayirac[$k]; ?></b>
                                    </td>

                                    <?php for ($a = 0; $a < $kriterUzunluk; $a++) { ?>
                                        <td style="text-align: center;font-size: large;color: #1c2d3f">
                                            <b><?php echo $satirlar[$k][$a]; ?></b>
                                        </td>
                                    <?php } ?>

                                    <td style="text-align: center;font-size: large;color: #1c2d3f">
                                        <b>
                                            <?php $alinacakDeger = count($geometrikDegerlek) / $kriterUzunluk;
                                            $d = 0;
                                            $deger1 = "(";

                                            while ($d < $alinacakDeger) {
                                                if ($d + 1 == $alinacakDeger) {

                                                    $deger = $deger . $geometrikDegerlek[($k * $alinacakDeger) + $d];
                                                    $deger1 = $deger1 . $geometrikDegerlek[($k * $alinacakDeger) + $d];
                                                } else {
                                                    $deger = $deger . $geometrikDegerlek[($k * $alinacakDeger) + $d] . ",";
                                                    $deger1 = $deger1 . $geometrikDegerlek[($k * $alinacakDeger) + $d] . ",";
                                                }
                                                $d++;
                                            }

                                            $deger = $deger . "\n";
                                            echo $deger1 . ")";
                                            ?></b>
                                    </td>
                                </tr>
                            <?php }

                            $dosya = fopen("../../netting/fahp/tablo3.csv", 'w+');
                            fwrite($dosya, $deger);
                            fclose($dosya);

                            $dosyaAlternatif = fopen("../../netting/fahp/tablo3.csv", 'r');
                            $icerikAlternatif = fread($dosyaAlternatif, filesize("../../netting/fahp/tablo3.csv"));

                            $ayiracAlternatif = explode("\n", $icerikAlternatif);
                            array_pop($ayiracAlternatif);

                            $dizi = [];

                            for ($i = 0; $i < count($ayiracAlternatif); $i++) {
                                $ekle = "ekle" . $i;
                                $ekle = explode(",", $ayiracAlternatif[$i]);
                                array_push($dizi, $ekle);
                            }

                            $satirUzunlugu = count($dizi[0]);
                            $sutunUzunlugu = count($ayiracAlternatif); ?>
                <tr>
                    <?php for ($a = 0; $a < $kriterUzunluk; $a++) { ?>
                        <td style="text-align: center;font-size: large;color: #1c2d3f">
                            <b><?php echo "-"; ?></b>
                        </td>
                    <?php } ?>
                    <td>+</td>

                    <?php
                    $yazilacak = "(";
                    $deger = [];
                    for ($a = 0; $a < $satirUzunlugu; $a++) {
                        $toplam = 0;

                        for ($b = 0; $b < $sutunUzunlugu; $b++) {
                            $toplam = $dizi[$b][$a] + $toplam;
                        }

                        if ($satirUzunlugu == $a + 1) {
                            $yazilacak = $yazilacak . $toplam;
                            array_push($deger, $toplam);
                        } else {
                            $yazilacak = $yazilacak . $toplam . ",";
                            array_push($deger, $toplam);
                        }
                    }

                    $yazilacak = $yazilacak . ")"; ?>

                    <td style="text-align: center;font-size: large;color: #006dcc">
                        <b><?php echo $yazilacak; ?></b>
                    <td>
                </tr>
            </table>


                <?php
                $deger = array_reverse($deger);
                $yazilacak = "";
                for ($i = 0; $i < count($deger); $i++) {
                    if ($deger[$i] != 0) {
                        $sonuc = round(1 / $deger[$i], 2);
                        if ($i + 1 == count($deger)) {
                            $yazilacak = $yazilacak . $sonuc;
                        } else {
                            $yazilacak = $yazilacak . $sonuc . ",";

                        }
                    }
                }

                $dosya = fopen("../../netting/fahp/tablo4.csv", 'w+');
                fwrite($dosya, $yazilacak);
                fclose($dosya); ?>
                <div class="card-footer">
                    <div>
                        <a href="../hesapla3" class="btn btn-info float-right">İlerle</a>
                        <a href='javascript:history.back(1)' type="submit"
                           class="btn btn-default float-left">Geri</a>
                    </div>
                </div>
            </form>
        </div>


    </div>
</section>
