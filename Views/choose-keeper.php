<?php
require_once('nav.php');

use Controllers\UserController as UserController;
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">

            <?php if ($AvailableUsers != null) { ?>
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
                        <th>Contratar</th>

                    </thead>
                    <tbody>
                        <?php

                        //recibe AvailableUsers y AvailableKeepers desde reserve contoller metodo showAddView()
                        for ($i = 0; $i < count($AvailableUsers); $i++) {

                        ?>
                            <tr>

                                <td><?php echo $AvailableUsers[$i]->getName()
                                    ?>
                                </td>

                                <td><?php echo $AvailableUsers[$i]->getSurname()
                                    ?>
                                </td>

                                <td><?php echo $AvailableUsers[$i]->getPhone()
                                    ?>
                                </td>

                                <td><?php echo $AvailableUsers[$i]->getEmail()
                                    ?>
                                </td>

                                <td><?php echo $AvailableKeepers[$i]->getPricing()
                                    ?>
                                </td>

                                <td><?php echo $AvailableKeepers[$i]->getRating()
                                    ?>
                                </td>

                                <td>

                                    <form action="<?php echo FRONT_ROOT ?>Reserve/Add" method="post">
                                        <input type="hidden" name="petid" value=<?php echo $pet->getPetid() ?>>
                                        <input type="hidden" name="daterange" value=<?php echo $daterange ?>>
                                        <input type="hidden" name="userid" value=<?php echo $AvailableUsers[$i]->getUserid() ?>>

                                        <button type="submit" class="btn btn-success">Solicitar Reserva</button>
                                    </form>
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