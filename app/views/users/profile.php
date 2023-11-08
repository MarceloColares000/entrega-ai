<?php include_once __DIR__ . '/../includes/menu.php'; ?>

    <div class="container">
         <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9">
               <div class="card o-hidden border-0 my-5">
                  <div class="card-body p-0">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="p-5 mb-4 ">
                              <div class="d-sm-flex align-items-center justify-content-between">
                                 <h1 class="h3 mb-4 text-gray-800">Atualizar dados</h1>
                              </div>
                              <?= SessionMessage() ?>
                              <div id="update-message"></div>
                              <form class="user" action="<?= BASE_URL ?>usuario/update" method="post" id="user-form-edit">
                               <div class="form-group">
                                  <input type="text" class="form-control form-control-user" name="name" id="name" placeholder="Seu nome" value="<?= $_SESSION['user_name'] ?>" required>
                               </div>
                               <div class="form-group row">
                                  <div class="col-sm-6 mb-3 mb-sm-0">
                                     <input type="text" class="form-control form-control-user" onkeydown="javascript: fMasc(this, mTel);" maxlength="12" name="phone" id="phone" placeholder="Telefone (XX) XXXXX-XXXX" value="<?= $_SESSION['user_phone'] ?>" required >
                                  </div>
                                  <div class="col-sm-6">
                                     <input type="date" max="9999-12-31" class="form-control form-control-user" name="birthdate" id="birthdate" placeholder="Data de nascimento" value="<?= $_SESSION['user_birthdate'] ?>" required>
                                  </div>
                               </div>
                               <div class="form-group">
                                  <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Seu email" value="<?= $_SESSION['user_email'] ?>" disabled required>
                               </div>
                               <input type="hidden" name="user_id" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                               <button type="submit" class="btn btn-primary btn-user btn-block"><i class="fa fa-save"></i>  Atualizar</button>
                            </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <form class="user" action="<?= BASE_URL ?>usuario/delete" method="post" onsubmit="return confirm('Você deseja realmente excluir sua conta?');">
               <input type="hidden" name="user_id" name="user_id" value="<?= $_SESSION['user_id'] ?>">
               <button type="submit" class="btn btn-danger btn-user btn-block"><i class="fa fa-trash"></i> Apagar minha conta</button>
            </form>
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