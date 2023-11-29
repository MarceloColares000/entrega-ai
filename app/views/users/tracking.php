<?php include_once __DIR__ . '/../includes/menu.php'; ?>
    <div class="container">
       <div class="row justify-content-center">
          <div class="col-xl-12 col-lg-12 col-md-9">
             <div class="card o-hidden border-0 my-5">
                <div class="card-body p-0">
                   <div class="row">
                      <div class="col-lg-12">
                         <div class="p-3 mb-4 ">

                            <?php if(!isset($delivery_id)){ ?>
                            
                            <div class="d-sm-flex align-items-center justify-content-between">
                               <h1 class="h3 mb-4 text-gray-800">Rastreie sua encomenda 😊</h1>
                               <a href="<?= BASE_URL ?>/usuario/historico" class="site-btn">Voltar</a>
                            </div>
                               <p class="h5 mb-4 text-gray-800">Me informa o identificador do pedido.</p>
                            
                                <div class="col-lg-12 text-center" style="margin: auto; margin-top: 20px;" id="collapseRastreio">
                                      <div class="card-body">
                                        <form class="user" action="<?= BASE_URL ?>usuario/rastrear" method="post" id="searchForm">
                                           <div class="form-group">
                                             <input type="text" class="form-control form-control-user" name="delivery_id" id="delivery_id" placeholder="Código de rastreio" value="<?= (isset($delivery_id) ? $delivery_id : ""); ?>" 
                                      aria-label="Search" aria-describedby="basic-addon2" required>
                                    
                                           </div>
                                           <button type="submit" class="btn btn-primary btn-user btn-block"><span><i class="fa fa-search"></i> Rastrear</span></button>
                                        </form>
                                      </div>
                                </div>

                            <?php }else{ ?>

                            <?php if(empty($delivery)){ ?>
                                
                            <div class="d-sm-flex align-items-center justify-content-between">
                               <h1 class="h3 mb-4 text-gray-800">Que pena... 😥</h1>
                            </div>
                            
                            <p class="h5 mb-4 text-gray-800">Não achei sua encomenda, mas vamos tentar de novo:</p>

                            <div class="col-lg-12 text-center" style="margin: auto; margin-top: 20px;" id="collapseRastreio">
                                  <div class="card-body">
                                    <form class="user" action="<?= BASE_URL ?>usuario/rastrear" method="post" id="searchForm">
                                       <div class="form-group">
                                         <input type="text" class="form-control form-control-user" name="delivery_id" id="delivery_id" placeholder="Código de rastreio" value="<?= (isset($delivery_id) && !empty($delivery) ? $delivery_id : ""); ?>" 
                                  aria-label="Search" aria-describedby="basic-addon2" required>
                                
                                       </div>
                                       <button type="submit" class="btn btn-primary btn-user btn-block"><span><i class="fa fa-search"></i> Rastrear</span></button>
                                    </form>
                                  </div>
                            </div>

                            <?php }else{ ?>

                                <div class="container">
                                    <div class="d-sm-flex align-items-center justify-content-between mt-4">
                                        <h1 class="h3 mb-0 text-gray-800">Encomenda #<?= $delivery_id; ?></h1>
                                        <a href="<?= BASE_URL ?>usuario/historico" class="btn btn-secondary">Voltar</a>
                                    </div>
                                    
                                    <p class="h5 mt-4 text-gray-800">Acompanhe onde está sua encomenda</p>
                                    
                                    <div class="row justify-content-center mt-4">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="map" style="height: 400px;"></div>
                                                    <?php foreach($delivery as $deliveries){ ?>
                                                        <div class="container-fluid mt-4">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <p class="text-muted"><i class="far fa-clock"></i> Solicitado em: <?= date('d/m/Y, H:i', strtotime($deliveries->getCreated_at())); ?></p>
                                                            </div>
                                                            <div class="col-md-12 mb-4">
                                                                <h5>Status do Pedido</h5>
                                                                <p class="btn <?= $deliveries->getDelivery_Css_Class(); ?> py-1 px-2 mb-0 text-white">
                                                                    <i class="fa <?= $deliveries->getDelivery_Icon(); ?>" aria-hidden="true"></i> <?= $deliveries->getDelivery_Status_Name(); ?>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-12 mb-4">
                                                                <p class="text-muted mb-0"><?= $deliveries->getDelivery_Status_Description(); ?></p>
                                                            </div>
                                                            <div class="col-md-12 mb-4">
                                                                <h5>Suas Observações</h5>
                                                                <p class="text-muted"><?= ($deliveries->getDelivery_details() == '') ? "Não há observações." : $deliveries->getDelivery_details(); ?></p>
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <h5>Local de Retirada</h5>
                                                                <p class="text-muted"><?= $deliveries->getSender_address_details() . ", N " . $deliveries->getSender_house_number(); ?></p>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <h5>Local de Entrega</h5>
                                                                <p class="text-muted"><?= $deliveries->getRecipient_address_details() . ", N " . $deliveries->getRecipient_house_number(); ?></p>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <h5>Tipo de Veículo</h5>
                                                                <p class="text-muted"><?= $deliveries->getVehicle_type_name() . " | R$ " . number_format($deliveries->getVehicle_base_rate(), 2, ',', '.') . " | R$ " . number_format($deliveries->getVehicle_rate_per_km(), 2, ',', '.') . " / Km"; ?></p>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <h5>Peso Total</h5>
                                                                <p class="text-muted"><?= $deliveries->getWeight(); ?> Kg</p>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <h5>Distância</h5>
                                                                <p class="text-muted"><?= $deliveries->getTotal_km(); ?> Km</p>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <h5>Forma de Pagamento</h5>
                                                                <p class="text-muted">Cartão de Crédito</p>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <h5>Nome do Motorista</h5>
                                                                <?php if (!empty($deliveries->getDriver_name())) : ?>
                                                                    <p class="text-muted">
                                                                        <?= $deliveries->getDriver_name() ?>
                                                                        <?php if ($deliveries->getAverage_rating() !== null) : ?>
                                                                            <i class="fa fa-star" style="color: #ffcc00;"></i> <?= number_format($deliveries->getAverage_rating(), 2) ?>
                                                                        <?php endif; ?>
                                                                    </p>
                                                                <?php else : ?>
                                                                    <p class="text-muted">Nenhum motorista aceitou seu pedido</p>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <h5>Veículo:</h5>
                                                                <?= $deliveries->getVehicle_brand() ?> <?= $deliveries->getVehicle_model() ?>, <?= $deliveries->getVehicle_plate_number() ?>
                                                                <strong>Cor:</strong> <span class="badge text-white" style="background-color: <?= $deliveries->getVehicle_color(); ?>;">⠀</span>
                                                            </div>
                                                            <?php if ($deliveries->getDelivery_status_id() === 4) { ?>
                                                                <div class="col-md-6 mb-3">
                                                                    <h5><i class="fa fa-truck" aria-hidden="true"></i> Entregue em:</h5>
                                                                    <p class="text-muted"><?= date('d/m/Y, H:i', strtotime($deliveries->getUpdated_at())); ?></p>
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

                                                                            <input type="hidden" name="delivery_id" id="delivery_id" value="<?= $deliveries->getId() ?>">
                                                                            <input type="hidden" name="driver_id" id="driver_id" value="<?= $deliveries->getDriver_id() ?>">

                                                                            <button type="submit" class="site-btn site-btn-secondary"><i class="fa fa-star"></i> Avaliar</button>

                                                                        </div>

                                                                    </form>

            
                                                                </div>
                                                            <?php } ?>
                                                    
                                                            <div class="col-md-12">
                                                                <h4 class="text-center mb-4">Total: R$ <?= number_format($deliveries->getTotal_price(), 2, ',', '.'); ?></h4>
                                                                <p class="text-muted text-center">Obrigado por escolher nossos serviços! Esperamos vê-lo novamente em breve! <i class="fa fa-laugh-wink"></i></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
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

    <script>
          document.getElementById("searchForm").addEventListener("submit", function (event) {
              event.preventDefault();
              
              var delivery_id = document.getElementById("delivery_id").value;
              window.location.href = "<?= BASE_URL; ?>usuario/rastrear/delivery/" + encodeURIComponent(delivery_id);
          });
    </script>

    <script>
   function initMap() {
            var deliveryPoints = [
                <?php foreach ($delivery as $deliveries): ?>
                    {
                        lat: <?= $deliveries->getCurrent_latitude(); ?>,
                        lng: <?= $deliveries->getCurrent_longitude(); ?>
                    },
                <?php endforeach; ?>
            ];

            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            var map = new google.maps.Map(document.getElementById('map'), {
                center: deliveryPoints[0],
                zoom: 12
            });
            directionsRenderer.setMap(map);

            var waypoints = [];
            for (var i = 1; i < deliveryPoints.length - 1; i++) {
                waypoints.push({
                    location: new google.maps.LatLng(deliveryPoints[i].lat, deliveryPoints[i].lng),
                    stopover: true
                });
            }

            var start = new google.maps.LatLng(deliveryPoints[0].lat, deliveryPoints[0].lng);
            var end = new google.maps.LatLng(deliveryPoints[deliveryPoints.length - 1].lat, deliveryPoints[deliveryPoints.length - 1].lng);

            var request = {
                origin: start,
                destination: end,
                waypoints: waypoints,
                optimizeWaypoints: true,
                travelMode: google.maps.TravelMode.DRIVING
            };

            directionsService.route(request, function(result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsRenderer.setDirections(result);
                } else {
                    window.alert('Não foi possível calcular a rota: ' + status);
                }
            });
        }

    </script>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>