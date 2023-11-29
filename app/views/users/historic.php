<?php include_once __DIR__ . '/../includes/menu.php'; ?>


    <div class="container">
        <div class="view-account">
           <section class="module">
              <div class="module-inner">
                 <?php include_once __DIR__ . '/../includes/sideMenu.php'; ?>
                 <div class="content-panel">
                    <div class="d-sm-flex align-items-center justify-content-between">
                       <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-list-ul"></i> Histórico</h1>
                    </div>
                    <div class="mb-4 mt-4">
                       <?= SessionMessage(); ?>
                    </div>
                    <div class="container">
                       <?php 
                         if(empty($deliveries)){ ?>
                        
                         <div class="text-center">
                            <img src="<?= IMG ?>/no_data.svg" style="width: 15%;" class="img-fluid ">
                            <p class="mt-4 mb-4">Você ainda não solicitou nenhum serviço!</p>
                         </div>
                         
                         <?php 

                         }else{

                         foreach($deliveries as $delivery){ ?>

                            <div class="delivery-area col-md-12">
                                <a href="#" data-toggle="modal" data-target="#<?= $delivery->getDelivery_id() ?>" class="text-decoration-none text-dark">
                                    <div class="space-area shadow-sm p-3">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6 col-lg-3 mb-3 mb-lg-0 text-center">
                                                <p class="btn <?= $delivery->getDelivery_Css_Class(); ?> py-1 px-2 mb-0 text-white">
                                                    <i class="fa <?= $delivery->getDelivery_Icon(); ?>" aria-hidden="true"></i> <?= $delivery->getDelivery_Status_Name(); ?>
                                                </p>
                                            </div>
                                            <div class="col-md-6 col-lg-3 mb-3 mb-lg-0 text-center text-muted">
                                                <p class="mb-0">Solicitado em:</p>
                                                <p class="mb-0"><i class="far fa-clock" aria-hidden="true"></i> <?= date('d/m/Y, H:i', strtotime($delivery->getCreated_at())); ?></p>
                                            </div>
                                            <div class="col-md-6 col-lg-3 mb-3 mb-lg-0 text-center text-muted">
                                                <p class="mb-0">Id do Pedido</p>
                                                <p class="mb-0">
                                                    <span class="font-weight-bold"><?= $delivery->getDelivery_id(); ?></span>
                                                </p>
                                            </div>
                                            <div class="col-md-6 col-lg-3 text-center text-muted">
                                                <p class="mb-0">Total do pedido</p>
                                                <p class="mb-0">
                                                    <span class="font-weight-bold">R$ <?= number_format($delivery->getTotal_price(), 2, '.', ','); ?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>



                            <div class="modal fade" id="<?= $delivery->getDelivery_id(); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title"><i class="fa fa-check-circle" aria-hidden="true"></i> Detalhes da Entrega #<?= $delivery->getDelivery_id(); ?></h5>
                                            <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <p class="text-muted"><i class="far fa-clock"></i> Solicitado em: <?= date('d/m/Y, H:i', strtotime($delivery->getCreated_at())); ?></p>
                                                    </div>
                                                    <div class="col-md-12 mb-4 text-center">
                                                        <h5>Status do Pedido</h5>
                                                        <p class="btn <?= $delivery->getDelivery_Css_Class(); ?> py-1 px-2 mb-0 text-white">
                                                            <i class="fa <?= $delivery->getDelivery_Icon(); ?>" aria-hidden="true"></i> <?= $delivery->getDelivery_Status_Name(); ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-12 mb-4 text-center">
                                                        <p class="text-muted mb-0"><?= $delivery->getDelivery_Status_Description(); ?></p>
                                                    </div>
                                                    <div class="col-md-12 mb-4">
                                                        <h5>Suas Observações</h5>
                                                        <p class="text-muted"><?= ($delivery->getDelivery_details() == '') ? "Não há observações." : $delivery->getDelivery_details(); ?></p>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <h5>Local de Retirada</h5>
                                                        <p class="text-muted"><?= $delivery->getSender_address_details() . ", N " . $delivery->getSender_house_number(); ?></p>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <h5>Local de Entrega</h5>
                                                        <p class="text-muted"><?= $delivery->getRecipient_address_details() . ", N " . $delivery->getRecipient_house_number(); ?></p>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <h5>Tipo de Veículo</h5>
                                                        <p class="text-muted"><?= $delivery->getVehicle_type_name() . " | R$ " . number_format($delivery->getVehicle_base_rate(), 2, ',', '.') . " | R$ " . number_format($delivery->getVehicle_rate_per_km(), 2, ',', '.') . " / Km"; ?></p>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <h5>Peso Total</h5>
                                                        <p class="text-muted"><?= $delivery->getWeight(); ?> Kg</p>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <h5>Distância</h5>
                                                        <p class="text-muted"><?= $delivery->getTotal_km(); ?> Km</p>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <h5>Forma de Pagamento</h5>
                                                        <p class="text-muted">Cartão de Crédito</p>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <h5>Nome do Motorista</h5>
                                                        <?php if (!empty($delivery->getDriver_name())) : ?>
                                                            <p class="text-muted">
                                                                <?= $delivery->getDriver_name() ?>
                                                                <?php if ($delivery->getAverage_rating() !== null) : ?>
                                                                    <i class="fa fa-star" style="color: #ffcc00;"></i> <?= number_format($delivery->getAverage_rating(), 2) ?>
                                                                <?php endif; ?>
                                                            </p>
                                                        <?php else : ?>
                                                            <p class="text-muted">Nenhum motorista aceitou seu pedido</p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <h5>Veículo:</h5>
                                                        <?php if (!empty($delivery->getDriver_name())) : ?>
                                                            <?= $delivery->getVehicle_brand() ?> <?= $delivery->getVehicle_model() ?>, <?= $delivery->getVehicle_plate_number() ?>
                                                        <strong>Cor:</strong> <span class="badge text-white" style="background-color: <?= $delivery->getVehicle_color(); ?>;">⠀</span>
                                                        <?php else : ?>
                                                            <p class="text-muted">Nenhum motorista aceitou seu pedido</p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if ($delivery->getDelivery_status_id() === 4) { ?>
                                                        <div class="col-md-6 mb-3">
                                                            <h5><i class="fa fa-truck" aria-hidden="true"></i> Entregue em:</h5>
                                                            <p class="text-muted"><?= date('d/m/Y, H:i', strtotime($delivery->getUpdated_at())); ?></p>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <h5>Gostaria de avaliar o motorista?</h5>
                                                            <form method="POST" action="<?= BASE_URL ?>usuario/avaliar">

                                                                <div class="stars">

                                                                    <input type="radio" name="rating" id="vazio" value="" checked>

                                                                    <label for="estrela_um"><i class="opcao fa"></i></label>
                                                                    <input type="radio" name="rating" id="estrela_um" id="vazio" value="1">

                                                                    <label for="estrela_dois"><i class="opcao fa"></i></label>
                                                                    <input type="radio" name="rating" id="estrela_dois" id="vazio" value="2">

                                                                    <label for="estrela_tres"><i class="opcao fa"></i></label>
                                                                    <input type="radio" name="rating" id="estrela_tres" id="vazio" value="3">

                                                                    <label for="estrela_quatro"><i class="opcao fa"></i></label>
                                                                    <input type="radio" name="rating" id="estrela_quatro" id="vazio" value="4">

                                                                    <label for="estrela_cinco"><i class="opcao fa"></i></label>
                                                                    <input type="radio" name="rating" id="estrela_cinco" id="vazio" value="5"><br><br>

                                                                    <textarea class="form-control mb-3" name="comment" rows="4" cols="30" placeholder="Digite o seu comentário..."></textarea>

                                                                    <input type="hidden" name="delivery_id" id="delivery_id" value="<?= $delivery->getId() ?>">
                                                                    <input type="hidden" name="driver_id" id="driver_id" value="<?= $delivery->getDriver_id() ?>">

                                                                    <button type="submit" class="site-btn site-btn-secondary"><i class="fa fa-star"></i> Avaliar</button>

                                                                </div>

                                                            </form>

    
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-md-12">
                                                        <h4 class="text-center mb-4">Total: R$ <?= number_format($delivery->getTotal_price(), 2, ',', '.'); ?></h4>
                                                        <p class="text-muted text-center">Obrigado por escolher nossos serviços! Esperamos vê-lo novamente em breve! <i class="fa fa-laugh-wink"></i></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer text-center justify-content-center">
                                            <?php if($delivery->getDelivery_status_id() == 1){ ?>
                                            <form action="<?= BASE_URL ?>usuario/delivery/cancel" method="post" onsubmit="return confirm('Você tem certeza que quer cancelar essa entrega?')">
                                                <input type="hidden" name="id" id="id" value="<?= $delivery->getId() ?>">
                                                <button class="btn btn-danger" type="submit">
                                                    <i class="fa fa-ban"></i> Cancelar encomenda
                                                </button>
                                            </form>
                                            <?php } ?>
                                                                                    
                                            <?php if($delivery->getDelivery_status_id() == 5){ ?>
                                            
                                                <a href="<?= BASE_URL ?>usuario/rastrear/delivery/<?= $delivery->getDelivery_id(); ?>" class="btn btn-primary">
                                                <i class="fa fa-search"></i> Rastrear Encomenda
                                            </a>
                                            
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                         <?php }} ?>
                    </div>
                 </div>
           </section>
        </div>
    </div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>