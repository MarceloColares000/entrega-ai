<?php  if(isset($_SESSION['user_id'])){ ?>

         <div class="side-bar">
            <div class="user-info">
               <img class="img-profile img-circle img-responsive center-block" src="<?= IMG ?>/avatar.png" alt="">
               <ul class="meta list list-unstyled">
                  <li class="name"><?= $_SESSION['user_name']; ?>
                  </li>
               </ul>
            </div>
            <nav class="side-menu">
               <ul class="nav">
                  <li class="<?= ($menuDinamic == "/meus-dados" ? "active" : ""); ?>">
                     <a href="<?= BASE_URL ?>usuario/meus-dados"><span class="fa fa-user"></span> Conta</a>
                  </li>
                  <li class="<?= ($menuDinamic == "/historico" ? "active" : ""); ?>">
                     <a href="<?= BASE_URL ?>usuario/historico"><span class="fa fa-list-ol"></span> Histórico</a>
                  </li>
                  <li class="<?= ($menuDinamic == "/enderecos" ? "active" : ""); ?>">
                     <a href="<?= BASE_URL ?>usuario/enderecos"><span class="fa fa-map-marker"></span> Meus endereços</a>
                  </li>
                  <li class="<?= ($menuDinamic == "/cartoes" ? "active" : ""); ?>">
                     <a href="<?= BASE_URL ?>usuario/cartoes"><span class="fa fa-credit-card"></span> Meus cartões</a>
                  </li>
                  <li class="<?= ($menuDinamic == "/mudar-senha" ? "active" : ""); ?>">
                     <a href="<?= BASE_URL ?>usuario/mudar-senha"><span class="fa fa-key"></span> Mudar senha</a>
                  </li>
                  <li>
                     <a href="<?= BASE_URL ?>usuario/logout"><span class="fa fa-sign-out"></span> Sair</a>
                  </li>
               </ul>
            </nav>
         </div>

<?php  }elseif(isset($_SESSION['driver_id'])){ ?>

      <div class="side-bar">
            <div class="user-info">
               <img class="img-profile img-circle img-responsive center-block" src="<?= IMG ?>/avatar.png" alt="">
               <ul class="meta list list-unstyled">
                  <li class="name"><?= $_SESSION['driver_name']; ?>
                  </li>
               </ul>
            </div>
            <nav class="side-menu">
               <ul class="nav">
                  <li class="<?= ($menuDinamic == "/meus-dados" ? "active" : ""); ?>">
                     <a href="<?= BASE_URL ?>motorista/meus-dados"><span class="fa fa-user"></span> Conta</a>
                  </li>
                  <li class="<?= ($menuDinamic == "/veiculos" ? "active" : ""); ?>">
                     <a href="<?= BASE_URL ?>motorista/veiculos"><span class="fa fa-car"></span> Meus veículos</a>
                  </li>
                  <li class="<?= ($menuDinamic == "/mudar-senha" ? "active" : ""); ?>">
                     <a href="<?= BASE_URL ?>motorista/mudar-senha"><span class="fa fa-key"></span> Mudar senha</a>
                  </li>
               </ul>
            </nav>
         </div>

<?php  }else{} ?>