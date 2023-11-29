<?php include_once __DIR__ . '/../includes/menu.php'; ?>
    
    <div class="container">
        <div class="view-account">
           <section class="module">
              <div class="module-inner">
                 <?php include_once __DIR__ . '/../includes/sideMenu.php'; ?>
                 <div class="content-panel">
                    <div class="d-sm-flex align-items-center justify-content-between">
                       <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-credit-card"></i> Meus cartões</h1>
                       <a class=" site-btn-secondary site-btn" data-toggle="modal" data-target="#addCardsModal"><i class="fas fa-fw fa-plus"></i> Adicionar novo</a>
                    </div>
                    <div class="mb-4 mt-4">
                       <?= SessionMessage(); ?>
                    </div>
                    <div class="container">
                       <?php if (empty($cards)) { ?>
                       <div class="text-center mt-5">
                          <img src="<?= IMG ?>/no_data.svg" style="width: 15%;" class="img-fluid" alt="Sem dados">
                          <p class="mt-4 mb-4">Você ainda não cadastrou nenhum cartão!</p>
                       </div>
                       <?php } else { ?>
                       <div class="row">
                          <?php foreach ($cards as $card) { ?>
                          <div class="col-md-6">
                             <div class="card mb-3">
                                <div class="card-header">
                                   <h5 class="card-title">
                                      <i class="fa fa-credit-card" aria-hidden="true"></i>
                                      <?= substr($card->getCard_number(), 0, strrpos($card->getCard_number(), '.' ) - 9 ).'**** ****'; ?>
                                      <span class="float-right">
                                         <button class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target="#editCardModal<?= $card->getId(); ?>" title="Editar">
                                         <i class="fa fa-edit" aria-hidden="true"></i>
                                         </button>
                                         <form action="<?= BASE_URL ?>usuario/cartoes/delete" method="post" onsubmit="return confirm('Você tem certeza que quer apagar esse cartão?')" class="d-inline">
                                            <input type="hidden" name="id" id="id" value="<?= $card->getId(); ?>">
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
                                            <strong>Data de expiração:</strong> <?= $card->getExpiration_date(); ?>
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
           </section>
        </div>
    </div>

      <!-- addCardsModal -->
      <div class="modal fade" id="addCardsModal" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-map" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-credit-card"></i> Cadastrar cartão</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
               </div>
               <div class="modal-body">
                  <div class="col-md-12">
                     <form class="user" action="<?= BASE_URL ?>usuario/cartoes/add" method="post">
                        <div class="form-group">
                           <label class="text-base label-color" for="card_number">Número do cartão:</label>
                           <input type="text" class="gXNzQk" name="card_number" id="card_number" placeholder="••••  ••••  ••••  ••••" onkeyup="formatar(this,'#### #### #### ####',event)" maxlength="19" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                           <label class="text-base label-color" for="cardholder_name">Nome no cartão:</label>
                           <input type="text" class="gXNzQk" name="cardholder_name" id="cardholder_name" placeholder="Digite exatamente como está no cartão" autocomplete="off" required>
                        </div>
                        <div class="form-group row">
                           <div class="col-sm-6 mb-3 mb-sm-0">
                             <label class="control-label" for="expiration_date">Data de expiração:</label>
                             <input type="text" class="gXNzQk" maxlength="7" onkeyup="formatar(this,'##/####',event)" name="expiration_date" id="expiration_date" placeholder="••/••••" autocomplete="off" required >
                          </div>
                          <div class="col-sm-6">
                             <label class="control-label" for="cvv">CVV:</label>
                             <input type="number" class="styles__Field-tg3uj4-1 gXNzQk" name="cvv" id="cvv" maxlength="3" placeholder="" autocomplete="off" required>
                          </div>
                        </div>
                        <div class="modal-footer modal-footer-address">
                            <button type="submit" class="site-btn">
                              <i class="fa fa-save" aria-hidden="true"></i> Cadastrar
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- editCardModal -->
      <?php foreach ($cards as $card) { ?>
      <div class="modal fade" id="editCardModal<?= $card->getId() ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                     <form class="user" action="<?= BASE_URL ?>usuario/cartoes/edit" method="post">
                        <div class="form-group">
                           <label class="text-base label-color" for="card_number">Número do cartão:</label>
                           <input type="text" class="gXNzQk" name="card_number" id="card_number" placeholder="••••  ••••  ••••  ••••" onkeyup="formatar(this,'#### #### #### ####',event)" maxlength="19" value="<?= $card->getCard_number(); ?>" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                           <label class="text-base label-color" for="cardholder_name">Nome no cartão:</label>
                           <input type="text" class="gXNzQk" name="cardholder_name" id="cardholder_name" placeholder="Digite exatamente como está no cartão" value="<?= $card->getCardholder_name(); ?>" autocomplete="off" required>
                        </div>
                        <div class="form-group row">
                           <div class="col-sm-6 mb-3 mb-sm-0">
                             <label class="control-label" for="expiration_date">Data de expiração:</label>
                             <input type="text" class="gXNzQk" maxlength="7" onkeyup="formatar(this,'##/####',event)" name="expiration_date" id="expiration_date" placeholder="••/••••" value="<?= $card->getExpiration_date(); ?>" autocomplete="off" required >
                          </div>
                          <div class="col-sm-6">
                             <label class="control-label" for="cvv">CVV:</label>
                             <input type="number" class="styles__Field-tg3uj4-1 gXNzQk" name="cvv" id="cvv" maxlength="3" placeholder="" value="<?= $card->getCvv(); ?>" autocomplete="off" required>
                          </div>
                        </div>
                        <input type="hidden" name="id" id="id" value="<?= $card->getId(); ?>">
                        <div class="modal-footer modal-footer-address">
                            <button type="submit" class="site-btn">
                              <i class="fa fa-save" aria-hidden="true"></i> Salvar
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
    <?php } ?>

    <script type="text/javascript">
        /* Máscaras ER */
        function mascara(o,f){
            v_obj=o
            v_fun=f
            setTimeout("execmascara()",1)
        }
        
        function execmascara(){
            v_obj.value=v_fun(v_obj.value)
        }
        function mcc(v){
            v=v.replace(/\D/g,"");
            v=v.replace(/^(\d{4})(\d)/g,"$1 $2");
            v=v.replace(/^(\d{4})\s(\d{4})(\d)/g,"$1 $2 $3");
            v=v.replace(/^(\d{4})\s(\d{4})\s(\d{4})(\d)/g,"$1 $2 $3 $4");
            return v;
        }
        function id( el ){
            return document.getElementById( el );
        }
        window.onload = function(){
            id('card_number').onkeypress = function(){
                mascara( this, mcc );
            }
        }

        function formatar(src, mask,e) 
        {
            var tecla =""
            if (document.all) // Internet Explorer
                tecla = event.keyCode;
            else
                tecla = e.which;
            //code = evente.keyCode;
            if(tecla != 8){


            if (src.value.length == src.maxlength){
            return;
            }
          var i = src.value.length;
          var saida = mask.substring(0,1);
          var texto = mask.substring(i);
          if (texto.substring(0,1) != saida) 
          {
            src.value += texto.substring(0,1);
          }
              }
        }
    </script>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>