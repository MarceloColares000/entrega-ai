<?php include_once __DIR__ . '/../includes/menu.php'; ?>
      
      
      <div class="container">
         <div class="view-account">
            <section class="module">
               <div class="module-inner">
                  <?php include_once __DIR__ . '/../includes/sideMenu.php'; ?>
                  <div class="content-panel">
                    <div class="d-sm-flex align-items-center justify-content-between">
                       <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-credit-card"></i> Conta para pagamento</h1>
                       <a class=" site-btn-secondary site-btn" data-toggle="modal" data-target="#addAccountModal"><i class="fas fa-fw fa-plus"></i> Adicionar nova</a>
                    </div>
                     <div class="mb-4 mt-4">
                        <?= SessionMessage(); ?>
                     </div>
                     <div class="container">
                        <?php if (empty($accountBankDAO)) { ?>
                       <div class="text-center mt-5">
                          <img src="<?= IMG ?>/no_data.svg" style="width: 15%;" class="img-fluid" alt="Sem dados">
                          <p class="mt-4 mb-4">Você ainda não cadastrou nenhuma conta!</p>
                       </div>
                       <?php } else { ?>
                       <div class="row">
                          <?php foreach ($accountBankDAO as $account) { ?>
                          <div class="col-md-6">
                             <div class="card mb-3">
                                <div class="card-header">
                                   <h5 class="card-title">
                                      <i class="fa fa-credit-card" aria-hidden="true"></i>
                                      <?= substr($account->getAccount_number(), 0, strrpos($account->getAccount_number(), '.' ) - 9 ).'**** ****'; ?>
                                      <span class="float-right">
                                         <button class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target="#editAccountModal<?= $account->getId(); ?>" title="Editar">
                                         <i class="fa fa-edit" aria-hidden="true"></i>
                                         </button>
                                         <form action="<?= BASE_URL ?>usuario/cartoes/delete" method="post" onsubmit="return confirm('Você tem certeza que quer apagar esse cartão?')" class="d-inline">
                                            <input type="hidden" name="id" id="id" value="<?= $account->getId(); ?>">
                                            <button type="submit" class="btn btn-sm btn-danger" title="Apagar">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                         </form>
                                      </span>
                                   </h5>
                                </div>
                                <div class="card-body">
                                   <div class="row">
                                      <div class="col-sm-12">
                                         <p class="card-text">
                                            <strong>Nome:</strong> <?= $account->getAccount_holder_name(); ?><br>
                                            <strong>Banco:</strong> <?= $account->getBank_name(); ?><br>
                                         </p>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <?php } ?>
                       </div>
                       <?php } ?>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>

      <!-- addAccountModal -->
      <div class="modal fade" id="addAccountModal" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-map" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-credit-card"></i> Conta para pagamento</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
               </div>
               <div class="modal-body">
                  <div class="col-md-12">
                     <form action="<?= BASE_URL ?>motorista/conta-bancaria/add" method="post" id="user-form-edit">
                           
                           <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                 <label class="control-label" for="account_number">Número da conta:</label>
                                 <input type="text" class="styles__Field-tg3uj4-1 gXNzQk" name="account_number" id="account_number" placeholder="" value="" required>
                              </div>
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                 <label class="control-label" for="account_holder_name">Nome da conta:</label>
                                 <input type="text" class="styles__Field-tg3uj4-1 gXNzQk" name="account_holder_name" id="account_holder_name" placeholder="" value="" required >
                              </div>
                           </div>
                           <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                 <label class="control-label" for="bank_name">Nome do banco:</label>
                                 <input type="text" class="styles__Field-tg3uj4-1 gXNzQk" name="bank_name" id="bank_name" value="" required >
                              </div>
                           </div>
                           <input type="hidden" name="driver_id" name="driver_id" value="<?= $_SESSION['driver_id'] ?>">
                           <button type="submit" class="btn site-btn"><i class="fa fa-save"></i>  Atualizar</button>
                     
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- editAccountModal -->
      <?php foreach ($accountBankDAO as $account) { ?>
      <div class="modal fade" id="editAccountModal<?= $account->getId() ?>" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-map" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-credit-card"></i> Editar cartão</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
               </div>
               <div class="modal-body">
                  <div class="col-md-12">
                     <form action="<?= BASE_URL ?>motorista/conta-bancaria/edit" method="post" id="user-form-edit">
                           
                           <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                 <label class="control-label" for="account_number">Número da conta:</label>
                                 <input type="text" class="styles__Field-tg3uj4-1 gXNzQk" name="account_number" id="account_number" placeholder="" value="<?= $account->getAccount_number(); ?>" required>
                              </div>
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                 <label class="control-label" for="account_holder_name">Nome da conta:</label>
                                 <input type="text" class="styles__Field-tg3uj4-1 gXNzQk" name="account_holder_name" id="account_holder_name" placeholder="" value="<?= $account->getAccount_holder_name(); ?>" required >
                              </div>
                           </div>
                           <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                 <label class="control-label" for="bank_name">Nome do banco:</label>
                                 <input type="text" class="styles__Field-tg3uj4-1 gXNzQk" name="bank_name" id="bank_name" value="<?= $account->getBank_name(); ?>" required >
                              </div>
                           </div>
                           <input type="hidden" name="driver_id" name="driver_id" value="<?= $_SESSION['driver_id'] ?>">
                           <button type="submit" class="btn site-btn"><i class="fa fa-save"></i>  Atualizar</button>
                     
                     </form>

                  </div>
               </div>
            </div>
         </div>
      </div>
    <?php } ?>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>