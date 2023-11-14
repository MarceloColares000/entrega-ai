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
                                 <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-map-marker"></i> Meus endereços</h1>
                                 <a class="site-btn site-btn-secondary"><i class="fas fa-fw fa-print"></i> Gerar PDF</a>
                              </div>    
                              <div class="text-center">
                              <?php 
                              if(empty($adresses)){ ?>
                             
                              <div class="text-center">
                                 <img src="<?= IMG ?>/no_data.svg" style="width: 15%;" class="img-fluid ">
                                 <p class="mt-4 mb-4">Você ainda não cadastrou nenhum endereço!</p>
                              </div>
                              
                              <?php 
                              } foreach($adresses as $address){ ?>


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

<?php include_once __DIR__ . '/../includes/footer.php'; ?>