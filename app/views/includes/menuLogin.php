<!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
            <?php if ($menuDinamic == "driverLogin" || $menuDinamic == "driverRegister"): ?>
                <a href="<?= ($menuDinamic != "driverLogin") ? BASE_URL . 'motorista/login' : BASE_URL . 'motorista/cadastrar' ?>" class="site-btn site-btn-secondary">
                    <?= ($menuDinamic != "driverLogin") ? 'Já tenho uma conta' : 'Criar uma conta' ?>
                </a>
            <?php elseif ($menuDinamic == "userLogin" || $menuDinamic == "userRegister"): ?>
                <a href="<?= ($menuDinamic != "userLogin") ? BASE_URL . 'usuario/login' : BASE_URL . 'usuario/cadastrar' ?>" class="site-btn site-btn-secondary">
                    <?= ($menuDinamic != "userLogin") ? 'Já tenho uma conta' : 'Criar uma conta' ?>
                </a>
            <?php endif; ?>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="<?= BASE_URL ?>"><img src="<?= IMG ?>/entrega-ai.png" class="logo_img" alt=""></a>
                    </div>
                </div>
                
                    <div class="col-lg-9">
                        <div class="header__signup">
                            <?php if ($menuDinamic == "driverLogin" || $menuDinamic == "driverRegister"): ?>
                                <a href="<?= ($menuDinamic != "driverLogin") ? BASE_URL . 'motorista/login' : BASE_URL . 'motorista/cadastrar' ?>" class="site-btn site-btn-secondary">
                                    <?= ($menuDinamic != "driverLogin") ? 'Já tenho uma conta' : 'Criar uma conta' ?>
                                </a>
                            <?php elseif ($menuDinamic == "userLogin" || $menuDinamic == "userRegister"): ?>
                                <a href="<?= ($menuDinamic != "userLogin") ? BASE_URL . 'usuario/login' : BASE_URL . 'usuario/cadastrar' ?>" class="site-btn site-btn-secondary">
                                    <?= ($menuDinamic != "userLogin") ? 'Já tenho uma conta' : 'Criar uma conta' ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    