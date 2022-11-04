<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <a href="<?php echo FRONT_ROOT ?>User/ShowProfileView/">Volver</a>
            <h2 class="mb-4">Cambio de datos</h2>
            <p>Completa los campos del formulario</p>
            <form action="<?php echo FRONT_ROOT ?>User/Update" method="post" class="bg-light-alpha p-5">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" value="<?php echo $user->getName(); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="surname">Apellido</label>
                            <input type="text" id="surname" name="surname" value="<?php echo $user->getSurname(); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="text" id="phone" name="phone" value="<?php echo $user->getPhone(); ?>"  class="form-control">
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-dark ml-auto d-block">Guardar</button>
            </form>
        </div>
    </section>
</main>