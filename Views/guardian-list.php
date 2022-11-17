<?php
    require_once(VIEWS_PATH."header.php");
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
                <th>Teléfono</th>
                <th>Email</th>
                <th>Perfil</th>
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
                        <td><a href="<?php echo FRONT_ROOT ?>User/ShowExternalProfile/<?php echo $user->getUserid() ?>" class="btn btn-primary btn-sm">Ver</a></td>
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