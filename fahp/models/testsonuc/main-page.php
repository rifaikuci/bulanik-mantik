<?php
$dosya = fopen("../../../netting/fahp/altfaktordegerler.csv", 'r');
$icerik = fread($dosya, filesize("../../../netting/fahp/altfaktordegerler.csv"));

$kriterler = explode("\n", $icerik);

fclose($dosya);

$dosya2 = fopen("../../../netting/fahp/puan.csv", 'r');
$icerik2 = fread($dosya2, filesize("../../../netting/fahp/puan.csv"));

$puan = explode("\n", $icerik2);

fclose($dosya2);

$dosya3 = fopen("../../../netting/fahp/testsonuc.csv", 'r');
$icerik3 = fread($dosya3, filesize("../../../netting/fahp/testsonuc.csv"));

$testsonuc = explode("\n", $icerik3);

$toplam1 = 0;
$toplam2 = 0;
$toplam3 = 0;
for($b = 0 ; $b<count($testsonuc)-1;$b++) {
    $testsatir = explode(",",$testsonuc[$b]);
    $toplam1 = $toplam1 +$testsatir[0];
    $toplam2 = $toplam2 +$testsatir[1];
    $toplam3 = $toplam3 +$testsatir[2];
}

fclose($dosya3);
?>


<section class="content">
    <form method="POST" action="../../../netting/fahp/islem.php">
        <input name="toplam1" type="hidden" value="<?php echo $toplam1;?>">
        <input name="toplam2" type="hidden" value="<?php echo $toplam2;?>">
        <input name="toplam3" type="hidden" value="<?php echo $toplam3;?>">
    <div class="card">
        <div class="card-body">
            <div class="row">
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
            <form action="../../../netting/fahp/islem.php"
                  method="post"
                  class="form-horizontal">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 50px;text-align: center;">#</th>
                    <th> Alt Faktörler </th>
                    <th>Global Bulanık </th>
                    <th>Puanlama</th>
                    <th>Test Sonuçları</th>

                </tr>
                </thead>

                <?php
                $a=1;
                for($i=0; $i<count($kriterler)-1; $i++) {
                    $satirbol = explode(",",$kriterler[$i]);
                    ?>

                    <tr>
                        <td style="text-align: center; font-weight: bold"><?php echo $a; ?></td>
                        <td style="text-align: center"><?php echo $satirbol[0]; ?></td>
                        <td style="text-align: center; font-weight: bold">
                            <?php echo "(".$satirbol[1].", ".$satirbol[2].", ".$satirbol[3].")"; ?>
                        </td>
                        <td style="font-weight: bold">
                            <?php echo " ( ".$puan[$i]." ) "; ?>
                        </td>
                        <td style="text-align: center; font-weight: bold">
                            <?php echo "( ".$testsonuc[$i]." )"; ?>
                        </td>
                    </tr>
                <?php $a++; } ?>
                <thead>
                <th>Toplam</th>
                <th></th>
                <th></th>
                <th></th>
                <th style="text-align: center"><?php echo "( ". $toplam1.", ".$toplam2.", ".$toplam3." )"?></th>
                </thead>
            </table>

                <div class="card-footer">
                    <div style="text-align: center">
                        <input name ="aday" placeholder="Kaydeceğiniz testi giriniz..." required>
                    </div>

                    <div>
                        <button type="submit" name="modeltestkaydet" class="btn btn-info float-right">İlerle</button>
                        <a href='javascript:history.back(1)' type="submit"
                           class="btn btn-default float-left">Geri</a>
                    </div>
                </div>
            </form>
        </div>


    </div>
    </form>
</section>
