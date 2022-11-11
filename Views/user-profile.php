<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">

            <?php if ($_SESSION['message'] != null) { ?>
                <div class="alert alert-primary" role="alert">
                    <?php echo $_SESSION['message'] ?>
                </div>
            <?php
                $_SESSION['message'] = null;
            } ?>

            <h2 class="mb-4">Bienvenid@ <?php echo $user->getName(); ?></h2>

            <div class="col col-lg-12 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem; border: #856404">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white" style="border-radius: .5rem;">

                            <?php if ($userImage != null) { ?>

                                <img src="<?php echo FRONT_ROOT . USER_UPLOADS_PATH . $userImage->getName() ?>" alt="Profile img" class="img-fluid my-5 rounded-circle" style="width: 200px;" />
                                <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>UserImage/ShowUploadView" class="btn btn-dark btn-sm">Cambiar
                                        foto</a></p>
                            <?php } else { ?>

                                <img src="<?php echo FRONT_ROOT ?>Views/img/profile/profile_default.png" alt="Profile img" class="img-fluid my-5 rounded-circle" style="width: 200px;" />
                                <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>UserImage/ShowUploadView" class="btn btn-dark btn-sm">Subir
                                        foto</a></p>
                            <?php } ?>

                            <h5><?php echo $user->getName(); ?> <?php echo $user->getSurname(); ?></h5>
                            <p><?php switch ($user->getType()) {
                                    case "G":
                                        echo "Guardian";
                                        break;
                                    case "D":
                                        echo "Dueño";
                                        break;
                                    case "A":
                                        echo "Admin";
                                        break;
                                } ?></p>
                            <i class="far fa-edit mb-5"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Perfíl</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted"><?php echo $user->getEmail() ?></p>
                                        <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>User/ShowUpdateView" class="btn btn-dark btn-sm">Cambiar
                                                datos</a></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Teléfono</h6>
                                        <p class="text-muted"><?php echo $user->getPhone() ?></p>
                                    </div>
                                </div>

                                <hr class="mt-0 mb-4">

                                <?php if ($adress) { ?>
                                    <h6>Direccion: </h6>
                                    <p class="text-muted"><?php echo $adress->getStreet() . " " . $adress->getNumber() . " Piso: " . $adress->getFloor() . " Depto: " . $adress->getDepartment() . " CP: " . $adress->getPostalcode() ?></p>
                                    <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>Adress/ShowAddView" class="btn btn-dark btn-sm">Cambiar
                                            dirección</a></p>
                                <?php } else { ?>
                                    <h6>Direccion: </h6>
                                    <p class="text-muted">No disponible <a href="<?php echo FRONT_ROOT ?>Adress/ShowAddView" class="btn btn-dark btn-sm">Cargar
                                            direccion</a></p>

                                <?php } ?>

                                <hr class="mt-0 mb-4">
                                <!-- FIN Parte Datos Personales -->

                                <!-- INICIO GUARDIAN -->
                                <?php if ($_SESSION['type'] == 'G') { ?>

                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Remuneración: </h6>
                                            <?php if ($keeper != null && $keeper->getPricing() > 0) { ?>
                                                <p class="text-muted"><?php echo $keeper->getPricing(); ?><a href="<?php echo FRONT_ROOT ?>Keeper/ShowUpdatePricingView" class="btn btn-dark btn-sm"> Cambiar</a></p>
                                            <?php } else { ?>
                                                <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>Keeper/ShowUpdatePricingView" class="btn btn-dark btn-sm">Cargar tarifa</a></p>
                                            <?php } ?>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Valoración:</h6>
                                            <?php if ($keeper != null) { ?>
                                                <p class="text-muted">Comunidad: <?php echo $keeper->getRating(); ?></p>
                                            <?php } else { ?>
                                                <p class="text-muted">Error cargando reputación </p>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <hr class="mt-0 mb-4">

                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <?php if ($size) { ?>
                                                <h6>Tamaños aceptados: </h6>
                                                <p class="text-muted"><?php if ($size->getSmall() == true) echo "[S] ";
                                                                        if ($size->getMedium() == true) echo "[M] ";
                                                                        if ($size->getLarge() == true) echo "[L] "; ?> <a href="<?php echo FRONT_ROOT ?>Size/ShowAddView">[Editar]</a></p>
                                            <?php } else { ?>
                                                <h6>Tamaños aceptados: </h6>
                                                <p class="text-muted">No disponible <a href="<?php echo FRONT_ROOT ?>Size/ShowAddView">[Cargar
                                                        ahora]</a></p>
                                            <?php } ?>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Fechas disponibles:</h6>
                                            <?php if ($fechas != null) { ?>
                                                <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>AvailableDate/ShowAddView">[Editar disponibilidad]</a></p>
                                            <?php } else { ?>
                                                <p class="text-muted">No tenes disponibilidad <a href="<?php echo FRONT_ROOT ?>AvailableDate/ShowAddView"><br>[Cargar disponibilidad]</a></p>
                                            <?php } ?>
                                        </div>
                                    </div>


                                    <hr class="mt-0 mb-4">
                                <?php } ?>
                                <!-- FIN GUARDIAN -->

                                <!-- DUEÑO  -->
                                <?php if($_SESSION['type'] == 'D'){ ?>
                                    <div class="row pt-1">

                                        <div class="col-6 mb-3">
                                            <a href="<?php echo FRONT_ROOT ?>#" class="btn btn-primary btn-lg">Ver mis mascotas</a>
                                        </div>
                                        <div class="row pt-1">
                                            <div class="col-6 mb-3">
                                                <a href="<?php echo FRONT_ROOT ?>Reserve/ShowAddView/" class="btn btn-primary btn-lg">Solicitar reserva</a>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mt-0 mb-4">
                                <?php } ?>
                                <!-- FIN DUEÑO -->



                                <!-- PARA AMBOS -->
                                <div class="row pt-1">

                                    <div class="col-6 mb-3">
                                        <h6>Ver mis Reservas</h6>

                                        <form action="<?php echo FRONT_ROOT ?>Reserve/ShowReservesView" method="post" class="bg-light-alpha p-1">

                                            <select class="form-control" name="pseudostatus" required>
                                                <option value="Todas">Todas</option>
                                                <option value="En Espera">En Espera</option>
                                                <option value="Confirmadas">Confirmadas</option>
                                                <option value="Rechazadas">Rechazadas</option>
                                                <option value="Pagadas">Pagadas</option>
                                                <option value="En Progreso">En Progreso</option>
                                                <option value="Completadas">Completadas</option>
                                                <option value="Canceladas">Canceladas</option>
                                            </select>

                                            <button type="submit" class="btn btn-dark ml-auto d-block m-1">Ir</button>
                                        </form>


                                    </div>

                                    <div class="col-6 mb-3">
                                        <h6>Ver mis pagos</h6>
                                        <p class="text-muted">Dolor sit amet</p>
                                    </div>
                                </div>

                                <hr class="mt-0 mb-4">

                                <div class="row pt-1">

                                    <div class="col-6 mb-3">
                                        <h6>Most Viewed</h6>
                                        <p class="text-muted">Dolor sit amet</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Most Viewed</h6>
                                        <p class="text-muted">Dolor sit amet</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <!-- SI ES DUEÑO -->
            <?php if ($_SESSION['type'] == 'D') { ?>

                <h2 class="mb-4">Mis mascotas</h2>
                <table class="table bg-light-alpha">
                    <thead>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Raza</th>
                        <th>Nombre</th>
                        <th>Tamaño</th>
                        <th>Perfil</th>
                        <th>Reserva</th>
                    </thead>
                    <tbody>
                        <?php if ($petList != null) {
                            foreach ($petList as $pet) {
                                if ($pet->getStatus() == 1) { ?>
                                    <?php $breed = $breedController->getByBreedId($pet->getBreedid()); ?>
                                    <tr>
                                        <td><?php echo $pet->getPetid() ?></td>
                                        <td><?php switch ($breed->getType()) {
                                                case 1:
                                                    echo "Gato";
                                                    break;
                                                case "2":
                                                    echo "Perro";
                                                    break;
                                            } ?></td>
                                        <td><?php echo $breed->getName() ?></td>
                                        <td><?php echo $pet->getName() ?></td>
                                        <td><?php switch ($breed->getSize()) {
                                                case 1:
                                                    echo "Pequeño";
                                                    break;
                                                case 2:
                                                    echo "Mediano";
                                                    break;
                                                case 3:
                                                    echo "Grande";
                                                    break;
                                            } ?></td>
                                        <td>
                                            <a href="<?php echo FRONT_ROOT ?>Pet/ShowProfileView/<?php echo $pet->getPetid() ?>" class="btn btn-primary btn-sm">Ver
                                                perfil</a>
                                        </td>
                                        <td>

                                            <a href="<?php echo FRONT_ROOT ?>Reserve/ShowAddView/<?php echo $pet->getPetid() ?>" class="btn btn-primary btn-sm">Solicitar Reserva</a>
                                        </td>
                                    </tr>
                        <?php }
                            }
                        } ?>
                        </tr>
                    </tbody>
                </table>

                <div class="col-md-12 text-right">
                    <a href="<?php echo FRONT_ROOT ?>Pet/ShowPreAddView/" class="btn btn-secondary">Agregar mascota</a>
                </div>

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
                        foreach ($userList as $user) {
                            if ($user->getType() == "G") {
                        ?>
                                <tr>
                                    <td><?php echo $user->getName() ?></td>
                                    <td><?php echo $user->getSurname() ?></td>
                                    <td><?php echo $user->getPhone() ?></td>
                                    <td><?php echo $user->getEmail() ?></td>
                                    <td>Accion ID <?php echo $user->getUserid() ?></td>

                                </tr>
                        <?php }
                        } ?>
                        </tr>
                    </tbody>
                </table>


            <?php } ?>

            <!-- SI ES GUARDIAN -->
            <?php if ($_SESSION['type'] == 'G') { ?>
                <h2 class="mb-4">Tus Fechas Disponibles</h2>

                <table class="table bg-light-alpha">
                    <thead>
                        <th>Available Dates Id</th>
                        <th>User Id</th>
                        <th>Available</th>
                        <th>Fecha</th>

                    </thead>
                    <tbody>
                        <?php
                        foreach ($fechas as $fecha) {
                        ?>
                            <tr>
                                <td><?php echo $fecha->getAvailableDateId() ?></td>
                                <td><?php echo $fecha->getUserid() ?></td>
                                <td><?php echo $fecha->getAvailable() ?></td>
                                <td><?php echo $fecha->getDate() ?></td>

                            </tr>
                        <?php }
                        ?>
                        </tr>
                    </tbody>
                </table>


            <?php } ?>


            <!-- PARA GUARDIANES Y DUEÑOS -->

            <!-- LISTADO DE RESERVAS -->
            <h2 class="mb-4">Listado de Reservas</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <th>ReservaID</th>
                    <th>Emisor</th>
                    <th>Receptor</th>
                    <th>PetID</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>MontoTotal</th>
                    <th>Estado</th>

                    <!-- Columnas para Guardian -->
                    <?php if ($_SESSION['type'] == 'G') { ?>
                        <th>Confirmar</th>
                        <th>Rechazar</th>
                        <th>Eliminar</th>

                        <!-- Columnas para Dueño -->
                    <?php } else { ?>
                        <th>Pagar</th>
                        <th>Cancelar</th>
                    <?php } ?>
                </thead>
                <tbody>
                    <?php
                    foreach ($reserveList as $reserva) {

                    ?>
                        <tr>
                            <!-- Datos en comun para Dueño y Guardian -->
                            <td><?php echo $reserva->getReserveid() ?></td>
                            <td><?php echo $reserva->getTransmitterid() ?></td>
                            <td><?php echo $reserva->getReceiverid() ?></td>
                            <td><?php echo $reserva->getPetid() ?></td>
                            <td><?php echo $reserva->getFirstdate() ?></td>
                            <td><?php echo $reserva->getLastdate() ?></td>
                            <td><?php echo $reserva->getAmount() ?></td>
                            <td><?php echo $reserva->getStatus() ?></td>


                            <!-- Todos los estados para Dueño -->
                            <?php if ($_SESSION['type'] == 'G') { ?>

                                <?php if ($reserva->getStatus() == "await") { ?>
                                    <td><a href="<?php echo FRONT_ROOT ?>Reserve/AcceptReserve/<?php echo $reserva->getReserveid() ?>" class="btn btn-primary btn-sm">Aceptar Reserva</a></td>
                                    <td><a href="<?php echo FRONT_ROOT ?>Reserve/RejectReserve/<?php echo $reserva->getReserveid() ?>" class="btn btn-warning btn-sm">Rechazar Reserva</a></td>
                                    <td><a href="<?php echo FRONT_ROOT ?>Reserve/CancelReserve/<?php echo $reserva->getReserveid() ?>" class="btn btn-danger btn-sm">Eliminar Reserva</a></td>

                                <?php } else if ($reserva->getStatus() == "confirmed") { ?>
                                    <td><button class="btn btn-primary btn-sm" disabled>Aceptar Reserva</button></td>
                                    <td><button class="btn btn-primary btn-sm" disabled>Rechazar Reserva</button></td>
                                    <td><a href="<?php echo FRONT_ROOT ?>Reserve/CancelReserve/<?php echo $reserva->getReserveid() ?>" class="btn btn-danger btn-sm">Eliminar Reserva</a></td>

                                <?php } else if ($reserva->getStatus() == "payed") { ?>

                                <?php } else if ($reserva->getStatus() == "rejected") { ?>

                                <?php } else if ($reserva->getStatus() == "in progress") { ?>

                                <?php } else if ($reserva->getStatus() == "completed") { ?>

                                <?php } else if ($reserva->getStatus() == "canceled") { ?>

                                <?php } ?>

                            <?php } ?>

                            <!-- Todos los estados para Dueño -->
                            <?php if ($_SESSION['type'] == 'D') { ?>
                                <?php if ($reserva->getStatus() == "await") { ?>
                                    <td><button class="btn btn-primary btn-sm" disabled>Pagar Reserva</button></td>
                                    <td><a href="<?php echo FRONT_ROOT ?>Reserve/CancelReserve/<?php echo $reserva->getReserveid() ?>" class="btn btn-danger btn-sm">Eliminar Reserva</a></td>

                                <?php } else if ($reserva->getStatus() == "confirmed") { ?>
                                    <td><a href="<?php echo FRONT_ROOT ?>Reserve/PayReserve/<?php echo $reserva->getReserveid() ?>" class="btn btn-primary btn-sm">Pagar Reserva</a></td>
                                    <td><a href="<?php echo FRONT_ROOT ?>Reserve/CancelReserve/<?php echo $reserva->getReserveid() ?>" class="btn btn-danger btn-sm">Eliminar Reserva</a></td>

                                <?php } else if ($reserva->getStatus() == "rejected") { ?>


                                <?php } else if ($reserva->getStatus() == "payed") { ?>
                                    <td><button class="btn btn-primary btn-sm" disabled>Pagar Reserva</button></td>
                                    <td><button class="btn btn-primary btn-sm" disabled>Eliminar Reserva</button></td>

                                <?php } else if ($reserva->getStatus() == "in progress") { ?>

                                <?php } else if ($reserva->getStatus() == "completed") { ?>
                                    <td><a href=<?php echo FRONT_ROOT ?>Review/ShowAddView/<?php echo $reserva->getReserveid() ?> " class=" btn btn-warning btn-sm">Opinar</a></td>
                                <?php } else if ($reserva->getStatus() == "canceled") { ?>

                                <?php } ?>

                            <?php } ?>

                        </tr>
                    <?php
                    }
                    ?>

                    </tr>
                </tbody>
            </table>

            <?php if($_SESSION['type'] == 'D'){ ?>
            <div class="col-md-12 text-right">
                <a href="<?php echo FRONT_ROOT ?>Reserve/ShowAddView" class="btn btn-secondary">Agregar reserva</a>
            </div>
            <?php } ?>

            <h2 class="mb-4">Tus Pagos</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <th>Pago ID</th>
                    <th>Emisor ID</th>
                    <th>Receptor ID</th>
                    <th>Reserva ID</th>
                    <th>Monto</th>
                    <th>QR</th>
                    <th>Fecha</th>
                    <th>Pagado</th>

                </thead>
                <tbody>
                    <?php
                    foreach ($pagos as $pago) {
                    ?>
                        <tr>
                            <td><?php echo $pago->getPaymentid()
                                ?></td>
                            <td><?php echo $pago->getTransmitterid()
                                ?></td>
                            <td><?php echo $pago->getReceiverid()
                                ?></td>
                            <td><?php echo $pago->getReserveid()
                                ?></td>
                            <td><?php echo $pago->getMonto()
                                ?></td>
                            <td><?php echo $pago->getQr() ?></td>
                            <td><?php echo $pago->getDate() ?></td>
                            <td><?php echo $pago->getPayed() ?></td>

                        </tr>
                    <?php } ?>
                    </tr>
                </tbody>
            </table>


        </div>
    </section>
</main>