<?php include_once __DIR__ . '/../includes/menu.php'; ?>
    
    <div class="container">
        <div class="view-account">
           <section class="module">
              <div class="module-inner">
                 <?php include_once __DIR__ . '/../includes/sideMenu.php'; ?>
                <div class="content-panel">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-map-marker"></i> Meus endereços</h1>
                        <a class=" site-btn-secondary site-btn" data-toggle="modal" data-target="#addAddressModal"><i class="fas fa-fw fa-plus"></i> Adicionar novo</a>
                    </div>
                    <div class="mb-4 mt-4">
                       <?= SessionMessage(); ?>
                    </div>
                    <div class="container">
                        <?php if (empty($adresses)) { ?>
                        <div class="text-center">
                            <img src="<?= IMG ?>/no_data.svg" style="width: 15%;" class="img-fluid">
                            <p class="mt-4 mb-4">Você ainda não cadastrou nenhum endereço!</p>
                        </div>
                        <?php } else { ?>
                        <div class="row">
                            <?php foreach ($adresses as $address) { ?>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="mb-0">
                                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                        <span class="ml-2"><?= $address->getAddressDetails() . ", " . $address->getNumber(); ?></span>
                                                    </p>
                                                </div>
                                                <div>
                                                    <form action="<?= BASE_URL ?>usuario/enderecos/delete" method="post" onsubmit="return confirm('Você tem certeza que quer apagar esse endereço?')">
                                                        <input type="hidden" name="id" value="<?= $address->getId(); ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Apagar Endereço">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
           </section>
        </div>
    </div>

      <!-- addAddressModal -->
      <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-map" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-map-marker"></i> Cadastrar Endereços</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="clearMap()">
                  <span aria-hidden="true">×</span>
               </button>
               </div>
               <div class="modal-body">
                  <div class="col-md-12">
                     <div id="mapAddAddress"></div>
                  </div>
                  <div class="card-body-address">
                     <form class="user" action="<?= BASE_URL ?>usuario/enderecos/add" method="post">
                        <div class="form-group">
                           <p style="display: none;">Origem: <span id="origin">Clique no mapa para definir</span></p>
                           <div id="addressDetails"></div>
                           <label class="text-base label-color" for="number">Numero :</label>
                           <input type="text" class="form-control form-control-user" name="number" id="number" placeholder="Número da casa" required>
                        </div>
                        <div class="form-group">
                           <label class="text-base label-color" for="description">Descrição:</label>
                           <input type="text" class="form-control form-control-user" name="description" id="description" placeholder="Ex: Meu trabalho; Minha casa, etc..." required>
                        </div>
                        <div class="modal-footer modal-footer-address">
                            <button type="submit" class="site-btn">
                              <i class="fa fa-save" aria-hidden="true"></i> Cadastrar
                           </button>
                        </div>
                        <input type="hidden" name="latitude" id="latitude" value="">
                        <input type="hidden" name="longitude" id="longitude" value="">
                        <input type="hidden" name="addressDetailsHidden" id="addressDetailsHidden" value="">
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <script type="text/javascript">

          var mapAddAddress;
          var originLatLng;
          var userMarker;

          function initMap() {
              mapAddAddress = new google.maps.Map(document.getElementById('mapAddAddress'), {
                  center: { lat: -4.9690932199055835, lng: -39.016540651386585 },
                  zoom: 15,
                  mapTypeId: 'roadmap'
              });

              // Adiciona um ouvinte de clique ao mapa
              mapAddAddress.addListener('click', function (event) {
                  // Obtém a latitude e longitude do local clicado.
                  var clickedLatLng = event.latLng;

                  // Remove o marcador existente (se houver)
                  if (userMarker) {
                      userMarker.setMap(null);
                  }

                  // Cria um novo marcador no local clicado.
                  userMarker = new google.maps.Marker({
                      position: clickedLatLng,
                      mapAddAddress: mapAddAddress,
                      title: 'Local Clicado'
                  });

                  // Define a origem como o local clicado.
                  originLatLng = clickedLatLng;
                  document.getElementById('origin').textContent = 'Clique no mapa para definir';

                  // Define os valores dos campos de entrada ocultos (latitude e longitude).
                  document.getElementById('latitude').value = clickedLatLng.lat();
                  document.getElementById('longitude').value = clickedLatLng.lng();

                  // Obtém informações detalhadas do endereço e exibe na página
                  getAddressDetails(clickedLatLng);
              });
          }

          function getAddressDetails(latLng) {
             var geocoder = new google.maps.Geocoder();

             geocoder.geocode({ 'location': latLng }, function (results, status) {
                 if (status === 'OK') {
                     if (results[0]) {
                         // Exclui o número da casa e o CEP do endereço
                         var addressComponents = results[0].address_components.filter(function (component) {
                             return !['street_number', 'postal_code'].includes(component.types[0]);
                         });

                         // Constrói o endereço sem o número da casa e o CEP
                         var addressDetails = addressComponents.map(function (component) {
                             return component.short_name;
                         }).join(', ');

                         // Exibe o endereço detalhado na página
                         document.getElementById('addressDetails').textContent = 'Endereço: ' + addressDetails;

                         // Atualiza o valor do campo escondido
                         document.getElementById('addressDetailsHidden').value = addressDetails;
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

                      // Remove o marcador existente (se houver)
                      if (userMarker) {
                          userMarker.setMap(null);
                      }

                      // Cria um novo marcador na localização do usuário.
                      userMarker = new google.maps.Marker({
                          position: userLocation,
                          map: map,
                          title: 'Sua Localização'
                      });

                      // Define a localização do usuário como o centro do mapa.
                      map.setCenter(userLocation);

                      // Define a origem como a localização do usuário.
                      document.getElementById('origin').textContent = 'Origem: Sua Localização';
                      originLatLng = userLocation;
                  }, function (error) {
                      // Trata possíveis erros ao obter a localização do usuário.
                      alert("Erro ao obter a localização do usuário.");
                  });
              } else {
                  alert("Seu navegador não suporta geolocalização.");
              }
          }

      </script>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>