<?php include_once __DIR__ . '/../includes/menu.php'; ?>
      
      
      <div class="container">
         <div class="view-account">
            <section class="module">
               <div class="module-inner">
                  <?php include_once __DIR__ . '/../includes/sideMenu.php'; ?>
                  <div class="content-panel">
                     <h2 class="title">Meus dados</h2>
                     <div class="mb-4 mt-4">
                        <?= SessionMessage(); ?>
                     </div>
                     <div class="billing">
                        <form action="<?= BASE_URL ?>usuario/update" method="post" id="user-form-edit">
                           <div class="form-group">
                              <label class="control-label" for="name">Nome completo:</label>
                              <input type="text" class="styles__Field-tg3uj4-1 gXNzQk" name="name" id="name" placeholder="Seu nome" value="<?= $_SESSION['user_name'] ?>" required>
                           </div>
                           <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                 <label class="control-label" for="phone">Telefone:</label>
                                 <input type="text" class="styles__Field-tg3uj4-1 gXNzQk" onkeydown="javascript: fMasc(this, mTel);" maxlength="12" name="phone" id="phone" placeholder="Telefone (XX) XXXXX-XXXX" value="<?= $_SESSION['user_phone'] ?>" required >
                              </div>
                              <div class="col-sm-6">
                                 <label class="control-label" for="birthdate">Data de nascimento:</label>
                                 <input type="date" max="9999-12-31" class="styles__Field-tg3uj4-1 gXNzQk" name="birthdate" id="birthdate" placeholder="Data de nascimento" value="<?= $_SESSION['user_birthdate'] ?>" required>
                              </div>
                           </div>
                           <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                 <label class="control-label" for="cpf">Cpf:</label>
                                 <input type="text" class="styles__Field-tg3uj4-1 gXNzQk" onkeydown="javascript: fMasc(this, mCPF);" maxlength="14" name="cpf" id="cpf" placeholder="Telefone (XX) XXXXX-XXXX" value="<?= $_SESSION['user_cpf'] ?>" required >
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label" for="email">Email:</label>
                              <input type="email" class="styles__Field-tg3uj4-1 gXNzQk" name="email" id="email" placeholder="Seu email" value="<?= $_SESSION['user_email'] ?>" disabled required>
                           </div>
                           <input type="hidden" name="user_id" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                           <button type="submit" class="btn site-btn"><i class="fa fa-save"></i>  Atualizar</button>
                        </form>
                     </div>

                     <form class="user" action="<?= BASE_URL ?>usuario/delete" method="post" onsubmit="return confirm('Você deseja realmente excluir sua conta?');">
                        <input type="hidden" name="user_id" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                        <button type="submit" class="btn btn-danger btn-user"><i class="fa fa-trash"></i> Apagar minha conta</button>
                     </form>
                  </div>
               </div>
            </section>
         </div>
      </div>

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <script type="text/javascript">
         
         $(document).ready(function() {
          
            $('#user-form-edit').submit(function(event) {
               
               event.preventDefault();

               // Check if any required fields are empty
               var name = $('#name').val().trim();
               var phone = $('#phone').val().trim();
               var email = $('#email').val().trim();
               var birthdate = $('#birthdate').val().trim();

               if (name === '' || phone === '' || birthdate === '') {
                  Swal.fire({
                     icon: 'error',
                     title: 'Erro!',
                     text: 'Preencha todos os campos obrigatórios.',
                  });
                  return;
               }

               var formData = $(this).serialize();

               $.ajax({
                  type: 'POST',
                  url: '<?= BASE_URL ?>usuario/update',
                  data: formData,
                  
                  success: function(response) {
               
                     if (response.success) {
                        Swal.fire({
                           icon: 'success',
                           title: 'Sucesso!',
                           text: 'Os seus dados foram atualizados!',
                        });
                     } else {
                        Swal.fire({
                           icon: 'error',
                           title: 'Erro!',
                           text: 'Não foi possível atualizar seus dados. Tente novamente!',
                        });
                     }

                  },

               });
            
            });
         
         });

      </script>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>