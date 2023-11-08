<?php include_once __DIR__ . '/includes/menu.php'; ?>
    
    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title section-title">
                        <h2>Fale conosco</h2>
                        <p>Alguma reclamação, suporte ou sugestão? Estamos aqui pra te ouvir!</p>
                    </div>
                </div>
            </div>
            <form action="<?= BASE_URL ?>contato/send" method="post">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" name="name" id="name" placeholder="Seu nome" required>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="email" name="email" id="email" placeholder="Seu email" value="<?= isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "" ?><?= isset($_SESSION['driver_email']) ? $_SESSION['driver_email'] : "" ?>" required>
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea name="message" id="message" placeholder="Sua mensagem" required></textarea>
                        <button type="submit" class="site-btn"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar mensagem</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->

<?php include_once __DIR__ . '/includes/footer.php'; ?>
