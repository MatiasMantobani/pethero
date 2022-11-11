<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">

            <h2 class="mb-4">Perfil de... <?php echo "3ro"?></h2>

            <div class="col col-lg-12 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem; border: #856404">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white" style="border-radius: .5rem;">

<!--                            IMAGEN-->
<!--                            --><?php //if ($userImage != null) { ?>
<!---->
<!--                                <img src="--><?php //echo FRONT_ROOT . USER_UPLOADS_PATH . $userImage->getName() ?><!--" alt="Profile img" class="img-fluid my-5 rounded-circle" style="width: 200px;" />-->
<!--                                <p class="text-muted"><a href="--><?php //echo FRONT_ROOT ?><!--UserImage/ShowUploadView">[Cambiar-->
<!--                                        foto]</a></p>-->
<!--                            --><?php //} else { ?>
<!---->
                                <img src="<?php echo FRONT_ROOT ?>Views/img/profile/profile_default.png" alt="Profile img" class="img-fluid my-5 rounded-circle" style="width: 200px;" />
<!--                                <p class="text-muted"><a href="--><?php //echo FRONT_ROOT ?><!--UserImage/ShowUploadView">[Subir-->
<!--                                        foto]</a></p>-->
<!--                            --><?php //} ?>

                            <h5><?php echo "Nombre" ?> <?php echo "Apellido" ?></h5>
                            <i class="far fa-edit mb-5"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted"><?php echo "Email" ?></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Teléfono</h6>
                                        <p class="text-muted"><?php echo "Telefono" ?></p>
                                    </div>
                                </div>

                                <hr class="mt-0 mb-4">

<!--                                --><?php //if ($adress) { ?>
                                    <h6>Direccion: </h6>
                                    <p class="text-muted"><?php echo "Direccion" ?></p>
<!--                                --><?php //} else { ?>
<!--                                    <h6>Direccion: </h6>-->
<!--                                    <p class="text-muted">--><?php //echo "Sin direccion" ?><!--</p>-->
<!--                                --><?php //} ?>

                                <hr class="mt-0 mb-4">


                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <button type="button" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                                    <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"></path>
                                                </svg>
                                                Enviar Mensaje
                                            </button>
                                        </div>
                                    </div>

                                    <hr class="mt-0 mb-4">

                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
<!--                                            --><?php //if ($size) { ?>
                                                <h6>Tamaños aceptados: </h6>
                                                <p class="text-muted"><?php echo "Tamanos aceptados";?></p>
<!--                                            --><?php //} else { ?>
<!--                                                <h6>Tamaños aceptados: </h6>-->
<!--                                                <p class="text-muted">--><?php //echo "Todavia no indico que tamanos acepta";?><!--</p>-->
<!--                                            --><?php //} ?>
                                        </div>
                                    </div>


                                    <hr class="mt-0 mb-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>