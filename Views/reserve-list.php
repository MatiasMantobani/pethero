<?php
require_once(VIEWS_PATH . "header.php");
require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4"> Tus Reservas <?php echo "(" . $pseudostatus . ")" ?> </h2>
               <table class="table bg-light">
                    <thead>
                         <?php if($_SESSION["type"] == "D"){ ?>
                         <th>Guardian</th>
                         <?php } ?>
                         <th>Mascota</th>
                         <th>Fecha de inicio</th>
                         <th>Fecha de fin</th>
                         <th>Monto total</th>
                         <th>Estado</th>
                         <th>Accion</th>
                    </thead>
                    <tbody>
                         <?php for($i = 0; $i < count($reserveList); $i++) {?>
                              <tr>
                                  <?php if($_SESSION["type"] == "D"){ ?>
                                      <td><a href="<?php echo FRONT_ROOT ?>User/ShowExternalProfile/<?php echo $reserveList[$i]->getReceiverid() ?>" class="btn btn-primary btn-sm"> <?php echo $keeperInfo[$i] ?> </a></td>
                                  <?php } ?>

                                   <td><a href="<?php echo FRONT_ROOT ?>Pet/ShowProfileView/<?php echo $reserveList[$i]->getPetid() ?>" class="btn btn-primary btn-sm"><?php echo $petInfo[$i] ?></a></td>
                                   <td><?php echo $reserveList[$i]->getFirstdate() ?></td>
                                   <td><?php echo $reserveList[$i]->getLastdate() ?></td>
                                   <td><?php echo "$" . $reserveList[$i]->getAmount() ?></td>
                                   <td><?php switch ($reserveList[$i]->getStatus()) {
                                           case "await":
                                               echo "Esperando confirmaciôn";
                                               break;
                                           case "confirmed":
                                               echo "Confirmado";
                                               break;
                                           case "rejected":
                                               echo "Rechazado";
                                               break;
                                           case "payed":
                                               echo "Pagado";
                                               break;
                                           case "in progress":
                                               echo "En proceso";
                                               break;
                                           case "completed":
                                               echo "Completado";
                                               break;
                                           case "completed & reviewed":
                                               echo "Completado y calificado";
                                               break;
                                           case "canceled":
                                               echo "Cancelado";
                                               break;
                                       } ?></td>
                                   <td>
                                        <?php if ($reserveList[$i]->getStatus() == "await") { ?>

                                             <?php if ($_SESSION['type'] == 'G') { ?>
                                                  <a href="<?php echo FRONT_ROOT ?>Reserve/AcceptReserve/<?php echo $reserveList[$i]->getReserveid() ?>" class="btn btn-success btn-sm">Aceptar Reserva</a>
                                                  <br>
                                                  <br>
                                                  <a href="<?php echo FRONT_ROOT ?>Reserve/RejectReserve/<?php echo $reserveList[$i]->getReserveid() ?>" class="btn btn-danger btn-sm">Rechazar Reserva</a>
                                             <?php } ?>

                                        <?php } else if ($reserveList[$i]->getStatus() == "confirmed") { ?>

                                             <?php if ($_SESSION['type'] == 'D') { ?>
                                                  <a href="<?php echo FRONT_ROOT ?>Reserve/PayReserve/<?php echo $reserveList[$i]->getReserveid() ?>" class="btn btn-success btn-sm">Pagar Reserva</a>
                                             <?php } ?>

                                        <?php } else if ($reserveList[$i]->getStatus() == "rejected") { ?>

                                        <?php } else if ($reserveList[$i]->getStatus() == "payed") { ?>

                                             <?php if ($_SESSION['type'] == 'G') { ?>
                                                  <a href="<?php echo FRONT_ROOT ?>Reserve/CheckInPet/<?php echo $reserveList[$i]->getReserveid() ?>" class="btn btn-success btn-sm">Marcar Ingreso</a>
                                             <?php } ?>

                                        <?php } else if ($reserveList[$i]->getStatus() == "in progress") { ?>
                                             <?php if ($_SESSION['type'] == 'D') { ?>
                                                  <a href="<?php echo FRONT_ROOT ?>Reserve/PickUpPet/<?php echo $reserveList[$i]->getReserveid() ?>" class="btn btn-success btn-sm">Marcar Retiro</a>
                                             <?php } ?>
                                        <?php } else if ($reserveList[$i]->getStatus() == "completed") { ?>
                                             <?php if ($_SESSION['type'] == 'D') { ?>
                                                  <a href=<?php echo FRONT_ROOT ?>Review/ShowAddView/<?php echo $reserveList[$i]->getReserveid() ?> " class=" btn btn-warning btn-sm">Opinar</a>
                                             <?php } ?>
                                        <?php } else if ($reserveList[$i]->getStatus() == "completed & reviewed") { ?>

                                        <?php } else if ($reserveList[$i]->getStatus() == "canceled") { ?>

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