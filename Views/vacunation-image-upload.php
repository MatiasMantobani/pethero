<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <a href="<?php echo FRONT_ROOT ?>Pet/ShowProfileView/<?php echo $petid ?>">Volver</a>
            <h2 class="mb-4">Carga de vacunación</h2>
            <p>Subí la foto de las vacunaciones de tu mascota</p>
            <form action="<?php echo FRONT_ROOT ?>VacunationImage/Upload" method="post" enctype="multipart/form-data" class="bg-light-alpha p-5">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Imagen:</label>
                            <input type="file" name="file" class="form-control-file">
                        </div>
                    </div>

                    <input type="hidden" name="petid" value="<?php echo $petid ?>" class="form-control" >

                </div>
                <button type="submit" class="btn btn-dark ml-auto d-block">Continuar</button>
            </form>
        </div>
    </section>
</main>