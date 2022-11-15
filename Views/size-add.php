<?php
    require_once(VIEWS_PATH."header.php");
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Carga tus medidas</h2>
            <a href="<?php echo FRONT_ROOT ?>User/ShowProfileView">Volver</a>
            <p>Completa todos los campos del formulario indicando que tamaños podes cuidar</p>
            <form action="<?php echo FRONT_ROOT ?>Size/Update" method="post" class="bg-light-alpha p-5">

                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="small">Tamaño pequeño</label>
                            <select class="form-control" id="small" name="small" required>
                                <option value="1">Si</option>
                                <option <?php if($size != null) { if ($size->getSmall() == 0) { echo "selected"; } } ?> value=0 >No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="type">Tamaño mediano</label>
                            <select class="form-control" id="medium" name="medium" required>
                                <option value=1 >Si</option>
                                <option <?php if($size != null) { if ($size->getMedium() == 0) { echo "selected"; } } ?> value=0 >No</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="type">Tamaño grande</label>
                            <select class="form-control" id="large" name="large" required>
                                <option value=1 >Si</option>
                                <option <?php if($size != null) { if ($size->getSmall() == 0) { echo "selected"; } } ?> value=0 >No</option>
                            </select>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-dark ml-auto d-block">Cargar</button>
            </form>
        </div>
    </section>
</main>

<?php 
    require_once(VIEWS_PATH."footer.php");
?>