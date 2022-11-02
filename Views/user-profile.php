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

                                <img src="<?php echo FRONT_ROOT . USER_UPLOADS_PATH . $userImage->getName() ?>" alt="Profile img" class="img-fluid my-5 rounded" style="width: 200px;" />

                            <?php } else { ?>

                                <img src="<?php echo FRONT_ROOT ?>Views/img/profile/profile_default.png" alt="Profile img" class="img-fluid my-5 rounded" style="width: 200px;" />
                                <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>UserImage/ShowUploadView">[Subir foto]</a></p>
                            <?php } ?>

                            <h5><?php echo $user->getName(); ?></h5>
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
                                <h6>Información</h6>

                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted"><?php echo $user->getEmail() ?></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Teléfono</h6>
                                        <p class="text-muted"><?php echo $user->getPhone() ?></p>
                                    </div>
                                </div>

                                <?php if ($adress) { ?>
                                    <h6>
                                        Direccion: </h6>
                                    <p class="text-muted"><?php echo $adress->getStreet() . " " . $adress->getNumber() . " Piso: " . $adress->getFloor() . " Depto: " . $adress->getDepartment() . " CP: " . $adress->getPostalcode() ?>
                                        <a href="<?php echo FRONT_ROOT ?>Adress/ShowAddView">[Editar]</a>
                                    </p>

                                <?php } else { ?>
                                    <h6>Direccion: </h6>
                                    <p class="text-muted">No disponible <a href="<?php echo FRONT_ROOT ?>Adress/ShowAddView">[Cargar
                                            direccion]</a></p>

                                <?php } ?>

                                <hr class="mt-0 mb-4">

                                <!-- GUARDIAN -->

                                <?php if ($_SESSION['type'] == 'G') { ?>
                                    <?php if ($size) { ?>
                                        <h6>Tamaños aceptados: </h6>
                                        <p class="text-muted"><?php if ($size->getSmall() == true) echo "[Pequeños]";
                                            if ($size->getMedium() == true) echo "[Medianos] ";
                                            if ($size->getLarge() == true) echo "[Grandes] "; ?> <a href="<?php echo FRONT_ROOT ?>Size/ShowAddView">[Editar]</a></p>

                                    <?php } else { ?>
                                        <h6>Tamaños aceptados: </h6>
                                        <p class="text-muted">No disponible <a href="<?php echo FRONT_ROOT ?>Size/ShowAddView">[Cargar
                                                ahora]</a></p>
                                    <?php } ?>


                                    <!-- FECHAS DISPONIBLES -->
                                    <hr class="mt-0 mb-4">

                                    <h6>Fechas Disponibles:</h6>
                                    <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>AvailableDate/ShowAddView/">[Modificar ahora]</a></p>

                                    <hr class="mt-0 mb-4">




                                <?php } ?>


                                <!-- DUEÑO -->

                                <?php if ($_SESSION['type'] == 'D') { ?>

                                    <!-- REALIZAR RESERVAS -->
                                    <p><a href="<?php echo FRONT_ROOT ?>#">[REALIZAR RESERVA]</a></p>
                                    <hr class="mt-0 mb-4">

                                <?php } ?>

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
                                <div class="d-flex justify-content-start">
                                    <a href="#!">Accion <i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                    <a href="#!">Accion <i class="fab fa-twitter fa-lg me-3"></i></a>
                                    <a href="#!">Accion<i class="fab fa-instagram fa-lg"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            
            <?php if ($_SESSION['type'] == 'D') { ?>
                                <!-- LISTADO DE FECHAS Y ALGO MAS -->

                <h2 class="mb-4">LISTADO DE FECHAS Y ALGO MAS</h2>
                <table class="table bg-light-alpha">
                    <thead>
                    <th>ADateId</th>
                    <th>UserId</th>
                    <th>Breed</th>
                    <th>Fecha</th>
                    </thead>
                    <tbody>
                    <?php
                    if ($consultaList)
                    {
                    foreach ($consultaList as $consulta) {
                        
                            ?>
                            <tr>
                            <td><?php echo $consulta->getAvailableDateId() ?></td>
                            <td><?php echo $consulta->getUserid() ?></td>
                            <td><?php echo $consulta->getAvailable() ?></td>
                            <td><?php echo $consulta->getDate() ?></td>

                            </tr>
                        <?php 
                    }
                    } ?>
                    </tr>
                    </tbody>
                </table>
                <!-- LISTADO DE RESERVAS -->
                <h2 class="mb-4">Listado de Reservas</h2>
                <table class="table bg-light-alpha">
                    <thead>
                        <th>ReservaID</th>
                        <th>Emisor</th>
                        <th>Receptor</th>
                        <th>isConfirmada</th>
                        <th>MontoTotal</th>
                        <th>PagoID</th>
                        <th>isPaga</th>
                        <th>isCompletada</th>
                        <th>PetID</th>
                        <th>Fecha</th>
                    </thead>
                    <tbody>
                        <?php
                        // foreach ($reservaList as $reserva) {
                            
                        ?>
                                <tr>
                                    <td><?php echo "#" ?></td>
                                

                                </tr>
                        <?php 

                        //} ?>

                        </tr>
                    </tbody>
                </table>

                <h2 class="mb-4">Listado de mascotas</h2>
                <table class="table bg-light-alpha">
                    <thead>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Raza</th>
                    <th>Nombre</th>
                    <th>Tamaño</th>
                    <th>Perfil</th>
                    </thead>
                    <tbody>
                    <?php if ($petList != null) {
                        foreach ($petList as $pet) { ?>
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
                                    <a href="<?php echo FRONT_ROOT ?>Pet/ShowProfileView/<?php echo $pet->getPetid() ?>">Ver
                                        perfil</a>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                    </tr>
                    </tbody>
                </table>

                <p><a href="<?php echo FRONT_ROOT ?>Pet/ShowPreAddView/">[Cargar nueva mascota ahora]</a></p>

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

        </div>
    </section>
</main>