<?php include (VIEWS_PATH."nav.php"); ?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar Guardian</h2>
            <form action="<?php echo FRONT_ROOT ?>Guardian/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Cuil <small>[Sin guiones]</small></label>
                            <input type="number" min="11111111111" maxlength="99999999999" name="cuil" value="" class="form-control" title="El campo solo acepta 11 caracteres numericos" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Remuneracion <small>[1 a 10.000]</small></label>
                            <input type="number" min="1" max="10000" name="remuneracion" value="" class="form-control" title="El campo solo admite numeros, en un maximo de 10.000" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Tamaño de mascotas aceptados</label>
                            <input type="text" name="tamanoDeMascota" value="" class="form-control">
                        </div>
                    </div>

<!--                    <div class="col-lg-4">-->
<!--                        <div class="form-group">-->
<!--                            <label for="">Disponibilidad</label>-->
<!--                            <input type="hidden" name="disponibilidad" value="" class="form-control">-->
<!--                        </div>-->
<!--                    </div>-->