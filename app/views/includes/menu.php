    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">

        <?php if(isset($_SESSION['user_id'])){ ?>

        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="<?= ($menuDinamic == "/dashboard" ? "active" : ""); ?>">
                    <a href="<?= BASE_URL ?>usuario/dashboard">Home</a>
                </li>
                <li class="<?= ($menuDinamic == "/minhas-encomendas" ? "active" : ""); ?>">
                    <a href="<?= BASE_URL ?>usuario/minhas-encomendas">Minhas encomendas</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-user"></i> <?= "Oi, ".$_SESSION['first_name']; ?></a>
                    <ul class="header__menu__dropdown">
                        <li>
                            <a href="<?= BASE_URL ?>usuario/meus-dados"><i class="fa fa-list-ol"></i> Meus dados</a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>usuario/logout"><i class="fa fa-sign-out"></i> Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <?php }elseif(isset($_SESSION['driver_id'])){ ?>
        
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="<?= ($menuDinamic == "/dashboard" ? "active" : ""); ?>">
                    <a href="<?= BASE_URL ?>motorista/dashboard">Home</a>
                </li>
                <li class="<?= ($menuDinamic == "/minhas-entregas" ? "active" : ""); ?>">
                    <a href="<?= BASE_URL ?>motorista/minhas-entregas">Minhas entregas</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-user"></i> <?= "Oi, ".$_SESSION['first_name']; ?></a>

                    <ul class="header__menu__dropdown">
                        <li>
                            <a href="<?= BASE_URL ?>usuario/logout"><i class="fa fa-sign-out"></i> Sair</a>
                        </li>
                    </ul>

                </li>
            </ul>
        </nav>

        <?php }else{ ?>

        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <button class="site-btn" data-toggle="modal" data-target="#signin">Entrar</button>
                <button class="site-btn site-btn-secondary" data-toggle="modal" data-target="#signup">Criar conta</button>
            </div>
        </div>

        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="<?= ($menuDinamic == "/" ? "active" : ""); ?>">
                    <a href="<?= BASE_URL ?>">Home</a>
                </li>
                <li class="<?= ($menuDinamic == "/rastreio" ? "active" : ""); ?>">
                    <a href="<?= BASE_URL ?>rastreio">Rastrear</a>
                </li>
            </ul>
        </nav>

        <?php } ?>
        
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

                <?php if(isset($_SESSION['user_id'])){ ?>

                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="<?= ($menuDinamic == "/dashboard" ? "active" : ""); ?>">
                                <a href="<?= BASE_URL ?>usuario/dashboard">Home</a>
                            </li>
                            <li class="<?= ($menuDinamic == "/minhas-encomendas" ? "active" : ""); ?>">
                                <a href="<?= BASE_URL ?>usuario/minhas-encomendas">Minhas encomendas</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                
                <div class="col-lg-3">
                    <nav class="header__menu">
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-user"></i> <?= "Oi, " . $_SESSION['first_name']; ?>
                                </a>
                                <ul class="header__menu__dropdown">
                                    <li>
                                        <a href="<?= BASE_URL ?>usuario/meus-dados"><i class="fa fa-list-ol"></i> Meus dados</a>
                                    </li>
                                    <li>
                                        <a href="<?= BASE_URL ?>usuario/logout"><i class="fa fa-sign-out"></i> Sair</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>

                <?php }elseif(isset($_SESSION['driver_id'])){ ?>

                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="<?= ($menuDinamic == "/dashboard" ? "active" : ""); ?>">
                                <a href="<?= BASE_URL ?>motorista/dashboard">Home</a>
                            </li>
                            <li class="<?= ($menuDinamic == "/meus-pedidos" ? "active" : ""); ?>">
                                <a href="<?= BASE_URL ?>motorista/minhas-entregas">Minhas entregas</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                
                <div class="col-lg-3">
                    <nav class="header__menu">
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-user"></i> <?= "Oi, " . $_SESSION['first_name']; ?>
                                </a>
                                <ul class="header__menu__dropdown">
                                    <li>
                                        <a href="<?= BASE_URL ?>motorista/logout"><i class="fa fa-sign-out"></i> Sair</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>       

                <?php }else{ ?>

                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="<?= ($menuDinamic == "/" ? "active" : ""); ?>">
                                <a href="<?= BASE_URL ?>">Home</a>
                            </li>
                            <li class="<?= ($menuDinamic == "/rastreio" ? "active" : ""); ?>">
                                <a href="<?= BASE_URL ?>rastreio">Rastrear</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                
                <div class="col-lg-3">
                    <div class="header__signup">
                        <button class="site-btn" data-toggle="modal" data-target="#signin">Entrar</button>
                        <button class="site-btn site-btn-secondary" data-toggle="modal" data-target="#signup">Criar conta</button>
                    </div>
                </div>

                <?php } ?>
                
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <?php 
        
        // Imprime os modais de login ou cadastro
        if(!isset($_SESSION['user_id']) && !isset($_SESSION['driver_id'])){ 

            include_once __DIR__ . '/startinModal.php'; 
        
        } 
    
    ?>