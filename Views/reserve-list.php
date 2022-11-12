<?php
require_once(VIEWS_PATH . "header.php");
require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">

               <h2 class="mb-4"> Tus Reservas <?php echo "(" . $pseudostatus . ")" ?> </h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Guardian</th>
                         <th>Mascota</th>
                         <th>Fecha de Inicio</th>
                         <th>Fecha de Fin</th>
                         <th>Monto Total</th>
                         <th>Estado</th>
                         <th>Accionar</th>
                    </thead>
                    <tbody>
                         <?php
                         foreach ($reserveList as $reserve) {
                         ?>
                              <tr>
                                   <td><a href="<?php echo FRONT_ROOT ?>User/ShowExternalProfile/<?php echo $reserve->getReceiverid() ?>" class="btn btn-primary btn-sm"> <?php echo $keeperInfo->GetUserById($reserve->getReceiverid())->getName() ?> </a></td>
                                   <td><a href="<?php echo FRONT_ROOT ?>Pet/ShowProfileView/<?php echo $reserve->getPetid() ?>" class="btn btn-primary btn-sm"><?php echo $petInfo->PetFinder($reserve->getPetid())->getName() ?></a></td>
                                   <td><?php echo $reserve->getFirstdate() ?></td>
                                   <td><?php echo $reserve->getLastdate() ?></td>
                                   <td><?php echo "$" . $reserve->getAmount() ?></td>
                                   <td><?php echo $reserve->getStatus() ?></td>
                                   <td>
                                        <?php if ($reserve->getStatus() == "await") { ?>

                                             <?php if ($_SESSION['type'] == 'G') { ?>
                                                  <a href="<?php echo FRONT_ROOT ?>Reserve/AcceptReserve/<?php echo $reserve->getReserveid() ?>" class="btn btn-success btn-sm">Aceptar Reserva</a>
                                                  <br>
                                                  <br>
                                                  <a href="<?php echo FRONT_ROOT ?>Reserve/RejectReserve/<?php echo $reserve->getReserveid() ?>" class="btn btn-danger btn-sm">Rechazar Reserva</a>
                                             <?php } ?>

                                        <?php } else if ($reserve->getStatus() == "confirmed") { ?>

                                             <?php if ($_SESSION['type'] == 'D') { ?>
                                                  <a href="<?php echo FRONT_ROOT ?>Reserve/PayReserve/<?php echo $reserve->getReserveid() ?>" class="btn btn-success btn-sm">Pagar Reserva</a>
                                             <?php } ?>

                                        <?php } else if ($reserve->getStatus() == "rejected") { ?>

                                        <?php } else if ($reserve->getStatus() == "payed") { ?>

                                             <?php if ($_SESSION['type'] == 'G') { ?>
                                                  <a href="<?php echo FRONT_ROOT ?>Reserve/CheckInPet/<?php echo $reserve->getReserveid() ?>" class="btn btn-success btn-sm">Marcar Ingreso</a>
                                             <?php } ?>

                                        <?php } else if ($reserve->getStatus() == "in progress") { ?>
                                             <?php if ($_SESSION['type'] == 'D') { ?>
                                                  <a href="<?php echo FRONT_ROOT ?>Reserve/PickUpPet/<?php echo $reserve->getReserveid() ?>" class="btn btn-success btn-sm">Marcar Retiro</a>
                                             <?php } ?>
                                        <?php } else if ($reserve->getStatus() == "completed") { ?>
                                             <?php if ($_SESSION['type'] == 'D') { ?>
                                                  <a href=<?php echo FRONT_ROOT ?>Review/ShowAddView/<?php echo $reserve->getReserveid() ?> " class=" btn btn-warning btn-sm">Opinar</a>
                                             <?php } ?>
                                        <?php } else if ($reserve->getStatus() == "completed & reviewed") { ?>

                                        <?php } else if ($reserve->getStatus() == "canceled") { ?>

                                        <?php } ?>
                                   </td>

                              </tr>
                         <?php
                         }
                         ?>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>

<?php
require_once(VIEWS_PATH . "footer.php");
?>