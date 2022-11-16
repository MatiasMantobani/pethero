<?php
require_once(VIEWS_PATH . "header.php");
require_once('nav.php');
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">

            <?php if ($_SESSION['message'] != null) {
                foreach ($_SESSION['message'] as $alert) { ?>
                    <div class="alert alert-primary" role="alert">
                        <?php if ($alert != "") {
                            echo $alert;
                        } ?>
                    </div>
            <?php }
                $_SESSION['message'] = null;
                $_SESSION['message'] = [];
            } ?>

            <h2 class="mb-4">Bienvenid@ <?php echo $user->getName(); ?></h2>

            <div class="col col-lg-12 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem; border: #856404">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white" style="border-radius: .5rem;">

                            <?php if ($userImage != null) { ?>

                                <img src="<?php echo FRONT_ROOT . USER_UPLOADS_PATH . $userImage->getName() ?>" alt="Profile img" class="img-fluid my-5 rounded-circle" style="width: 200px;" />
                                <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>UserImage/ShowUploadView" class="btn btn-dark btn-sm">Editar foto <i class="far fa-edit"></i></a></p>
                            <?php } else { ?>

                                <img src="<?php echo FRONT_ROOT ?>Views/img/profile/profile_default.png" alt="Profile img" class="img-fluid my-5 rounded-circle" style="width: 200px;" />
                                <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>UserImage/ShowUploadView" class="btn btn-dark btn-sm">Subir foto</a></p>
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
                            <?php if ($user->getType() == "G") { ?>
                                <h5 style="color: black">Valoración:</h5>
                                <?php if ($keeper != null) { ?>
                                    <p style="font-size: larger; color: black"><?php echo round($finalRating, 2) ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                    </p>
                                    <a href="<?php echo FRONT_ROOT ?>Review/ShowReviewList/<?php echo $user->getUserid() ?>">Ver todas las reviews</a>
                                <?php } else { ?>
                                    <p class="text-muted">Error al cargar tu reputación </p>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted"><?php echo $user->getEmail() ?></p>
                                        <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>User/ShowUpdateView" class="btn btn-dark btn-sm">Editar datos <i class="far fa-edit"></i></a></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Teléfono</h6>
                                        <p class="text-muted"><?php echo $user->getPhone() ?></p>
                                    </div>
                                </div>

                                <hr class="mt-0 mb-4">

                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <?php if ($adress) { ?>
                                            <h6>Direccion: </h6>
                                            <p class="text-muted"><?php echo $adress->getStreet() . " " . $adress->getNumber() . " Piso: " . $adress->getFloor() . " Depto: " . $adress->getDepartment() . " CP: " . $adress->getPostalcode() ?></p>
                                            <h6></h6>
                                            <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>Adress/ShowAddView" class="btn btn-dark btn-sm">Editar dirección <i class="far fa-edit"></i></a></p>
                                        <?php } else { ?>
                                            <h6>Direccion no disponible: </h6>
                                            <a href="<?php echo FRONT_ROOT ?>Adress/ShowAddView" class="btn btn-dark btn-sm">Cargar direccion</a>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <?php if ($_SESSION['type'] == 'G') { ?>
                                            <h6>Editar disponibilidad: </h6>

                                            <?php if ($unicaFecha) { ?>
                                                <p class="text-muted"><?php echo "Solo el: " . $unicaFecha ?></p>
                                            <?php } else if ($firstDate) { ?>
                                                <p class="text-muted"><?php echo "Del " . $firstDate . " al " . $lastDate ?></p>
                                            <?php } else { ?>
                                                <p class="text-muted">Sin Fechas Disponibles Cargadas</p>
                                            <?php } ?>

                                            <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>AvailableDate/ShowAddView" class="btn btn-dark btn-sm">Editar disponibilidad <i class="far fa-edit"></i></a></p>
                                        <?php } ?>
                                    </div>
                                </div>

                                <hr class="mt-0 mb-4">
                                <!-- FIN Parte Datos Personales -->

                                <!-- INICIO GUARDIAN -->
                                <?php if ($_SESSION['type'] == 'G') { ?>

                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Remuneración: </h6>
                                            <?php if ($keeper != null && $keeper->getPricing() > 0) { ?>
                                                <p class="text-muted"><?php echo $keeper->getPricing(); ?>
                                                    <br>
                                                    <a href="<?php echo FRONT_ROOT ?>Keeper/ShowUpdatePricingView" class="btn btn-dark btn-sm">Editar Remuneracion <i class="far fa-edit"></i></a>
                                                </p>
                                            <?php } else { ?>
                                                <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>Keeper/ShowUpdatePricingView" class="btn btn-dark btn-sm">Cargar tarifa</a></p>
                                            <?php } ?>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <?php if ($size) { ?>
                                                <h6>Tamaños aceptados: </h6>
                                                <p class="text-muted"><?php if ($size->getSmall() == true) echo "[S] ";
                                                                        if ($size->getMedium() == true) echo "[M] ";
                                                                        if ($size->getLarge() == true) echo "[L] "; ?>
                                                    <br>
                                                    <a href="<?php echo FRONT_ROOT ?>Size/ShowAddView" class="btn btn-dark btn-sm">Editar Tamaños Aceptados <i class="far fa-edit"></i></a>
                                                </p>
                                            <?php } else { ?>
                                                <h6>Tamaños aceptados: </h6>
                                                <p class="text-muted">No disponible<a href="<?php echo FRONT_ROOT ?>Size/ShowAddView" class="btn btn-dark btn-sm">Cargar ahora</a></p>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <hr class="mt-0 mb-4">

                                <?php } ?>

                                <h6>Ver mis Reservas</h6>
                                <div>
                                    <form action="<?php echo FRONT_ROOT ?>Reserve/ShowReservesView" method="post" class="bg-light-alpha p-1">

                                        <select class="form-control" name="pseudostatus" required>
                                            <option value="Todas">Todas</option>
                                            <option value="En Espera">En Espera</option>
                                            <option value="Confirmadas">Confirmadas</option>
                                            <option value="Rechazadas">Rechazadas</option>
                                            <option value="Pagadas">Pagadas</option>
                                            <option value="En Progreso">En Progreso</option>
                                            <option value="Completadas">Completadas</option>
                                            <option value="Calificadas">Calificadas</option>
                                            <option value="Canceladas">Canceladas</option>
                                        </select>

                                        <button type="submit" class="btn btn-dark ml-auto d-block m-1">Ir
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>

<?php
require_once(VIEWS_PATH . "footer.php");
?>