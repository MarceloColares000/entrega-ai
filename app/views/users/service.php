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
                               <h1 class="h3 mb-4 text-gray-800">Em que podemos te ajudar hoje? 😊</h1>
                            </div>
                            <!-- Content Row -->
                            <div class="row">
                               <div class="col-xl-6 col-md-6 mb-4">
                                  <div class="card border-left-primary h-100 py-4">
                                     <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                           <div class="col md-6">
                                              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                 Enviar um item
                                              </div>
                                              <div class="h5 mb-0 text-bold text-gray-800">Pedir para um motorista parceiro entregar um item</div>
                                           </div>
                                           <div class="col-auto">
                                              <i class="fa fa-share fa-2x text-gray-300" aria-hidden="true"></i>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class="col-xl-6 col-md-6 mb-4">
                                  <div class="card border-left-primary h-100 py-4">
                                     <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                           <div class="col md-6">
                                              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                 Receber um item
                                              </div>
                                              <div class="h5 mb-0 text-gray-800">Pedir para um motorista parceiro retirar um item</div>
                                           </div>
                                           <div class="col-auto">
                                              <i class="fa fa-share fa-2x text-gray-300" style="transform: scaleX(-1);" aria-hidden="true"></i>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>

                            <div class="container spad">
                                <div class="section-title" data-aos="fade-right" data-aos-once="true">
                                    <h2>Calcule sua Rota</h2>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-8">
                                        <div id="map"></div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="results">
                                            <button class="site-btn mt-2" onclick="getUserLocation()">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i> Encontrar Minha Localização
                                            </button>

                                            <form action="<?= BASE_URL ?>usuario/delivery/new" method="post" id="deliveryForm">
                                                <p>Origem: <span id="origin">Clique no mapa para definir</span></p>
                                                <p>Número: <input class="form-control" type="text" name="sender_house_number" id="sender_house_number"></p>
                                                <p>Destino: <span id="destination">Clique no mapa para definir</span></p>
                                                <p>Quem vai receber? <input class="form-control" type="text" name="recipient_name" id="recipient_name"></p>
                                                <p>Número: <input class="form-control" type="text" name="recipient_house_number" id="recipient_house_number"></p>
                                                <p>Peso total: <input class="form-control" type="text" name="weight" id="weight"></p>
                                                <p>Distância por estrada: <span id="distance"></span></p>
                                                <p>Tempo estimado: <span id="duration"></span></p>
                                                <p id="cost">Custo estimado: R$<span id="cost"></span></p>
                                                <div class="input-group col-md-12">
                                                    <label for="vehicle_type_id">Selecione o tipo de veículo:</label>
                                                    <select id="vehicle_type_id" name="vehicle_type_id" class="form-select col-md-12">
                                                        <option value="">Selecione</option>
                                                        <?php foreach($vehicleTypes as $vehicleType){ ?>
                                                            <option value="<?= $vehicleType->getId() ?>">
                                                                <?= $vehicleType->getType_name() . " | R$ " . number_format($vehicleType->getBase_rate(), 2, ',','.') . " | R$ " . number_format($vehicleType->getRate_per_km(), 2, ',','.') . " / Km | Max:" . $vehicleType->getMax_weight() . "Kg" ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="payments_type">Selecione o tipo de pagamento:</label>
                                                    <select id="payments_type" name="payments_type" class="form-select col-md-12">
                                                        <option value="">Selecione</option>
                                                        <option value="4">Pagar com pix</option>
                                                        <?php foreach($cards as $card){ ?>
                                                            <option value="<?= $card->getId() ?>">
                                                                <?= substr($card->getCard_number(), 0, strrpos($card->getCard_number(), '.' ) - 9 ).'**** ****'; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <p>Detalhes: <input class="form-control" type="text" name="delivery_details" id="delivery_details"></p>
                                                <button class="site-btn" onclick="calculateCost()">
                                                    <i class="fa fa-usd" aria-hidden="true"></i> Calcular Custo
                                                </button>
                                                <button class="site-btn-danger" onclick="clearMap()">
                                                    <i class="fa fa-times" aria-hidden="true"></i> Limpar Mapa
                                                </button>

                                                <!-- Inputs hidden -->
                                                <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user_id']; ?>">
                                                <input type="hidden" name="sender_latitude" id="sender_latitude" value="">
                                                <input type="hidden" name="sender_longitude" id="sender_longitude" value="">
                                                <input type="hidden" name="sender_address_details" id="sender_address_details" value="">
                                                <input type="hidden" name="recipient_latitude" id="recipient_latitude" value="">
                                                <input type="hidden" name="recipient_longitude" id="recipient_longitude" value="">
                                                <input type="hidden" name="recipient_address_details" id="recipient_address_details" value="">
                                                <input type="hidden" name="total_km" id="total_km" value="">
                                                <input type="hidden" name="total_price" id="total_price" value="">
                                                <input type="hidden" name="address" id="address" value="">
                                                <button type="submit" class="site-btn site-btn-secondary" id="solicitarButton">
                                                    <i class="fa fa-save"></i> Solicitar
                                                </button>

                                                <div class="modal fade" id="pagPix" tabindex="-1" width="100%" role="dialog" aria-hidden="true">
                                                   <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <h5 class="modal-title"><i class="fa fa-money" aria-hidden="true"></i> Pagar por pix</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                            </button>
                                                         </div>
                                                         <div class="modal-body text-center">
                                                            <div class="image-coupled">
                                                               <img src="<?= IMG ?>/qrcode.png" class="img-fluid img-responsive" style="width: 60%;">
                                                               <h4 class="text-muted mb-2 text-center" id="cnpj" value="81.152.094/0001-16">81.152.094/0001-16</h4>
                                                               <button class="btn btn-primary btn-sm" id="copiarCNPJ"><i class="fa fa-clone" aria-hidden="true"></i> Copiar CNPJ</button>
                                                            </div>
                                                            <hr>
                                                            <div class="row mt-3">
                                                               <div class="col">
                                                                  <p class="text-muted mb-2">O status do seu pedido será atualizado assim que a equipe verificar o pagamento. Após efetuar o pagamento, clique em "Finalizar compra" para concluir sua compra.</p>
                                                               </div>
                                                            </div>
                                                            <hr>
                                                            <div class="align-items-center text-center">
                                                               <button type="submit" class="btn btn-success btn-icon-split" name="finalizar" id="finalizar">
                                                                  <span class="icon text-white-50">
                                                                     <i class="fas fa-check"></i>
                                                                  </span>
                                                                  <span class="text">Solicitar</span>
                                                               </button>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                            </form>
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

<script type="text/javascript">
                   
                var map;
                var directionsService;
                var directionsRenderer;
                var originLatLng = null;
                var destinationLatLng = null;

                var directionsService, directionsRenderer, map;
                var originLatLng, destinationLatLng;

                var directionsService, directionsRenderer, map;
                var originLatLng, destinationLatLng;

                function initMap() {
                   // Inicializa o serviço de direções e o renderizador de direções do Google Maps.
                   directionsService = new google.maps.DirectionsService();
                   directionsRenderer = new google.maps.DirectionsRenderer();

                   // Cria um mapa e o exibe na página.
                   map = new google.maps.Map(document.getElementById('map'), {
                      center: {
                         lat: -4.9690932199055835,
                         lng: -39.016540651386585
                      },
                      zoom: 15,
                      mapTypeId: 'roadmap'
                   });

                   // Configura o renderizador de direções para exibir rotas no mapa.
                   directionsRenderer.setMap(map);

                   // Tenta obter a localização atual do usuário.
                   if (navigator.geolocation) {
                      navigator.geolocation.getCurrentPosition(
                         function (position) {
                            // Se a localização foi obtida com sucesso, exibe no mapa e define como origem.
                            var userLatLng = {
                               lat: position.coords.latitude,
                               lng: position.coords.longitude
                            };
                            map.setCenter(userLatLng);
                            originLatLng = userLatLng;
                            document.getElementById('origin').textContent = userLatLng.toString();
                         },
                         function () {
                            // Caso falhe, mantém a localização padrão.
                            console.error('Erro ao obter a localização do usuário.');
                         }
                      );
                   }

                   // Adiciona um ouvinte de clique no mapa para definir o destino.
                   map.addListener('click', function (event) {
                      if (!originLatLng) {
                         // Se a origem ainda não foi definida, define manualmente.
                         originLatLng = event.latLng;
                         document.getElementById('origin').textContent = event.latLng.toString();
                      } else if (!destinationLatLng) {
                         // Se a origem já foi definida, define o destino.
                         destinationLatLng = event.latLng;
                         document.getElementById('destination').textContent = event.latLng.toString();
                         calculateRoute();
                      }
                   });
                }

                function getAddressDetails(latLng, addressType) {
                   var geocoder = new google.maps.Geocoder();

                   geocoder.geocode({
                      'location': latLng
                   }, function (results, status) {
                      if (status === 'OK') {
                         if (results[0]) {
                            var addressComponents = results[0].address_components.filter(function (component) {
                               return !['street_number', 'postal_code'].includes(component.types[0]);
                            });

                            var addressDetails = addressComponents.map(function (component) {
                               return component.short_name;
                            }).join(', ');

                            // Atualiza o elemento no DOM com os detalhes do endereço
                            document.getElementById(addressType).value = addressDetails;

                            // Atualiza o valor do campo escondido com os detalhes do endereço
                            document.getElementById(addressType + 'Hidden').value = addressDetails;
                         }
                      } else {
                         console.error('Erro ao obter detalhes do endereço: ' + status);
                      }
                   });
                }


                function getUserLocation() {
                   // Obtém a localização do usuário usando a geolocalização do navegador.
                   if (navigator.geolocation) {
                      navigator.geolocation.getCurrentPosition(function (position) {
                         var userLat = position.coords.latitude;
                         var userLng = position.coords.longitude;
                         var userLocation = new google.maps.LatLng(userLat, userLng);

                         // Define a localização do usuário como o centro do mapa.
                         map.setCenter(userLocation);

                         // Adiciona um marcador na localização do usuário.
                         var userMarker = new google.maps.Marker({
                            position: userLocation,
                            map: map,
                            title: 'Sua Localização'
                         });

                         // Define a origem como a localização do usuário.
                         document.getElementById('origin').textContent = 'Origem: Sua Localização';
                         originLatLng = userLocation;

                         // Calcula a rota se o destino já estiver definido.
                         if (destinationLatLng) {
                            calculateRoute();
                         }
                      }, function (error) {
                         // Trata possíveis erros ao obter a localização do usuário.
                         switch (error.code) {
                            case error.PERMISSION_DENIED:
                               //alert("Permissão para geolocalização negada pelo usuário.");
                               break;
                            case error.POSITION_UNAVAILABLE:
                               alert("Informações de localização indisponíveis.");
                               break;
                            case error.TIMEOUT:
                               alert("Tempo limite para obter a localização esgotado.");
                               break;
                            case error.UNKNOWN_ERROR:
                               alert("Erro desconhecido ao obter a localização.");
                               break;
                         }
                      });
                   } else {
                      alert("Seu navegador não suporta geolocalização.");
                   }
                }

                function calculateRoute() {
                   // Calcula a rota entre a origem e o destino selecionados.
                   if (originLatLng && destinationLatLng) {
                      var request = {
                         origin: originLatLng,
                         destination: destinationLatLng,
                         travelMode: 'DRIVING'
                      };

                      directionsService.route(request, function (result, status) {
                         if (status == 'OK') {
                            // Exibe a distância e o tempo estimado da rota.
                            var route = result.routes[0];
                            var distance = route.legs[0].distance.text;
                            var duration = route.legs[0].duration.text;

                            document.getElementById('distance').textContent = distance;
                            document.getElementById('duration').textContent = duration;

                            // Preenche os inputs hidden com as informações da rota
                            document.getElementById('total_km').value = distance;
                            document.getElementById('total_price').value = calculateCost();
                            document.getElementById('sender_latitude').value = originLatLng.lat();
                            document.getElementById('sender_longitude').value = originLatLng.lng();
                            document.getElementById('recipient_latitude').value = destinationLatLng.lat();
                            document.getElementById('recipient_longitude').value = destinationLatLng.lng();

                            // Obtém e preenche os detalhes do endereço do remetente (sender) e destinatário (recipient)
                            getAddressDetails(originLatLng, 'sender_address_details', function (senderAddress) {
                               document.getElementById('sender_address').value = senderAddress;
                            });

                            getAddressDetails(destinationLatLng, 'recipient_address_details', function (recipientAddress) {
                               document.getElementById('recipient_address').value = recipientAddress;
                            });

                            // Exibe a rota no mapa.
                            directionsRenderer.setDirections(result);
                         } else {
                            alert('Não foi possível calcular a rota: ' + status);
                         }
                      });
                   }
                }


                function calculateCost() {
                   if (originLatLng && destinationLatLng) {
                      var distanceText = document.getElementById('distance').textContent;
                      var regexResult = distanceText.match(/\d+/);

                      if (regexResult && regexResult[0]) {
                         var distance = parseFloat(regexResult[0]);
                         var vehicleType = document.getElementById('vehicle_type_id').value;

                         var baseCost, costPerKm;

                         if (vehicleType === '1') {
                            baseCost = 6;
                            var additionalDistance = distance - 3;
                            costPerKm = 0.5;
                            if (additionalDistance < 0) {
                               additionalDistance = 0;
                            }

                            var additionalCost = additionalDistance * costPerKm;
                            var cost = baseCost + additionalCost;

                            document.getElementById('total_price').value = cost.toFixed(2).replace('.', ',');
                            document.getElementById('cost').textContent = cost.toFixed(2).replace('.', ',');
                            return;

                         } else if (vehicleType === '2') {
                            baseCost = 12;
                            var additionalDistance = distance - 3;
                            costPerKm = 1.55;
                            if (additionalDistance < 0) {
                               additionalDistance = 0;
                            }
                            var additionalCost = additionalDistance * costPerKm;
                            var cost = baseCost + additionalCost;

                            document.getElementById('total_price').value = cost.toFixed(2).replace('.', ',');
                            document.getElementById('cost').textContent = cost.toFixed(2).replace('.', ',');
                            return;
                         } else if (vehicleType === '3') {
                            baseCost = 100;
                            var additionalDistance = distance - 3;
                            costPerKm = 5.60;
                            if (additionalDistance < 0) {
                               additionalDistance = 0;
                            }
                            var additionalCost = additionalDistance * costPerKm;
                            var cost = baseCost + additionalCost;

                            document.getElementById('total_price').value = cost.toFixed(2).replace('.', ',');
                            document.getElementById('cost').textContent = cost.toFixed(2).replace('.', ',');
                            return;
                         }
                      } else {
                         alert('Erro ao calcular a distância. Certifique-se de que uma rota válida foi calculada.');
                      }
                   } else {
                      alert('Selecione uma origem e destino no mapa.');
                   }
                }


                function clearMap() {
                   originLatLng = null;
                   destinationLatLng = null;
                   document.getElementById('origin').textContent = 'Clique no mapa para definir';
                   document.getElementById('destination').textContent = 'Clique no mapa para definir';
                   document.getElementById('distance').textContent = '';
                   document.getElementById('duration').textContent = '';
                   document.getElementById('cost').textContent = '';
                   directionsRenderer.setDirections({
                      routes: []
                   });
                }

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>

   $(document).ready(function() {
      $('#payments_type').change(function() {
         if ($(this).val() == '4') {
            $('#pagPix').modal('show');
         }

         $('#copiarCNPJ').click(function(){
             $('#cnpj').select();
               event.preventDefault();
               var ok = document.execCommand('copy');
               if (ok) { alert('CNPJ copiado para a área de transferência'); }
         });

      });


   });
   
</script>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>