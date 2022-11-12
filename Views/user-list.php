<?php
     require_once(VIEWS_PATH."header.php");
     require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de usuarios</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>ID</th>
                         <th>Email</th>
                         <th>Password</th>
                         <th>Tipo</th>
                         <th>DNI</th>
                         <th>CUIT</th>
                         <th>Nombre</th>
                         <th>Apellido</th>
                         <th>Telefono</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($userList as $user)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $user->getUserid() ?></td>
                                             <td><?php echo $user->getEmail() ?></td>
                                             <td><?php echo $user->getPassword() ?></td>
                                             <td><?php echo $user->getType() ?></td>
                                             <td><?php echo $user->getDni() ?></td>
                                             <td><?php echo $user->getCuit() ?></td>
                                             <td><?php echo $user->getName() ?></td>
                                             <td><?php echo $user->getSurname() ?></td>
                                             <td><?php echo $user->getPhone() ?></td>
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
    require_once(VIEWS_PATH."footer.php");
?>