<!DOCTYPE html>
<html>
<head>
    <?php require_once "../include/helper.php"; ?>
    <?php include "../include/style.php" ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Yönetim Paneli </b> | Kayıt Sistemi</a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <form action="../netting/fahp/islem.php" method="post">
                <div class="input-group mb-3">
                    <input required type="text" class="form-control" name="ad"
                           placeholder="Ad Soyadınızı Giriniz....">
                </div>

                <div class="input-group mb-3">
                    <input required type="email" class="form-control" name="mail"
                           placeholder="Mail Giriniz....">
                </div>

                <div class="input-group mb-3">
                    <input required type="password" class="form-control" name="password"
                           placeholder="
                            Şifreniz">
                </div>
                <div class="row" style="text-align: center">

                    <div class="col-4" style="text-align: center">
                        <button name="kayitol" type="submit" class="btn btn-primary btn-block">Kayıt Yol</button>
                    </div>
                    <div class="col-3">
                    </div>
                    <div class="col-5" style="text-align: center">
                        <a href="index.php" type="submit" class="btn btn-success btn-block">Giriş Ekranı </a>
                    </div>

                </div>
            </form>

        </div>

</body>
</html>
