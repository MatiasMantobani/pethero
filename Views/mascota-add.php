<?php include (VIEWS_PATH."nav.php"); ?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar Mascota</h2>
            <form action="<?php echo FRONT_ROOT ?>Mascota/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">

               
                <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Nombre de la Mascota</label>
                            <input type="text" name="petName" value="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Foto</label>
                            <input type="text" name="foto" value="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Carnet de Vacunas</label>
                            <input type="text" name="carnetVacunas" value="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Observaciones</label>
                            <input type="text" name="observaciones" value="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Raza</label>
                            <input type="text" name="raza" value="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Tamaño</label>
                            <input type="text" name="tamano" value="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Video (opcional)</label>
                            <input type="text" name="video" value="" class="form-control" required>
                        </div>
                    </div>

                    </div>

                <button type="submit" class="btn btn-dark ml-auto d-block">Crear</button>
            </form>
        </div>
    </section>
</main>

                    
                    