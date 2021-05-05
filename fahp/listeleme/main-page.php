<?php
$dosya = fopen("../../netting/fahp/tablo1.csv", 'r');
$icerik = fread($dosya, filesize("../../netting/fahp/tablo1.csv"));

$kriterler = explode(",", $icerik);

fclose($dosya);
?>


<section class="content">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div style="text-align: right;margin-right: auto">
                        <a href="ekle" class="btn btn-primary"><i class="fa fa-plus"><?php echo "\t\t\t\t" ?>
                                Ekle</i></a>
                    </div>
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
                                    <?php   for($i=0;$i<count($kriterler); $i++) {
                                         $a = $i+1;
                                    ?>
                                    <tr>
                                        <td><?php echo $a?></td>
                                        <td><?php echo $kriterler[$i];?></td>
                                        <td>
                                            <a href="#" class="btn btn-primary float-left">Alt Faktör Oluştur</a>

                                        </td>
                                        <td>0</td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</section>
