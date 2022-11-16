<?php
    require_once(VIEWS_PATH."header.php");
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">

            <?php if ($_SESSION['type'] == "D" && $_SESSION['message'] != null) { foreach($_SESSION['message'] as $alert) { ?>
                <div class="alert alert-primary" role="alert">
                    <?php if($alert != "") { echo $alert; } ?>
                </div>
                <?php } $_SESSION['message'] = null; $_SESSION['message'] = []; } ?>
            <h2 class="mb-4">Estás viendo a <?php echo $pet->getName(); ?></h2>

            <div class="col col-lg-12 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem; border: #856404">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white"
                             style="border-radius: .5rem;">


                            <?php if ($petImage != null) { ?>

                                <img src="<?php echo FRONT_ROOT . PET_UPLOADS_PATH . $petImage->getName() ?>" alt="Profile img" class="img-fluid my-5 rounded" style="width: 200px;" />
                                <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>PetImage/ShowUploadView/<?php echo $pet->getPetid() ?>" class="btn btn-dark btn-sm">Cambiar foto <i class="far fa-edit"></i></a></p>
                            <?php } else { ?>

                                <img src="<?php echo FRONT_ROOT ?>Views/img/profile/profile_default.png" alt="Profile img" class="img-fluid my-5 rounded" style="width: 200px;" />
                                <br>
                                <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>PetImage/ShowUploadView/<?php echo $pet->getPetid() ?>" class="btn btn-dark">Subir foto <i class="far fa-edit"></i></a></p>
                            <?php } ?>

                            <h5><?php echo $pet->getName(); ?></h5>
                            <p><?php switch ($breed->getType()) {
                                    case 1:
                                        echo "Gato";
                                        break;
                                    case 2:
                                        echo "Perro";
                                        break;
                                } ?></p>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Información</h6>

                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Nombre</h6>
                                        <p class="text-muted"><?php echo $pet->getName() ?>
                                            <br>
                                            <a href="<?php echo FRONT_ROOT ?>Pet/ShowUpdateView/<?php echo $pet->getPetid() ?>" class="btn btn-dark"> Editar <i class="far fa-edit"></i></a></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Observaciones</h6>
                                        <p class="text-muted"><?php echo $pet->getObservations() ?>
                                            <br>
                                            <a href="<?php echo FRONT_ROOT ?>Pet/ShowUpdateView/<?php echo $pet->getPetid() ?>" class="btn btn-dark"> Editar <i class="far fa-edit"></i></a></p>
                                    </div>
                                </div>

                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Carnet de vacunación</h6>

                                        <?php if ($vacunationImage != null) { ?>
                                            <img src="<?php echo FRONT_ROOT . VACUNATION_UPLOADS_PATH . $vacunationImage->getName() ?>" alt="Profile img" class="img-fluid my-5 rounded" style="height: 50px;" />
                                            <p class="text-muted">
                                                <br>
                                                <a href="<?php echo FRONT_ROOT ?>VacunationImage/ShowUploadView/<?php echo $pet->getPetid() ?>" class="btn btn-dark">Renovar <i class="far fa-edit"></i></a></p>
                                        <?php } else { ?>
                                            <p class="text-muted">No posee
                                                <br>
                                                <a href="<?php echo FRONT_ROOT ?>VacunationImage/ShowUploadView/<?php echo $pet->getPetid() ?>" class="btn btn-dark">Subir certificado <i class="far fa-edit"></i></a></p>
                                        <?php } ?>



                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Quitar mascota</h6>
                                        <p class="text-muted">
                                            <br>
                                            <a href="<?php echo FRONT_ROOT ?>Pet/Remove/<?php echo $pet->getPetid() ?>" class="btn btn-danger"> Quitar
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </a></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
</main>

<?php 
    require_once(VIEWS_PATH."footer.php");
?>