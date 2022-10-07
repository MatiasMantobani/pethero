<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de duenos</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Apellido</th>
                         <th>DNI</th>
                         <th>Direccion</th>
                         <th>Telefono</th>
                         <th>Email</th>
                         <th>Contraseña</th>
                         <th>Mascotas</th>
                         <th>Reservas</th>
                         <th>Pagos</th>
                         <th>Tipo de Usuario</th>
                         <th>Acciones</th>

                         </thead>
                    <tbody>
                         <?php
                              foreach($duenoList as $dueno)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $dueno->getFirstName() ?></td>
                                             <td><?php echo $dueno->getLastName() ?></td>
                                             <td><?php echo $dueno->getDNI() ?></td>
                                             <td><?php echo $dueno->getAdress() ?></td>
                                             <td><?php echo $dueno->getTelephone() ?></td>
                                             <td><?php echo $dueno->getEmail() ?></td>
                                             <td><?php echo $dueno->getPassword() ?></td>
                                             <td><?php echo $dueno->getMascotas() ?></td>
                                             <td><?php echo $dueno->getReservas() ?></td>
                                             <td><?php echo $dueno->getPagos() ?></td>
                                             <td><?php echo $dueno->getTipoDeUsuario() ?></td>
                                            <form action="<?php echo FRONT_ROOT."Dueno/Remove" ?>" method="">
                                                <td>
                                                    <button type="submit" name="dni" class="btn" value="<?php echo $dueno->getDni() ?>"> Remove </button>
                                                </td>
                                            </form>

                                             <!-- <td><?php //echo $dueno->getID() ?></td> -->
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