<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de guardianes</h2>
            <table class="table bg-light-alpha">
                <thead>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Contratar</th>
                </thead>
                <tbody>
                <?php
                foreach ($guardianList as $user) {
                    ?>
                    <tr>
                        <td><?php echo $user->getName() ?></td>
                        <td><?php echo $user->getSurname() ?></td>
                        <td><?php echo $user->getPhone() ?></td>
                        <td><?php echo $user->getEmail() ?></td>
                        <td>Accion ID <?php echo $user->getId() ?></td>

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