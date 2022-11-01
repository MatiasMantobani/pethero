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
                <?php ;
                $_SESSION['message'] = null;
            } ?>

            <h2 class="mb-4">Estas viendo a <?php echo $pet->getName(); ?></h2>

            <div class="col col-lg-12 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem; border: #856404">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white"
                             style="border-radius: .5rem;">
                            <img src="<?php echo FRONT_ROOT ?>Views/img/profile/profile_default.png"
                                 alt="Profile img" class="img-fluid my-5 rounded" style="width: 100px;"/>
                            <h5><?php echo $pet->getName(); ?></h5>
                            <p><?php switch ($breed->getType()) {
                                    case 1:
                                        echo "Gato";
                                        break;
                                    case 2:
                                        echo "Perro";
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
                                        <h6>Nombre</h6>
                                        <p class="text-muted"><?php echo $pet->getName() ?><a href="<?php echo FRONT_ROOT ?>Pet/ShowUpdateView/<?php echo $pet->getPetid() ?>"> [Editar]</a></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Observaciones</h6>
                                        <p class="text-muted"><?php echo $pet->getObservations() ?><a href="<?php echo FRONT_ROOT ?>Pet/ShowUpdateView/<?php echo $pet->getPetid() ?>"> [Editar]</a></p>
                                    </div>
                                </div>

                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Carnet de vacunación</h6>
                                        <p class="text-muted">No posee <a href="#"> [Cargar]</a></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Quitar mascota</h6>
                                        <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>Pet/Remove/<?php echo $pet->getPetid() ?>"> [Quitar]</a></p>
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