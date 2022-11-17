<?php
    require_once(VIEWS_PATH."header.php");
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Registro de usuario</h2>
            <p>Completa todos los campos del formulario</p>
            <form action="<?php echo FRONT_ROOT ?>User/Add" method="post" class="bg-light p-5">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="name" maxlength="30" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Apellido</label>
                            <input type="text" name="surname" maxlength="30" value="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="type">Tipo de usuario</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="D">Dueño</option>
                                <option value="G">Guardian</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" maxlength="45" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Password [+ 6 carcateres]</label>
                            <input type="password" name="password" minlength="6" maxlength="30" value="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Telefono</label>
                            <input type="number" name="phone" max="99999999999999999" value="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">DNI [8]</label>
                            <input type="number" max="99999999" name="dni" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">CUIT [11]</label>
                            <input type="number" max="99999999999" name="cuit" value="" class="form-control" required>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-dark ml-auto d-block">Registrarse</button>
            </form>
        </div>
    </section>
</main>

<?php 
    require_once(VIEWS_PATH."footer.php");
?>