<!DOCTYPE html>
<html>
<head>
    <?php require_once "../../../include/helper.php"; ?>
    <?php include "../../../include/head.php" ?>
    <?php include "../../../include/style.php" ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <?php include "../../../include/sidebar-right.php" ?>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href=<?php echo base_url() ?> class="brand-link">

            <span style="color: #0b93d5;font-weight: bold" class="brand-text"><?php echo $_SESSION['kullanici'] ? $_SESSION['kullanici'] : "Damızlık Seçimi"  ?></span>
        </a>

        <div class="sidebar">
            <?php include '../../../include/sidebar-left.php' ?>
        </div>
    </aside>
    <div class="content-wrapper">
        <?php include "page-top-info.php"; ?>
        <?php include "main-page.php"; ?>
    </div>
    <?php include '../../../include/footer.php' ?>
    <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
<?php include('../../../include/script.php') ?>
</body>
</html>