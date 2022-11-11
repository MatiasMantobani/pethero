<?php
require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">


          <?php if($reserveList){ ?>


               <h2 class="mb-4"> Tus Reservas <?php echo $pseudostatus ?> </h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>ReservaID</th>
                         <th>Emisor</th>
                         <th>Receptor</th>
                         <th>PetID</th>
                         <th>Fecha Inicio</th>
                         <th>Fecha Fin</th>
                         <th>MontoTotal</th>
                         <th>Estado</th>
                    </thead>
                    <tbody>
                         <?php
                         foreach ($reserveList as $reserve) {
                         ?>
                              <tr>
                                   <td><?php echo $reserve->getReserveid() ?></td>
                                   <td><?php echo $reserve->getTransmitterid() ?></td>
                                   <td><?php echo $reserve->getReceiverid() ?></td>
                                   <td><?php echo $reserve->getPetid() ?></td>
                                   <td><?php echo $reserve->getFirstdate() ?></td>
                                   <td><?php echo $reserve->getLastdate() ?></td>
                                   <td><?php echo $reserve->getAmount() ?></td>
                                   <td><?php echo $reserve->getStatus() ?></td>
                              </tr>
                         <?php
                         }
                         ?>
                         </tr>
                    </tbody>
               </table>

               <?php } else{
                    echo "Nos hacemos pija imbecil";
               }?>


          </div>
     </section>
</main>