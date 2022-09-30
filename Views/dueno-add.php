<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar Guardian</h2>
            <form action="<?php echo FRONT_ROOT ?>Dueno/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Mascotas</label>
                            <input type="text" name="mascotas" value="" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Reservas</label>
                            <input type="text" name="reservas" value="" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Pagos</label>
                            <input type="text" name="pagos" value="" class="form-control">
                        </div>
                    </div>
                    <!-- Quitar esto datos después. Por ahora solo solo estan mientras usamos string-->