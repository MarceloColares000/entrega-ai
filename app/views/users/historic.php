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
                                          <div class="space-area shadow-sm">
                                             <div class="d-flex align-items-center mb-3">
                                                
                                                <p class="btn-warning py-1 px-2 mb-0 text-center">
                                                   <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>  Pendente  
                                                </p>
                                                
                                                <p class="text-muted ml-auto mb-0"><i class="far fa-clock" aria-hidden="true"></i> <?= date('d/m/Y, H:i', strtotime($delivery->getCreated_at())); ?></p>
                                             </div>
                                             <div class="d-flex">
                                                <p class="text-muted">Id do Pedido<br><span class=""><?= $delivery->getDelivery_id(); ?></span></p>
                                                
                                                <p class="text-muted ml-auto">Total do pedido<br><span class="font-weight-bold">R$ <?= number_format($delivery->getTotal_price(), 2, '.', ','); ?></span></p>
                                             </div>
                                          </div>
                                       </a>
                                    </div>

                                    <div class="modal fade" id="<?= $delivery->getDelivery_id(); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <h5 class="modal-title"><i class="fa fa-check-circle" aria-hidden="true"></i> Entrega #<?= $delivery->getDelivery_id(); ?></h5>
                                                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                     <span aria-hidden="true">×</span>
                                                 </button>
                                             </div>
                                             <div class="modal-body table-responsive">
                                                 <div id="container-fields">
                                                     <div class="row">
                                                         <div class="col-lg-12 col-md-12 col-sm-12">
                                                             <div class="osahan-status">
                                                                 <!-- Data da entrega -->
                                                                 <div class="space-area status-order border-bottom d-flex align-items-center">
                                                                     <p class="m-0"><i class="far fa-clock"></i> <?= date('d/m/Y, H:i', strtotime($delivery->getCreated_at())); ?></p>
                                                                 </div>

                                                                 <!-- Status do Pedido -->
                                                                 <div class="space-area border-bottom">
                                                                     <h6 class="font-weight-bold">Status do Pedido:</h6>
                                                                     <div class="tracking-wrap">
                                                                         <div class="my-1 step"><span class="text"></span></div>
                                                                     </div>
                                                                 </div>

                                                                 <!-- Observações -->
                                                                 <div class="space-area border-bottom">
                                                                     <h6 class="font-weight-bold">Suas observações:</h6>
                                                                     <p class="m-0"><?= ($delivery->getDelivery_details() == '' ? "Não há observações." : $delivery->getDelivery_details()) ?></p>
                                                                 </div>

                                                                 <!-- Local de entrega -->
                                                                 <div class="space-area border-bottom">
                                                                     <h6 class="font-weight-bold">Local de entrega:</h6>
                                                                     <p class="m-0 text-muted">Retirar no local</p>
                                                                 </div>

                                                                 <!-- Forma de pagamento -->
                                                                 <div class="space-area border-bottom">
                                                                     <h6 class="font-weight-bold">Forma de pagamento:</h6>
                                                                     <p class="m-0"><!-- Adicione a forma de pagamento aqui --></p>
                                                                 </div>

                                                                 <!-- Data de entrega -->
                                                                 <div class="space-area border-bottom">
                                                                     <h6 class="font-weight-bold"><i class="fa fa-truck" aria-hidden="true"></i> Entregue em:</h6>
                                                                     <p class="text-muted m-0"><?= date('d/m/Y, H:i', strtotime($delivery->getCreated_at())); ?></p>
                                                                 </div>

                                                                 <!-- Total -->
                                                                 <div class="space-area">
                                                                     <div class="d-flex align-items-center mb-2">
                                                                         <h6 class="font-weight-bold mb-1">Total:</h6>
                                                                         <h6 class="font-weight-bold ml-auto mb-1">R$ <?= number_format($delivery->getTotal_price(), 2, ',', '.'); ?></h6>
                                                                     </div>
                                                                     <p class="m-0 text-muted text-center">Obrigado por usar. Te esperamos de novo! <i class="fa fa-laugh-wink"></i></p>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="modal-footer" id="hidden-print">
                                                 <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
                                                 <button type="submit" class="btn btn-primary" target="_blank" onclick="window.print()"><i class="fa fa-print"></i> Imprimir comprovante</button>
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

<?php include_once __DIR__ . '/../includes/footer.php'; ?>