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
            <div class="row">
                <div class="col-lg-4">
                    <p><b>usuario1@gmail.com -dueño- 123456</b></p>
                </div>

                <div class="col-lg-4">
                    <p><b>usuario2@gmail.com -guardian- 123456</b></p>
                </div>

                <div class="col-lg-4">
                    <p><b>usuario3@gmail.com -guardian- 123456</b></p>
                </div>


            </div>

        </div>
    </section>
</main>