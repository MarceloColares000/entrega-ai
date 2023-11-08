    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="<?= BASE_URL ?>"><img src="<?= IMG ?>/entrega-ai.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Sobre nós</h6>
                        <ul>
                            <li class="<?= ($menuDinamic == "/sobre" ? "active" : ""); ?>">
                                <a href="<?= BASE_URL ?>sobre">Sobre nós</a>
                            </li>
                            <li class="<?= ($menuDinamic == "/contato" ? "active" : ""); ?>">
                                <a href="<?= BASE_URL ?>contato">Fale conosco</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__widget">

                        <h6>Jurídico</h6>
                        <ul>
                            <li class="<?= ($menuDinamic == "/politica" ? "active" : ""); ?>">
                                <a href="<?= BASE_URL ?>politica-de-privacidade">Política de privacidade</a>
                            </li>
                            <li class="<?= ($menuDinamic == "/termos" ? "active" : ""); ?>">
                                <a href="<?= BASE_URL ?>termos-de-uso">Termos de uso</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p>
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos os direitos reservados | Entrega aí - Serviço de entregas rápidas
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
