<?php
    require_once(VIEWS_PATH."header.php");
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Cambio de tarifa</h2>
            <p>Completa los campos del formulario</p>
            <form action="<?php echo FRONT_ROOT ?>Keeper/UpdatePricing" method="post" class="bg-light p-5">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="pricing">Tarifa [1.000 a 10.000]</label>
                            <input type="number" id="pricing" min="1000" max="10000" name="pricing" value="<?php if($keeper != null) { echo $keeper->getPricing(); } ?>" class="form-control" required>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-dark ml-auto d-block">Actualizar</button>
            </form>
        </div>
    </section>
</main>

<?php 
    require_once(VIEWS_PATH."footer.php");
?>