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
                                 <h1 class="h3 mb-4 text-gray-800">Oi, <?= $_SESSION['first_name']; ?>! O que deseja? 😊</h1>
                              </div>
                              <div class="btn-startin-container mb-5">
                                  <a href="<?= BASE_URL ?>usuario/servicos" class="site-btn site-btn-secondary">
                                      <span><i class="fa fa-truck"></i> Solicitar serviço</span>
                                  </a>
                                  <button class="site-btn site-btn-secondary" type="button" data-toggle="collapse" data-target="#collapseRastreio" aria-expanded="false">
                                    <span><i class="fa fa-search"></i> Rastrear Encomenda</span>
                                  </button>
                                  <div class="collapse  col-lg-6 text-center" style="margin: auto; margin-top: 20px;" id="collapseRastreio">
                                      <div class="card-body">
                                        <form class="user" action="<?= BASE_URL ?>usuario/rastrear" method="post" id="searchForm">
                                           <div class="form-group">
                                             <input type="text" class="form-control form-control-user" name="deliveryId" id="deliveryId" placeholder="Código de rastreio" value="<?= (isset($deliveryId) ? $deliveryId : ""); ?>" 
                                      aria-label="Search" aria-describedby="basic-addon2" required>
                                    
                                           </div>
                                           <button type="submit" class="btn btn-primary btn-user btn-block"><span><i class="fa fa-search"></i> Rastrear</span></button>
                                        </form>
                                      </div>
                                  </div>
                              </div>
                              <div class="text-center">
                                 <img src="<?= IMG ?>/order_ride.svg">
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
          document.getElementById("searchForm").addEventListener("submit", function (event) {
              event.preventDefault();
              
              var deliveryId = document.getElementById("deliveryId").value;
              window.location.href = "<?= BASE_URL; ?>usuario/rastrear/delivery/" + encodeURIComponent(deliveryId);
          });
      </script>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>