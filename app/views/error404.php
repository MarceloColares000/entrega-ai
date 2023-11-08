<?php include_once __DIR__ . '/includes/menu.php'; ?>
    
<div class="container">

        <div class="o-hidden my-5">
           
            <div class="text-center">
                <div class="section-title" data-aos="fade-right" data-aos-once="true">
                    <h2>404</h2>
                </div>
                <p class="lead text-gray-800">A página não foi encontrada!</p>
                <p class="text-gray-500"><?= $message ?></p>
                <a href="<?= BASE_URL ?>" class="site-btn my-3"><i class="fa fa-arrow-left"></i> Voltar ao início</a>
            </div>

        </div>

</div>
    
<?php include_once __DIR__ . '/includes/footer.php'; ?>
