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

                        //debe recibir la data de keeper desde ReserveController

                        // print_r($AvailableKeepers);
                        foreach ($AvailableUsers as $user) {

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

                                <td>
                                    <form action="<?php echo FRONT_ROOT ?>Reserve/Add/" method="post">
                                        <!--                                        con etiquetas hidden tendriamos que enviar al metodo Add la info del keeper que seleccione-->
                                        <input type="hidden" name="petid" value=<?php $pet->getPetid() ?>>
                                        <input type="hidden" name="daterange" value=<?php $daterange ?>>
                                        <!--                                        <input type="hidden" name="keeperid" value= --><?php //$keeper->getId() 
                                                                                                                                    ?>
                                        <!-- >-->
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