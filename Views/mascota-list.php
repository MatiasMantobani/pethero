<?php


use Models\Dueno as Dueno;
require_once(VIEWS_PATH."nav.php");

?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Mascotas</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Mascota</th>
                         <th>Foto</th>
                         <th>Foto Carnet</th>
                         <th>Observaciones</th>
                         <th>Raza</th>
                         <th>Tamaño</th>
                         <th>Video Opcional</th>


                    </thead>
                    <tbody>
                         <?php
                         $dueno = new Dueno();
                         $dueno = unserialize($_SESSION["loggedUser"]);

                         foreach ($mascotaList as $mascota) {
                         ?>

                              <?php

                              if ($dueno->getTipoDeUsuario() == 0 || $dueno->getDni() == $mascota->getIdDueno()) {   ?>
                                   <tr>
                                        <td><?php echo $mascota->getPetName() ?></td>
                                        <td><?php echo $mascota->getFoto() ?></td>
                                        <td><?php echo $mascota->getCarnetVacunas() ?></td>
                                        <td><?php echo $mascota->getObservaciones() ?></td>
                                        <td><?php echo $mascota->getRaza() ?></td>
                                        <td><?php echo $mascota->getTamano() ?></td>
                                        <td><?php echo $mascota->getVideo() ?></td>

                                   </tr>

                              <?php } ?>

                         <?php
                         }
                         ?>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>