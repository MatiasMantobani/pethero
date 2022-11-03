<?php
require_once('nav.php');

use Controllers\UserController as UserController;
?>
<main class="py-5">

    <section id="listado" class="mb-5">
        <div class="container">

            <?php if ($AvailableDates != null) { ?>
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
            <?php } else { ?>
                <h2>Lo sentimos, no hay nadie que pueda cuidar a <?php echo $pet->getName() ?> en esa fecha</h2>
                <br>
                <!--                ver como centramos el boton de volver al inicio-->
                <a href="<?php echo FRONT_ROOT ?>User/ShowProfileView" class="btn btn-primary">Volver al inicio</a>
                <br>
                <br>
                <img src="<?php echo FRONT_ROOT ?>Views/img/keeper-no-disponible.png" class="rounded mx-auto d-block" alt="sad-dog">
            <?php } ?>



        </div>
    </section>
</main>