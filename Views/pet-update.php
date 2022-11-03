<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <a href="<?php echo FRONT_ROOT ?>Pet/ShowProfileView/<?php echo $pet->getPetid() ?>">Volver</a>
            <h2 class="mb-4">Cambio de datos</h2>
            <p>Completa los campos del formulario</p>
            <form action="<?php echo FRONT_ROOT ?>Pet/Update" method="post" class="bg-light-alpha p-5">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" value="<?php echo $pet->getName(); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="observations">Observaciones [Opcional]</label>
                            <input type="text" id="observations" name="observations" value="<?php echo $pet->getObservations(); ?>"  class="form-control">
                        </div>
                    </div>

                    <input type="hidden" name="petid" value="<?php echo $pet->getPetid(); ?>" class="form-control" >
                    <input type="hidden" name="breedid" value="<?php echo $pet->getBreedid() ?>" class="form-control" >

                </div>
                <button type="submit" class="btn btn-dark ml-auto d-block">Guardar</button>
            </form>
        </div>
    </section>
</main>