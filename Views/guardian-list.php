<?php
require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Guardianes</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Apellido</th>
                         <th>DNI</th>
                         <th>Direccion</th>
                         <th>Telefono</th>
                         <th>Email</th>
                         <th>Contraseña</th>
                         <th>Cuil</th>
                         <th>Remuneracion</th>
                         <th>Tamano de las mascotas</th>
                         <th>Disponibilidad</th>
                         <th>Reservas</th>
                         <th>Reviews</th>
                         <th>Tipo de Usuario</th>
                         <th>Acciones</th>
                         <!-- <th>ID</th>          Despues habria que sacarlo al ID -->

                    </thead>
                    <tbody>
                         <?php
                         foreach ($guardianList as $guardian) {
                         ?>
                              <tr>
                                   <td><?php echo $guardian->getFirstName() ?></td>
                                   <td><?php echo $guardian->getLastName() ?></td>
                                   <td><?php echo $guardian->getDNI() ?></td>
                                   <td><?php echo $guardian->getAdress() ?></td>
                                   <td><?php echo $guardian->getTelephone() ?></td>
                                   <td><?php echo $guardian->getEmail() ?></td>
                                   <td><?php echo $guardian->getPassword() ?></td>
                                   <td><?php echo $guardian->getCuil() ?></td>
                                   <td><?php echo $guardian->getRemuneracion() ?></td>
                                   <td><?php echo $guardian->getTamanoDeMascota() ?></td>
                                   <td><?php echo $guardian->getDisponibilidad() ?></td>
                                   <td><?php echo $guardian->getReservas() ?></td>
                                   <td><?php echo $guardian->getReviews() ?></td>
                                   <td><?php echo $guardian->getTipoDeUsuario() ?></td>
                                  <form action="<?php echo FRONT_ROOT."Guardian/Remove" ?>" method="">
                                      <td>
                                          <button type="submit" name="dni" class="btn" value="<?php echo $guardian->getDni() ?>"> Remove </button>
                                      </td>
                                  </form>

                                   <!-- <td><?php //echo $guardian->getID() 
                                             ?></td> -->
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