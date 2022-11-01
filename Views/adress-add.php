<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Registro de domicilio</h2>
            <p>Completa todos los campos del formulario</p>
            <form action="<?php echo FRONT_ROOT ?>Adress/Update" method="post" class="bg-light-alpha p-5">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Calle</label>
                            <input type="text" id="street" name="street" value="<?php if($adress2 != null) echo $adress2->getStreet(); ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Altura</label>
                            <input type="text" name="number" value="<?php if($adress2 != null) echo $adress2->getNumber(); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Codigo postal</label>
                            <input type="text" name="postalcode" value="<?php if($adress2 != null) echo $adress2->getPostalcode(); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Piso [Opcional]</label>
                            <input type="text" name="floor" value="<?php if($adress2 != null) echo $adress2->getFloor(); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Departamento [Opcional]</label>
                            <input type="text" name="department" value="<?php if($adress2 != null) echo $adress2->getDepartment(); ?>" class="form-control">
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-dark ml-auto d-block">Modificar</button>
            </form>
        </div>
    </section>
</main>