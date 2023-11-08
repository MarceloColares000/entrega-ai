<?php include_once __DIR__ . '/../includes/menuLogin.php'; ?>

    
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
                               <h1 class="h4 text-gray-900 mb-4">Olá! Que bom te ver aqui!</h1>
                               <p>Precisamos de alguns dados básicos pessoais.</p>
                            </div>
                            <?= SessionMessage(); ?>
                            <form class="user" action="<?= BASE_URL ?>motorista/signup" method="post">
                               <div class="form-group">
                                    <label class="text-base label-color" for="name">Nome:</label>
                                    <input type="text" class="form-control form-control-user" name="name" id="name" placeholder="Seu nome" required>
                               </div>
                               <div class="form-group row">
                                  <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="text-base label-color" for="phone">Telefone:</label>
                                    <input type="text" class="form-control form-control-user" onkeydown="javascript: fMasc(this, mTel);" maxlength="15" name="phone" id="phone" placeholder="(00) 00000-0000" required>
                                  </div>
                                  <div class="col-sm-6">
                                    <label class="text-base label-color" for="birthdate">Data de nascimento:</label>
                                    <input type="date" max="9999-12-31" class="form-control form-control-user" name="birthdate" id="birthdate" placeholder="Data de nascimento" required>
                                  </div>
                               </div>
                               <div class="form-group row">
                                  <div class="col-sm-6 mb-3 mb-sm-0">
                                     <label class="text-base label-color" for="cpf">CPF:</label>
                                     <input type="text" class="form-control form-control-user" onkeydown="javascript: fMasc(this, mCPF);" maxlength="14" name="cpf" id="cpf" placeholder="000.000.000-00" required>
                                  </div>
                                  <div class="col-sm-6">
                                    <label class="text-base label-color" for="licence">Carteira de motorista:</label>
                                    <input type="text" class="form-control form-control-user" onkeydown="javascript: fMasc(this, mCNH);" name="licence" id="licence" maxlength="11" placeholder="Número da habilitação" required>
                                  </div>
                               </div>
                               <div class="form-group">
                                  <label class="text-base label-color" for="email">Email:</label>
                                  <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Seu email" required>
                               </div>
                               <div class="form-group row">
                                  <div class="col-sm-6 mb-3 mb-sm-0">
                                     <label class="text-base label-color" for="password">Senha:</label>
                                     <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Sua senha" required>
                                  </div>
                               </div>
                               <button type="submit" class="btn btn-primary btn-user btn-block">Cadastrar</button>
                            </form>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
