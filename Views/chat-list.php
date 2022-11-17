<?php
    require_once(VIEWS_PATH."header.php");
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
                <h2 class="mb-4">Todos los chats </h2>
                <table class="table bg-light">
                    <thead>
                    <th>Usuario</th>
                    <th>Accion</th>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($userList as $user) {
                        ?>
                        <tr>
                            <td><?php echo $user->getName() . " " . $user->getSurname()  ?></td>
                            <td>
                                <a href="<?php echo FRONT_ROOT ?>Chat/ShowAddView/<?php echo $user->getUserid() ?>" class="btn btn-success btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"></path>
                                    </svg>
                                    Ir al chat
                                </a>
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
    require_once(VIEWS_PATH."footer.php");
?>