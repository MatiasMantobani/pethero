<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <a href="<?php echo FRONT_ROOT ?>User/ShowProfileView/">Volver</a>
            <h2 class="mb-4">Cambio de tarifa</h2>
            <p>Completa los campos del formulario</p>
            <form action="<?php echo FRONT_ROOT ?>Keeper/UpdatePricing" method="post" class="bg-light-alpha p-5">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="pricing">Tarifa</label>
                            <input type="number" id="pricing" name="pricing" value="<?php if($keeper != null) { echo $keeper->getPricing(); } ?>" class="form-control" required>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-dark ml-auto d-block">Actualizar</button>
            </form>
        </div>
    </section>
</main>