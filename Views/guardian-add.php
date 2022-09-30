<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar Guardian</h2>
            <form action="<?php echo FRONT_ROOT ?>Guardian/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Cuil</label>
                            <input type="text" name="cuil" value="" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Remuneracion</label>
                            <input type="text" name="remuneracion" value="" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Tamaño de mascotas aceptados</label>
                            <input type="text" name="tamanoDeMascota" value="" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Disponibilidad</label>
                            <input type="text" name="disponibilidad" value="" class="form-control">
                        </div>
                    </div>