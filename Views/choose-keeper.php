<?php
require_once('nav.php');

use Controllers\UserController as UserController;
?>
<main class="py-5">

    <section id="listado" class="mb-5">
        <div class="container">
            <h2>Los siguientes Guardianes estan disponibles para cuidar a <?php echo $pet->getName() ?> </h2>
            <br>

            <!-- Aca filtramos a los keepers segun el daterange y la raza que esta cuidando actualmente-->

            <table class="table bg-light-alpha">
                <thead>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Precio</th>
                    <th>Rating</th>
                    <th>Fecha Disponible</th>

                    <th>Contratar</th>
                </thead>
                <tbody>
                    <?php
                    $UserController = new UserController();
                    foreach ($AvailableDates as $availableDate) {
                    ?>
                        <?php
                        //crear los usuarios y guardianes por availableDate->userid
                        $user = $UserController->GetUserById($availableDate->getUserid());
                        ?>
                        <tr>

                            <td><?php echo $user->getName()
                                ?>
                            </td>

                            <td><?php echo $user->getSurname()
                                ?>
                            </td>

                            <td><?php echo $user->getPhone()
                                ?>
                            </td>

                            <td><?php echo $user->getEmail()
                                ?>
                            </td>

                            <td><?php //echo $keeper->getPrecio()   //de keeper
                                ?>
                            </td>

                            <td><?php //echo $keeper->getRating()   //de keeper
                                ?>
                            </td>

                            <td><?php echo $availableDate->getDate()
                                ?>
                            </td>

                            <td>Accion ID<?php echo $availableDate->getUserid()
                                            ?>
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