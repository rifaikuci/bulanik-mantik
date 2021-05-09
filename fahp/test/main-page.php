<?php
$dosya = fopen("../../netting/fahp/altfaktordegerler.csv", 'r');
$icerik = fread($dosya, filesize("../../netting/fahp/altfaktordegerler.csv"));

$kriterler = explode("\n", $icerik);

fclose($dosya);
?>


<section class="content">
    <form method="POST" action="../../netting/fahp/islem.php">
        <input name="uzunluk" value="<?php echo count($kriterler)-1;?>" type="hidden">
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
            <form action="../../netting/fahp/islem.php"
                  method="post"
                  class="form-horizontal">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 50px;text-align: center;">#</th>
                    <th> Alt Faktörler </th>
                    <th>Global Bulanık </th>
                    <th>Puanlama</th>

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
                        <td>
                            <?php $c = 0;
                            while ($c < 3) { ?>
                                <input name="<?php echo $i . ";" . $c ?>"
                                       type="number" step="0.01" value="0.00"
                                       style="text-align: center; width:55px">
                                <?php $c++;
                            } ?>
                        </td>
                    </tr>
                <?php
                    $a++;
                } ?>
            </table>
                <div class="card-footer">
                    <div>
                        <button type="submit" name="testsonuclari" class="btn btn-info float-right">İlerle</button>
                        <a href='javascript:history.back(1)' type="submit"
                           class="btn btn-default float-left">Geri</a>
                    </div>
                </div>
            </form>
        </div>


    </div>
    </form>
</section>
