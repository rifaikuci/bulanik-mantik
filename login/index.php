<!DOCTYPE html>
<html>
<head>
    <?php require_once "../include/helper.php"; ?>
    <?php include "../include/style.php" ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Yönetim Paneli </b> | Giriş Sistemi</a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <form action="../netting/fahp/islem.php" method="post">
                <div class="input-group mb-3">
                    <input required type="text" class="form-control" name="ad"
                           placeholder="Mail Giriniz....">
                </div>

                <div class="input-group mb-3">
                    <input required type="password" class="form-control" name="password"
                           placeholder="
                            Şifreniz">
                </div>
                <div class="row" style="text-align: center">

                    <div class="col-4" style="text-align: center">
                        <button name="girisyap" type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
                    </div>

                    <div class="col-4">
                    </div>
                    <div class="col-4">
                        <a href="register.php" class="btn btn-danger btn-block">Kayıt Ol</a>
                    </div>
                    <br>
                    <br>
                    <div class="col-1">
                    </div>
                    <div class="col-9" style="text-align: center">
                        <a href="../index.php" class="btn btn-outline-dark btn-block">Giriş Yapmadan Devam Et</a>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
            </form>

        </div>
        <?php if ($_GET['kullanici'] == "no") { ?>
            <div style="margin:10px" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Hata!</strong> Kullanıcı bulunamadı!!!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
</body>
</html>
