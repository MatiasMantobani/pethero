<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">

            <?php if ($message != null) { ?>
                <div class="alert alert-primary" role="alert">
                    <?php echo $message ?>
                </div>
                <?php ;
                $message = null;
            } ?>

            <h2 class="mb-4">Ingreso de usuarios</h2>
            <p>Ingresa los datos de inicio. Aun no tenes cuenta? <b><a
                            href="<?php echo FRONT_ROOT . "User/ShowAddView" ?>">Registrate</a></b></p>
            <form action="<?php echo FRONT_ROOT ?>Auth/Login" method="post" class="bg-light-alpha p-5">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="email@pethero.com" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="Password" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>

            <br>
            <h2 class="mb-4">Credenciales de prueba:</h2>

            
                    <h2><b>123456</b></h2>
                    <div class="container">
                    <div class="row">
                    <div class="col">
                    <h2>Dueños</h2>
                    <p><b>usuario1@gmail.com</p>
                    <p><b>usuario1@gmail.com</b></p>
                    <p><b>usuario5@gmail.com</b></p>
                    </div>
                    <div class="col">
                    <h2>Guardianes</h2>
                    <p><b>usuario2@gmail.com</b></p>
                    <p><b>usuario3@gmail.com</b></p>
                    <p><b>usuario4@gmail.com</b></p>
                    </div>
                    </div>


        </div>
    </section>
</main>