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
                               <h1 class="h4 text-gray-900 mb-4">Olá, motorista! Que bom te ver de novo!</h1>
                            </div>
                            <?= SessionMessage(); ?>
                            <form class="user" action="<?= BASE_URL ?>motorista/signin" method="post">
                               <div class="form-group">
                                  <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Seu email" required>
                               </div>
                               <div class="form-group">
                                     <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password" required>
                               </div>
                               <button type="submit" class="btn btn-primary btn-user btn-block">Entrar</button>
                            </form>
                            <hr>
                            <div class="text-center">
                               <a href="#" class="small" data-toggle="modal" data-target="#recuperarSenha">Esqueceu sua senha?</a>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>

    <div class="modal fade" id="recuperarSenha" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-unlock-alt"></i> Recuperar senha</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-gray-500">
                        Sabemos que imprevistos acontecem, por isso vamos te enviar um email com as instruções para recuperar sua senha.
                    </p>
                    <form class="user" method="post" action="">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="name" name="name" required value="" placeholder="Digite o email cadastrado no sistema">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" type="submit" id="btn">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
