<?php
    require_once(VIEWS_PATH."header.php");
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Registro de mascota</h2>
            <p>Completa todos los campos del formulario</p>
            <form action="<?php echo FRONT_ROOT ?>Pet/ShowAddView" method="post" class="bg-light-alpha p-5">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" value="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="type">Tipo de mascota</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="1">Gato</option>
                                <option value="2">Perro</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="observations">Observaciones [Opcional]</label>
                            <input type="text" id="observations" name="observations" value="" class="form-control">
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-dark ml-auto d-block">Continuar</button>
            </form>

        </div>

    </section>
</main>

<?php 
    require_once(VIEWS_PATH."footer.php");
?>