<?php include_once __DIR__ . '/../includes/menu.php'; ?>

      <div class="container">
         <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9">
               <div class="card o-hidden border-0 my-5">
                  <div class="card-body p-0">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="p-3 mb-4 ">
                              <div class="d-sm-flex align-items-center justify-content-between">
                                 <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-map-marker"></i> Meus veículos</h1>
                                 <a class=" site-btn-secondary site-btn" data-toggle="modal" data-target="#addVehiclesModal"><i class="fas fa-fw fa-plus"></i> Adicionar novo</a>
                              </div>
                              <div class="mb-4 mt-4">
                                 <?= SessionMessage(); ?>
                              </div>
                              <div class="container">
                                <?php if (empty($vehicles)) { ?>
                                    <div class="text-center mt-5">
                                        <img src="<?= IMG ?>/no_data.svg" style="width: 15%;" class="img-fluid" alt="Sem dados">
                                        <p class="mt-4 mb-4">Você ainda não cadastrou nenhum veículo!</p>
                                    </div>
                                <?php } else { ?>
                                    <div class="row">
                                        <?php foreach ($vehicles as $vehicle) { ?>
                                            <div class="col-md-6">
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        <h5 class="card-title">
                                                            <i class="fa fa-car" aria-hidden="true"></i>
                                                            <?= $vehicle->getBrand(); ?> <?= $vehicle->getModel(); ?>
                                                            <span class="float-right">
                                                                <button class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target="#editVehiclesModal<?= $vehicle->getId(); ?>" title="Editar">
                                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                                </button>
                                                                <form action="<?= BASE_URL ?>motorista/veiculo/delete" method="post" onsubmit="return confirm('Você tem certeza que quer apagar esse veículo?')" class="d-inline">
                                                                    <input type="hidden" name="id" id="id" value="<?= $vehicle->getId(); ?>">
                                                                    <button type="submit" class="btn btn-sm btn-danger" title="Apagar">
                                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                                    </button>
                                                                </form>
                                                            </span>
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <p class="card-text">
                                                                    <strong>Placa:</strong> <?= $vehicle->getPlate_number(); ?><br>

                                                                    <strong>Cor:</strong> <span class="badge text-white" style="background-color: <?= $vehicle->getColor(); ?>;">⠀</span>
                                                                </p>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <p class="card-text">
                                                                    <strong>Detalhes:</strong><br>
                                                                    <?= $vehicle->getDetails(); ?>
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
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- addVehiclesModal -->
      <div class="modal fade" id="addVehiclesModal" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-map" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-car"></i> Cadastrar Veículos</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
               </div>
               <div class="modal-body">
                  <div class="col-md-12">
                     <form class="user" action="<?= BASE_URL ?>motorista/veiculo/add" method="post">
                        <div class="form-group">
                            <label class="text-base label-color" for="vehicle_type_id">Tipo de veículo:</label>
                           <select class="form-control" name="vehicle_type_id" id="vehicle_type_id" required>
                               <option value="0">Selecione</option>
                               <?php foreach($typeVehicles as $typeVehicle){ ?>
                                <option value="<?= $typeVehicle->getId() ?>"><?= $typeVehicle->getType_name() ?></option>
                               <?php } ?>
                           </select>
                        </div>
                        <div class="form-group">
                           <label class="text-base label-color" for="plate_number">Placa:</label>
                           <input type="text" class="form-control form-control-user" name="plate_number" id="plate_number" placeholder="Placa" required>
                        </div>
                        <div class="form-group">
                           <label class="text-base label-color" for="brand">Marca:</label>
                           <input type="text" class="form-control form-control-user" name="brand" id="brand" placeholder="" required>
                        </div>
                        <div class="form-group">
                           <label class="text-base label-color" for="model">Modelo:</label>
                           <input type="text" class="form-control form-control-user" name="model" id="model" placeholder="" required>
                        </div>
                        <div class="form-group">
                           <label class="text-base label-color" for="color">Cor:</label>
                           <input type="color" class="form-control form-control-user" name="color" id="color" placeholder="" required>
                        </div>
                        <div class="form-group">
                           <label class="text-base label-color" for="manufacture_year">Ano de fabricação:</label>
                           <input type="text" class="form-control form-control-user" name="manufacture_year" id="manufacture_year" placeholder="" required>
                        </div>
                        <div class="form-group">
                           <label class="text-base label-color" for="details">Detalhes:</label>
                           <input type="text" class="form-control form-control-user" name="details" id="details" placeholder="" required>
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

      <!-- editVehiclesModal -->
      <?php foreach ($vehicles as $vehicle) { ?>
      <div class="modal fade" id="editVehiclesModal<?= $vehicle->getId() ?>" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-map" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-car"></i> Editar Veículo</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
               </div>
               <div class="modal-body">
                  <div class="col-md-12">
                     <form class="user" action="<?= BASE_URL ?>motorista/veiculo/edit" method="post">
                        <div class="form-group">
                            <label class="text-base label-color" for="vehicle_type_id">Tipo de veículo:</label>
                           <select class="form-control" name="vehicle_type_id" id="vehicle_type_id" disabled required>
                               <option value="0">Selecione</option>
                               <?php foreach($typeVehicles as $typeVehicle){ ?>
                                <option value="<?= $typeVehicle->getId() ?>" <?= $vehicle->getVehicle_type_id() == $typeVehicle->getId() ? "selected" : "" ?>><?= $typeVehicle->getType_name() ?></option>
                               <?php } ?>
                           </select>
                        </div>
                        <div class="form-group">
                           <label class="text-base label-color" for="plate_number">Placa:</label>
                           <input type="text" class="form-control form-control-user" name="plate_number" id="plate_number" placeholder="Placa" value="<?= $vehicle->getPlate_number() ?>" required>
                        </div>
                        <div class="form-group">
                           <label class="text-base label-color" for="brand">Marca:</label>
                           <input type="text" class="form-control form-control-user" name="brand" id="brand" placeholder="" value="<?= $vehicle->getBrand() ?>" required>
                        </div>
                        <div class="form-group">
                           <label class="text-base label-color" for="model">Modelo:</label>
                           <input type="text" class="form-control form-control-user" name="model" id="model" placeholder="" value="<?= $vehicle->getModel() ?>" required>
                        </div>
                        <div class="form-group">
                             <label class="text-base label-color" for="color">Cor:</label>
                            <input type="color" class="form-control form-control-user" name="color" id="color" value="<?= $vehicle->getColor() ?>" required>
                        </div>
                        <div class="form-group">
                           <label class="text-base label-color" for="manufacture_year">Ano de fabricação:</label>
                           <input type="text" class="form-control form-control-user" name="manufacture_year" id="manufacture_year" placeholder="" value="<?= $vehicle->getManufacture_year() ?>" required>
                        </div>
                        <div class="form-group">
                           <label class="text-base label-color" for="details">Detalhes:</label>
                           <input type="text" class="form-control form-control-user" name="details" id="details" placeholder="" value="<?= $vehicle->getDetails() ?>" required>
                        </div>
                        <input type="hidden" name="id" id="id" value="<?= $vehicle->getId() ?>" required>
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

<?php include_once __DIR__ . '/../includes/footer.php'; ?>