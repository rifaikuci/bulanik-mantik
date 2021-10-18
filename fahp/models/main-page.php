<?php
include '../../netting/fahp/baglan.php';
unlink("./../../netting/fahp/sonuc.csv");
$kullanici = $_SESSION['kullanici'];
$sql = "SELECT * FROM models where kullanici = '$kullanici'";
$result = $db->query($sql); ?>

<section class="content">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Model Adı</th>
                                    <th>Kayıt Tarihi</th>
                                    <th>İşlem</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sira = 1;
                                while ($row = $result->fetch_array()) { ?>
                                    <tr>
                                        <td><?php echo $sira; ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['tarih'] ?></td>
                                        <td>
                                            <a href="<?php echo "model/?id=".$row['id']?>"
                                               class="btn btn-primary"> Görüntüle & Test Et
                                            </a>
                                            <a href="<?php echo "../../netting/fahp/islem.php/?silmodel=".$row['id']?>"
                                               class="btn btn-danger"> Sil
                                            </a>

                                        </td>
                                    </tr>
                                    <?php
                                    $sira++;
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>
