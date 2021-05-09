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
$kriterler = explode(",", $item);

fclose($dosya);
?>


<section class="content">

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <br><br>

                    <u><strong>Kriterler</strong></u>

                    <ul>
                        <?php for ($i = 0; $i < count($kriterler); $i++) { ?>
                            <li style="margin: 5px">
                                <?php $a = $i + 1;
                                echo "K" . $a . " => " . $kriterler[$i]; ?>
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
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 50px;text-align: center;">#</th>

                    <?php for ($i = 0; $i < count($kriterler); $i++) { ?>
                        <th style="width: 50px;text-align: center">
                            <?php echo $kriterler[$i]; ?>
                        </th>
                    <?php } ?>
                </tr>
                </thead>


                <?php for ($k = 0; $k < count($kriterler); $k++) { ?>
                    <tr>
                        <td style="text-align: center">
                            <b> <?php echo $kriterler[$k]; ?></b>
                        </td>

                        <?php for ($a = 0; $a < count($kriterler); $a++) { ?>
                            <?php if ($k == $a) { ?>

                                <td style="text-align: center">
                                    <?php echo "<b>1</b>"; ?>
                                </td>

                            <?php } else { ?>
                                <?php if ($a > $k) { ?>

                                    <td style="text-align: center">

                                        <?php $c = 0;
                                        while ($c < 3) { ?>
                                            <input name="<?php echo $k . ";" . $a . ";" . $c ?>"
                                                   type="number" step="0.01" value="0.00"
                                                   style="text-align: center; width:52px">
                                            <?php $c++;
                                        } ?>
                                    </td>
                                <?php } else { ?>
                                    <td style="text-align: center"></td>
                                <?php }
                            }
                        } ?>
                    </tr>
                <?php } ?>
            </table>
                <input name="id" value="<?php echo $_GET['id'] ?>" type="hidden">

                <div class="card-footer">
                    <div>
                        <button type="submit" name="faktorkaydet" class="btn btn-info float-right">İlerle</button>
                        <a href='javascript:history.back(1)' type="submit"
                           class="btn btn-default float-left">Geri</a>
                    </div>
                </div>
            </form>
        </div>


    </div>
</section>
