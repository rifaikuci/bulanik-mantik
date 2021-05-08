<?php
$dosya = fopen("../../netting/fahp/tablo1.csv", 'r');
$icerik = fread($dosya, filesize("../../netting/fahp/tablo1.csv"));

$kriterler = explode(",", $icerik);

$id = $_GET['id'];
fclose($dosya);
?>
<section class="content">
    <div class="card">
        <div class="card-body">
            <form action="../../netting/fahp/islem.php" method="POST" class="form-horizontal">
                <div class="box-body" id="fahp">
                    <div class="form-group">

                        <label class="col-sm-4 control-label"><?php echo $kriterler[$id]. " Alt Faktörlerini giriniz"  ?></label>

                        <div class="col-sm-4">
                            <input type="text" v-model="veriKriter" placeholder="Kriter giriniz..."
                                   class="form-control">
                            <input type="hidden" name="kriter" :value="kriter" class="form-control">
                            <input type="hidden" name="id" value="<?php  echo $id;?>">
                            <br>

                            <div class="alert alert-danger alert-dismissible fade show" v-show="veriKriter_is_hata">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4><i class="icon fa fa-close"></i>Hata!!! </h4> <span>Kriter boş geçilemez</span>
                            </div>

                            <div style="text-align: center">
                                <button v-on:click="kriterEkle" class="btn btn-primary fa fa-plus">
                                    Kriter Ekle
                                </button>
                            </div>

                            <br><br><br>

                            <u><strong>Kriterler</strong></u>
                            <br><br>

                            <ul>
                                <li v-for="(s,index) in kriter">
                                    {{ s }}
                                    <a v-on:click="kriterSil(index)" class="btn  btn-danger pull-right">X</a>
                                    <br><br>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div>
                        <button type="submit" name="altfaktorekleme" class="btn btn-info float-right">İlerle</button>
                        <a href="#"
                           class="btn btn-warning float-left">Geri</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</section>
