<?php include_once __DIR__ . '/../includes/menu.php'; ?>

    <div class="container">
       <div class="row justify-content-center">
          <div class="col-xl-6 col-lg-12 col-md-9">
             <div class="card o-hidden border-0 shadow-lg my-5" data-aos="fade-up">
                <div class="card-body p-0">
                   <!-- Nested Row within Card Body -->
                   <div class="row">
                      <div class="col-lg-12">
                         <div class="p-5">
                            <div class="text-center">
                               <h1 class="h4 text-gray-900 mb-4">O login funcionou!</h1>
                            </div>
                            <?= SessionMessage(); ?>
                              
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>

    <div class="container spad">
        <div class="section-title" data-aos="fade-right" data-aos-once="true">
            <h2>Calcule sua rota</h2>
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
                    <p>Origem: <span id="origin">Clique no mapa para definir</span></p>
                    <p>Destino: <span id="destination">Clique no mapa para definir</span></p>
                    <p>Numero: <input class="form-select" type="text"></p>
                    <p>Distância por estrada: <span id="distance"></span></p>
                    <p>Tempo estimado: <span id="duration"></span></p>
                    <p id="cost-section">Custo estimado: R$<span id="cost"></span></p>
                    <div class="input-group col-md-12">
                        <label for="vehicle">Selecione o tipo de veículo:</label>
                        <select id="vehicle" class="form-select col-md-4">
                            <option value="1">Moto</option>
                            <option value="2">Carro</option>
                            <option value="3">Caminhão</option>
                        </select>
                    </div>
                    <button class="site-btn" onclick="calculateCost()">
                        <i class="fa fa-usd" aria-hidden="true"></i> Calcular Custo
                    </button>
                    <button class="site-btn-danger" onclick="clearMap()">
                        <i class="fa fa-times" aria-hidden="true"></i> Limpar Mapa
                    </button>
                </div>
            </div>
        </div>

        <input type="hidden" name="latitude" id="latitude" value="">
        <input type="hidden" name="longitude" id="longitude" value="">
        <input type="hidden" name="address" id="address" value="">
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
            center: { lat: -4.9690932199055835, lng: -39.016540651386585 },
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


    function getUserLocation() {
        // Obtém a localização do usuário usando a geolocalização do navegador.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
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
            }, function(error) {
                // Trata possíveis erros ao obter a localização do usuário.
                switch(error.code) {
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

            directionsService.route(request, function(result, status) {
                if (status == 'OK') {
                    // Exibe a distância e o tempo estimado da rota.
                    var route = result.routes[0];
                    var distance = route.legs[0].distance.text;
                    var duration = route.legs[0].duration.text;

                    document.getElementById('distance').textContent = distance;
                    document.getElementById('duration').textContent = duration;

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
                var vehicleType = document.getElementById('vehicle').value;

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

                    document.getElementById('cost').textContent =  cost.toFixed(2).replace('.', ',');
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
        directionsRenderer.setDirections({ routes: [] });
    }
    </script>
    <!-- Map Begin -->
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49116.39176087041!2d-86.41867791216099!3d39.69977417971648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886ca48c841038a1%3A0x70cfba96bf847f0!2sPlainfield%2C%20IN%2C%20USA!5e0!3m2!1sen!2sbd!4v1586106673811!5m2!1sen!2sbd"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <!-- Map End -->
    <style type="text/css">
      .map {
         height: 500px;
         position: relative;
      }

      .map iframe {
         width: 100%;
      }

    </style>
<?php include_once __DIR__ . '/../includes/footer.php'; ?>