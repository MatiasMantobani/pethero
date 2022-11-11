<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <a href="<?php echo FRONT_ROOT ?>User/ShowProfileView">Cancelar</a>

            <h2 class="mb-4">Registro de mascota</h2>
            <p>Completa todos los campos del formulario</p>

            <form action="<?php echo FRONT_ROOT ?>Pet/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="breedid">Raza de mascota</label>
                            <select class="form-control" id="breedid" name="breedid" required>

                                <!----><?php //$breedList = $breedController->getAllByType($type); ?>
                                <?php if ($breedList != null) {
                                foreach ($breedList as $breed) { ?>
                                    <option value="<?php echo $breed->getBreedid() ?>"><?php echo $breed->getName() ?></option>
                                <?php } } ?>

                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="name" value="<?php echo $name ?>" class="form-control" required>
                    <input type="hidden" name="observations" value="<?php echo $observations ?>" class="form-control" required>

                </div>
                <button type="submit" class="btn btn-dark ml-auto d-block">Agregar</button>
            </form>

        </div>
    </section>
</main>