<?php include_once __DIR__ . '/includes/menu.php'; ?>

  <section class="WelcomeArea">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 text-left">
                    <div class="Welcometext">
                        <!-- Texto de boas-vindas -->
                        <div class="WelcomeContent">
                            <h1 class="text-uppercase" data-aos="fade-down" data-aos-delay="250">Agilize suas entregas sem sair de casa</h1>
                            <p data-aos="fade-down" data-aos-delay="500">Para você, para sua empresa, a qualquer hora!</p>
                            <button data-toggle="modal" data-target="#signup" class="site-btn" data-aos="fade-down" data-aos-delay="750">Comece Agora</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    

    <section class="Features section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title" data-aos="fade-right" data-aos-once="true" data-aos-delay="0">
                        <h2>Rápido. Acessível. Fácil de usar!</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="feature-right">
                        <div class="watch-inner">
                            <div class="img-head" data-aos="fade-down" data-aos-delay="250">
                                <img src="<?= IMG ?>/delivery_address.svg" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="feature-content">
                        <div class="feature-item" data-aos="fade-right" data-aos-delay="500">
                            <div class="feature-thumb">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <div class="banner-content">
                                <h2 class="title">Serviço 24/7</h2>
                                <p>Conectamos você a diversos veículos e motoristas todos os dias, a qualquer hora. Esteja pronto para atender suas demandas a qualquer momento!</p>
                            </div>
                        </div>
                        <div class="feature-item" data-aos="fade-right" data-aos-delay="750">
                            <div class="feature-thumb">
                                <i class="fa fa-truck"></i>
                            </div>
                            <div class="banner-content">
                                <h2 class="title">Rapidez Garantida</h2>
                                <p>Peça um veículo e entregue seus produtos em questão de minutos. Seus clientes ficarão encantados com a eficiência do serviço de entrega no mesmo dia!</p>
                            </div>
                        </div>
                        <div class="feature-item" data-aos="fade-right" data-aos-delay="1000">
                            <div class="feature-thumb">
                                <i class="fa fa-usd"></i>
                            </div>
                            <div class="banner-content">
                                <h2 class="title">Cabe no seu bolso</h2>
                                <p>Sem contrato. Sem comissões. Sem confusão. Oferecemos o serviço de entregas mais acessível do mercado, a partir de R$ 6,00*. Entregue qualidade sem comprometer seu bolso!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Banner Begin -->
    <div class="banner section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title" data-aos="fade-right" data-aos-once="true">
                        <h2>Nossos apps</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic" data-aos="fade-down" data-aos-delay="200" data-aos-once="true">
                        <a href="#"><img src="<?= IMG ?>/google-play.png" alt="Google Play"></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic" data-aos="fade-down" data-aos-delay="400" data-aos-once="true">
                        <a href="#"><img src="<?= IMG ?>/apple.png" alt="App Store"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    
        <!-- Steps Section Begin -->
    <section class="steps section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="steps-section-title" data-aos="fade-right" data-aos-once="true">
                        <h2>Como Funciona</h2>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center" data-aos="fade-down" data-aos-delay="0" data-aos-once="true">
                    <div class="steps__widget">
                        <span class="fa fa-mobile"></span>
                        <h4>Passo 1</h4>
                        <p>Cadastre a entrega que precisa fazer</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center" data-aos="fade-down" data-aos-delay="250" data-aos-once="true">
                    <div class="steps__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Passo 2</h4>
                        <p>Informe o endereço de coleta e entrega</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center" data-aos="fade-down" data-aos-delay="500" data-aos-once="true">
                    <div class="steps__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Passo 3</h4>
                        <p>Escolha o horário mais conveniente</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center" data-aos="fade-down" data-aos-delay="750" data-aos-once="true">
                    <div class="steps__widget">
                        <span class="fa fa-truck"></span>
                        <h4>Passo 4</h4>
                        <p>O motorista parceiro recebe e entrega sua encomenda</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Steps Section End -->
    
    <!-- Vehicles Section Begin -->
    <section class="vehicles-table section">
        <div class="container">
            <div class="row">
                 <div class="col-lg-12">
                    <div class="section-title" data-aos="fade-right" data-aos-once="true">
                        <h2>O veículo certo para a sua entrega</h2>
                        <p>Com nosso sistema, você pode cadastrar suas entregas de forma rápida e fácil, escolhendo o veículo ideal para cada situação.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Table -->
                    <div class="single-table" data-aos="fade-down" data-aos-delay="0">
                        <!-- Table Head -->
                        <div class="table-head">
                            <h4 class="title">Motos</h4>
                            <p>Ideal para documentos, pacotes pequenos e delivery de comida</p>
                            <div class="price">
                                <img src="<?= IMG ?>/moto.png" alt="">
                            </div>
                        </div>
                        <!-- Table List -->
                        <ul class="table-list">
                            <li>Tarifa base: R$ 6 (0-3 km) </li>
                            <li>3-15 km: R$ 0,70/km </li>
                            <li>Até 20 kg</li>
                        </ul>
                    </div>
                    <!-- End Single Table-->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Table -->
                    <div class="single-table" data-aos="fade-down" data-aos-delay="250">
                        <p class="popular">Mais usado</p>
                        <!-- Table Head -->
                        <div class="table-head">
                            <h4 class="title">Carros</h4>
                            <p>Perfeito para compras de mercado e pacotes médios.</p>
                            <div class="price">
                                <img src="<?= IMG ?>/carro.png" alt="">
                            </div>
                        </div>
                        <!-- Table List -->
                        <ul class="table-list">
                            <li>Tarifa base: R$ 12 (0-3 km) </li>
                            <li>3-15 km: R$ 2,20/km </li>
                            <li>Até 300 kg</li>
                        </ul>
                    </div>
                    <!-- End Single Table-->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Table -->
                    <div class="single-table" data-aos="fade-down" data-aos-delay="500">
                        <!-- Table Head -->
                        <div class="table-head">
                            <h4 class="title">Caminhões</h4>
                            <p>Ideal para mudanças ou materiais grandes e pesados.</p>
                            <div class="price">
                                <img src="<?= IMG ?>/caminhao.png" alt="">
                            </div>
                        </div>
                        <!-- Table List -->
                        <ul class="table-list">
                            <li>Tarifa base: R$ 100 (0-3 km) </li>
                            <li>3-22 km: R$ 5,60/km </li>
                            <li>Até 1.500 kg</li>
                        </ul>
                    </div>
                    <!-- End Single Table-->
                </div>
            </div>
        </div>
    </section>
    <!-- Vehicles Section End -->

    <section class="section-call call-version-banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-7">
                    <div class="section-title mb-60">
                        <h2 class="text-white" data-aos="fade-right" data-aos-delay="0">Não perca tempo!</h2>
                        <p class="text-white" data-aos="fade-right" data-aos-delay="250">Inicie agora mesmo e otimize suas entregas!</p>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-5">
                    <div class="contact-btn text-right text-lg-right button" data-aos="fade-right" data-aos-delay="500">
                        <a data-toggle="modal" data-target="#signup" class="btn mouse-dir">Comece agora!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once __DIR__ . '/includes/footer.php'; ?>
