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
         <li class="<?= ($menuDinamic == "/mudar-senha" ? "active" : ""); ?>">
            <a href="<?= BASE_URL ?>usuario/mudar-senha"><span class="fa fa-key"></span> Mudar senha</a>
         </li>
      </ul>
   </nav>
</div>