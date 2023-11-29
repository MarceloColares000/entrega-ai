<?php include_once __DIR__ . '/../includes/menu.php'; ?>
    <div class="container">
       <div class="row justify-content-center">
          <div class="col-xl-12 col-lg-12 col-md-9">
             <div class="card o-hidden border-0 my-5">
                <div class="card-body p-0">
                   <div class="row">
                      <div class="col-lg-12">
                         <div class="p-3 mb-4 ">

    

                                <?= SessionMessage(); ?>

                                <div class="container">
                                    <div class="d-sm-flex align-items-center justify-content-between mt-4">
                                        <h1 class="h3 mb-0 text-gray-800">Encomenda #<?= $delivery_id; ?></h1>
                                        <a href="<?= BASE_URL ?>usuario/historico" class="btn btn-secondary">Voltar</a>
                                    </div>
                                    
                                    <p class="h5 mt-4 text-gray-800">Acompanhe onde está a encomenda e onde você está</p>
                                    
                                    <div class="row justify-content-center mt-4">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="map"></div>
                                                    <?php foreach($delivery as $deliveries){ ?>
                                                        <div class="container-fluid mt-4">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <p class="text-muted"><i class="far fa-clock"></i> Solicitado em: <?= date('d/m/Y, H:i', strtotime($deliveries->getCreated_at())); ?></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5 class="mb-4">Encontrar Minha Localização:</h5>
                                                                <button class="site-btn mt-2" onclick="getUserLocation()">
                                                                    <i class="fa fa-map-marker" aria-hidden="true"></i> Encontrar Minha Localização
                                                                </button>
                                                                <p>Origem: <span id="origin">Clique no mapa para definir</span></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5 class="mb-4">Atualizar status da entrega:</h5>
                                                                <form action="<?= BASE_URL ?>/motorista/delivery/updateStatus" method="post">
                                                                    <select class="form-control mb-2" name="delivery_status_id" id="delivery_status_id" required>
                                                                        <option value="">Selecione</option>
                                                                        <option value="3">Já estou a caminho</option>
                                                                        <option value="5">Já peguei o pacote e estou a caminho</option>
                                                                        <option value="7">Problemas na entrega</option>
                                                                        <option value="11">Devolvi o pacote</option>
                                                                    </select>
                                                                    <input type="hidden" name="id" id="id" value="<?= $deliveries->getId() ?>">
                                                                    <input type="hidden" name="delivery_id" id="delivery_id" value="<?= $delivery_id ?>">
                                                                    <button type="submit" class="btn site-btn mb-2">Atualizar</button>
                                                                </form>

                                                                <form action="<?= BASE_URL ?>motorista/delivery/cancel" method="post" onsubmit="return confirm('Você tem certeza que quer cancelar essa entrega?')">
                                                                    <?php foreach($delivery as $deliveries){ ?>
                                                                        <input type="hidden" name="id" id="id" value="<?= $deliveries->getId() ?>">
                                                                    <?php } ?>
                                                                    <button class="btn btn-danger mb-2" type="submit">
                                                                        <i class="fa fa-ban"></i> Cancelar encomenda
                                                                    </button>
                                                                </form>

                                                                <form action="<?= BASE_URL ?>motorista/delivery/delivered" method="post" onsubmit="return confirm('Você entregou corretamente essa entrega?')">
                                                                    <?php foreach($delivery as $deliveries){ ?>
                                                                        <input type="hidden" name="id" id="id" value="<?= $deliveries->getId() ?>">
                                                                    <?php } ?>
                                                                    <button class="btn btn-success mb-2" type="submit">
                                                                        <i class="fa fa-check-circle"></i> Entregue
                                                                    </button>
                                                                </form>
                                                            </div>

                                                            <div class="col-md-12 mb-4">
                                                                <p class="text-muted mb-0"><?= $deliveries->getDelivery_Status_Description(); ?></p>
                                                            </div>
                                                            <div class="col-md-12 mb-4">
                                                                <h5>Observações:</h5>
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
                                                            
                                                            <div class="col-md-12">
                                                                <h4 class="text-center mb-4">Total: R$ <?= number_format($deliveries->getTotal_price(), 2, ',', '.'); ?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
                                            

    <script>
            var map;
            var directionsService;
            var directionsRenderer;
            var userMarker;

            var originLatLng = null;

            function initMap() {
                var deliveryPoints = [
                    <?php foreach ($delivery as $deliveries): ?>
                        {
                            lat: <?= empty($deliveries->getCurrent_latitude()) ? $deliveries->getSender_latitude() : $deliveries->getCurrent_latitude(); ?>,
                            lng: <?= empty($deliveries->getCurrent_longitude()) ? $deliveries->getSender_longitude() : $deliveries->getCurrent_longitude(); ?>
                        },
                    <?php endforeach; ?>
                ];

                map = new google.maps.Map(document.getElementById('map'), {
                    center: deliveryPoints[0],
                    zoom: 12
                });

                directionsService = new google.maps.DirectionsService();
                directionsRenderer = new google.maps.DirectionsRenderer();
                directionsRenderer.setMap(map);

                // Função para exibir a localização do usuário no console a cada 3 segundos
                setInterval(function() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            var userLatLng = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                        }, function () {
                            console.error('Erro ao obter a localização do usuário.');
                        });
                    } else {
                        console.error("Seu navegador não suporta geolocalização.");
                    }
                }, 3000);

                directionsRenderer.setMap(map);

                var waypoints = [];
                for (var i = 1; i < deliveryPoints.length - 1; i++) {
                    waypoints.push({
                        location: new google.maps.LatLng(deliveryPoints[i].lat, deliveryPoints[i].lng),
                        stopover: true
                    });
                }

                var start = new google.maps.LatLng(deliveryPoints[0].lat, deliveryPoints[0].lng); // Coordenadas iniciais
                var end = new google.maps.LatLng(deliveryPoints[deliveryPoints.length - 1].lat, deliveryPoints[deliveryPoints.length - 1].lng); // Coordenadas do último ponto

                var request = {
                    origin: start,
                    destination: end,
                    waypoints: waypoints,
                    optimizeWaypoints: true,
                    travelMode: google.maps.TravelMode.DRIVING // Pode ser WALKING, BICYCLING, ou outros
                };

                directionsService.route(request, function(result, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsRenderer.setDirections(result);
                    } else {
                        window.alert('Não foi possível calcular a rota: ' + status);
                    }
                });
            }

            function getUserLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var userLat = position.coords.latitude;
                        var userLng = position.coords.longitude;
                        var userLocation = new google.maps.LatLng(userLat, userLng);

                        // Remove o marcador existente se houver
                        if (userMarker) {
                            userMarker.setMap(null);
                        }

                        // Cria um novo marcador na localização do usuário
                        userMarker = new google.maps.Marker({
                            position: userLocation,
                            map: map,
                            title: 'Sua Localização'
                        });

                        // Define a localização do usuário como o centro do mapa
                        map.setCenter(userLocation);

                        // Define a origem como a localização do usuário
                        originLatLng = userLocation;
                    }, function (error) {
                        alert("Erro ao obter a localização do usuário.");
                    });
                } else {
                    alert("Seu navegador não suporta geolocalização.");
                }
            }
            
        function enviarCoordenadasParaServidor() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var delivery_id = "<?= $delivery_id ?>";
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    // AJAX para enviar dados para o servidor
                    $.ajax({
                        type: 'POST',
                        url: '<?= BASE_URL ?>motorista/update/update-coordenades',
                        data: {
                            delivery_id: delivery_id,
                            latitude: latitude,
                            longitude: longitude
                        },
                        success: function (response) {
                            console.log('Resposta do servidor:', response);
                            if (response.success) {
                                console.log('Coordenadas atualizadas com sucesso!');
                            } else {
                                console.error('Erro ao atualizar coordenadas.');
                            }
                        },
                        error: function (error) {
                            console.error('Erro ao atualizar coordenadas:', error);
                        }
                    });
                }, function () {
                    console.error('Erro ao obter a localização do usuário.');
                });
            } else {
                console.error('Seu navegador não suporta geolocalização.');
            }
        }

        setInterval(enviarCoordenadasParaServidor, 3000);

    </script>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>