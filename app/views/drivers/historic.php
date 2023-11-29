<?php include_once __DIR__ . '/../includes/menu.php'; ?>

      <div class="container">
         <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9">
               <div class="card o-hidden border-0 my-5">
                  <div class="card-body p-0">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="p-3 mb-4 ">
                              <div class="d-sm-flex align-items-center justify-content-between">
                                 <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-list-ul"></i> Histórico</h1>
                              </div>    
                              <div class="mb-4 mt-4">
                                 <?= SessionMessage(); ?>
                              </div>
                              <div class="text-center">
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
                                                            <i class="<?= $delivery->getDelivery_Icon(); ?>" aria-hidden="true"></i> <?= $delivery->getDelivery_Status_Name(); ?>
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
                                                                <p class="text-muted"><i class="far fa-clock"></i> Data da entrega: <?= date('d/m/Y, H:i', strtotime($delivery->getCreated_at())); ?></p>
                                                            </div>
                                                            <div class="col-md-12 mb-4">
                                                                <h5>Status do Pedido</h5>
                                                                <p class="btn <?= $delivery->getDelivery_Css_Class(); ?> py-1 px-2 mb-0 text-white">
                                                                    <i class="<?= $delivery->getDelivery_Icon(); ?>" aria-hidden="true"></i> <?= $delivery->getDelivery_Status_Name(); ?>
                                                                </p>
                                                                <p class="text-muted mb-0"><?= $delivery->getDelivery_Status_Description(); ?></p>
                                                            </div>
                                                            <div class="col-md-12 mb-4">
                                                                <div id="map" style="width: 100%; height: 250px;"></div>
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
                                                                <p class="text-muted"><?= (empty($delivery->getDriver_name())) ? "Nenhum motorista aceitou seu pedido" : $delivery->getDriver_name(); ?></p>
                                                            </div>
                                                            <?php if ($delivery->getDelivery_status_id() === 5) { ?>
                                                                <div class="col-md-6 mb-3">
                                                                    <h5><i class="fa fa-truck" aria-hidden="true"></i> Entregue em:</h5>
                                                                    <p class="text-muted"><?= date('d/m/Y, H:i', strtotime($delivery->getUpdated_at())); ?></p>
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
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                        <i class="fa fa-times"></i> Fechar
                                                    </button>
                                                    <a href="<?= BASE_URL ?>usuario/rastrear/delivery/<?= $delivery->getDelivery_id(); ?>" class="btn btn-primary" target="_blank">
                                                        <i class="fa fa-search"></i> Rastrear Encomenda
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                 <?php }} ?>
     
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>


    <script type="text/javascript">
        var map;
        var directionsService;
        var directionsRenderer;

        function initMap() {

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();

            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -4.9690932199055835,
                    lng: -39.016540651386585
                },
                zoom: 15,
                mapTypeId: 'roadmap'
            });
        }
    </script>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>