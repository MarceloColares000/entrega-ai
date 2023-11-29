<?php include_once __DIR__ . '/../includes/menu.php'; ?>
      
      
      <div class="container">
         <div class="view-account">
            <section class="module">
               <div class="module-inner">
                  <?php include_once __DIR__ . '/../includes/sideMenu.php'; ?>
                  <div class="content-panel">
                     <h2 class="title"><i class="fa fa-key"></i> Mudar senha</h2>
                     <div class="mb-4 mt-4">
                        <?= SessionMessage(); ?>
                        <div class="resp"></div>
                     </div>
                     <div class="billing">
                        <form action="<?= BASE_URL ?>usuario/senha/update" name="formPassword" method="post">
                           <div class="form-group">
                              <label class="control-label" for="oldPassword">Senha atual:</label>
                              <input type="password" class="styles__Field-tg3uj4-1 gXNzQk" name="oldPassword" id="oldPassword" placeholder="Senha atual" required>
                           </div>
                           <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                 <label class="control-label" for="password">Nova senha:</label>
                                 <input type="password" class="styles__Field-tg3uj4-1 gXNzQk" name="password" id="password" placeholder="Nova senha" required >
                              </div>
                              <div class="col-sm-6">
                                 <label class="control-label" for="repeatPassword">Repita a nova senha:</label>
                                 <input type="password" class="styles__Field-tg3uj4-1 gXNzQk" name="repeatPassword" id="repeatPassword" placeholder="Repita a senha" required>
                              </div>
                           </div>
                           <input type="hidden" name="user_id" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                           <button type="submit" onclick="return validated()" class="btn site-btn"><i class="fa fa-save"></i>  Atualizar</button>
                        </form>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>

      <script type="text/javascript">
         function validated(){
         
               var oldPassword = formPassword.oldPassword.value;
               var password = formPassword.password.value;
               var repeatPassword = formPassword.repeatPassword.value;
               
               if(oldPassword == ""){
                    $('.resp').html('<div class="alert alert-warning"><p> <strong>Ops!</strong> Preencha o campo Senha antiga.</p></div>')
                    formPassword.oldPassword.focus();
                    return false;
               }else{
                     $('.resp').html('');
               }

               if(password == "" || password.length <= 5){
                    $('.resp').html('<div class="alert alert-warning"><p> <strong>Ops!</strong> Preencha o campo senha com minimo 6 caracteres.</p></div>')
                    formPassword.password.focus();
                    return false;
               }else{
                     $('.resp').html('');
               }
               
               if(repeatPassword == "" || repeatPassword.length <= 5){
                    $('.resp').html('<div class="alert alert-warning"><p> <strong>Ops!</strong> Preencha o campo confirmar senha com minimo 6 caracteres.</p></div>')
                    formPassword.repeatPassword.focus();
                    return false;
               }else{
                     $('.resp').html('');
               }
               
               if (password != repeatPassword) {
                    $('.resp').html('<div class="alert alert-warning"><p> <strong>Ops!</strong> Senhas diferentes.</p></div>')
                    formPassword.password.focus();
                    return false;
               }else{
                     $('.resp').html('');
               }
         }

      </script>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>