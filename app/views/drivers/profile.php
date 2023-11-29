<?php include_once __DIR__ . '/../includes/menu.php'; ?>
      
      
      <div class="container">
         <div class="col-lg-12">
            <div class="p-3 mb-4 mt-4">
               <div class="d-sm-flex align-items-center justify-content-between">
                  <h1 class="h3 mb-4 text-gray-800">Oi, <?= $_SESSION['first_name']; ?>! 😊</h1>
               </div>
            </div>
         </div>
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
                        <form action="<?= BASE_URL ?>motorista/update" method="post">
                           <div class="form-group">
                              <label class="control-label" for="name">Nome completo:</label>
                              <input type="text" class="styles__Field-tg3uj4-1 gXNzQk" name="name" id="name" placeholder="Seu nome" value="<?= $_SESSION['driver_name'] ?>" required>
                           </div>
                           <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                 <label class="control-label" for="phone">Telefone:</label>
                                 <input type="text" class="styles__Field-tg3uj4-1 gXNzQk" onkeydown="javascript: fMasc(this, mTel);" maxlength="12" name="phone" id="phone" placeholder="Telefone (XX) XXXXX-XXXX" value="<?= $_SESSION['driver_phone'] ?>" required >
                              </div>
                              <div class="col-sm-6">
                                 <label class="control-label" for="birthdate">Data de nascimento:</label>
                                 <input type="date" max="9999-12-31" class="styles__Field-tg3uj4-1 gXNzQk" name="birthdate" id="birthdate" placeholder="Data de nascimento" value="<?= $_SESSION['driver_birthdate'] ?>" required>
                              </div>
                           </div>
                           <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                 <label class="control-label" for="cpf">Cpf:</label>
                                 <input type="text" class="styles__Field-tg3uj4-1 gXNzQk" onkeydown="javascript: fMasc(this, mCPF);" maxlength="14" name="cpf" id="cpf" placeholder="Telefone (XX) XXXXX-XXXX" value="<?= $_SESSION['driver_cpf'] ?>" required >
                              </div>
                              <div class="col-sm-6">
                                 <label class="control-label" for="licence">Numero da carteira:</label>
                                 <input type="number" class="styles__Field-tg3uj4-1 gXNzQk" name="licence" id="licence" placeholder="" required>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label" for="email">Email:</label>
                              <input type="email" class="styles__Field-tg3uj4-1 gXNzQk" name="email" id="email" placeholder="Seu email" value="<?= $_SESSION['driver_email'] ?>" disabled required>
                           </div>
                           <input type="hidden" name="driver_id" name="driver_id" value="<?= $_SESSION['driver_id'] ?>">
                           <button type="submit" class="btn site-btn"><i class="fa fa-save"></i>  Atualizar</button>
                        </form>
                     </div>

                     <form class="user" action="<?= BASE_URL ?>motorista/delete" method="post" onsubmit="return confirm('Você deseja realmente excluir sua conta?');">
                        <input type="hidden" name="driver_id" name="driver_id" value="<?= $_SESSION['driver_id'] ?>">
                        <button type="submit" class="btn btn-danger btn-user"><i class="fa fa-trash"></i> Apagar minha conta</button>
                     </form>
                  </div>
               </div>
            </section>
         </div>
      </div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>