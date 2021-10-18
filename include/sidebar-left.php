<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href=<?php echo base_url() . "fahp" ?> class="nav-link">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                        Fuzzy AHP
                    </p>
                </a>
            </li>

            <?php if($_SESSION['kullanici']) { ?>
            <li class="nav-item">
                <a href=<?php echo base_url() . "fahp/models" ?> class="nav-link">
                    <i class="nav-icon fa fa-list"></i>
                    <p>
                        Kayıtlı Modeller
                    </p>
                </a>
            </li>
            <?php } ?>

            <li class="nav-item">
                <a href=<?php echo base_url() . "damizlik" ?> class="nav-link">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                        Damızlık Seçimi
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href=<?php echo base_url() . "puantaj" ?> class="nav-link">
                    <i class="nav-icon fas fa-chart-line"></i>
                    <p>
                        Puantaj Yöntemleri
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href=<?php echo base_url() . "ortak-puantaj" ?> class="nav-link">
                    <i class="nav-icon fas fa-fan"></i>
                    <p>
                        Ortak Puantaj Sistemi
                    </p>
                </a>
            </li>

            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-address-book"></i>
                    <p>
                        Irk Özellikleri
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href=<?php echo base_url() . "esmer" ?> class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Esmer Irk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href=<?php echo base_url() . "holstein" ?> class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Holştein</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href=<?php echo base_url() . "jersey" ?> class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Jersey</p>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a href=<?php echo base_url() . "genel" ?> class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Genel Görünüş
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href=<?php echo base_url() . "sutculuk" ?> class="nav-link">
                    <i class="nav-icon fas fa-water"></i>
                    <p>
                        Sütçülük Karakteri
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href=<?php echo base_url() . "beden" ?> class="nav-link">
                    <i class="nav-icon fas fa-book-dead"></i>
                    <p>
                        Beden Kapasitesi
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href=<?php echo base_url() . "sistem" ?> class="nav-link">
                    <i class="nav-icon fas fa-book-dead"></i>
                    <p>
                        Meme Sistemi
                    </p>
                </a>
            </li>

            <?php if(!$_SESSION['kullanici']) { ?>
            <li class="nav-item">
                <a href="<?php echo base_url() . "login/" ?>" class="nav-link">
                    <i class="nav-icon far fa-circle text-info"></i>
                    <p>Giriş Yap</p>
                </a>
            </li>
            <?php } else {  ?>

            <li class="nav-item">
                <a href="<?php echo base_url() . "netting/fahp/islem.php/?cikisyap=true" ?>" class="nav-link">
                    <i class="nav-icon far fa-circle text-info"></i>
                    <p>Çıkış Yap</p>
                </a>
            </li>

            <?php } ?>

            <li class="nav-item">
                <a href="https://rifaikuci.com/" class="nav-link">
                    <i class="nav-icon far fa-circle text-info"></i>
                    <p>İletişim</p>
                </a>
            </li>
        </ul>
    </nav>