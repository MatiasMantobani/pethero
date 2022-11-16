<?php
    require_once(VIEWS_PATH."header.php");
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4"> Tus Fechas Disponibles</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <th>Fecha</th>
                </thead>
                <tbody>
                <?php
                foreach ($fechas as $fecha) {
                    ?>
                    <tr>
                        <td><?php echo $fecha->getDate() ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tr>
                </tbody>
            </table>

            <br>
            <p class="text-muted"><a href="<?php echo FRONT_ROOT ?>AvailableDate/ShowAddView" class="btn btn-dark btn-lg">Editar disponibilidad <i class="far fa-edit"></i></a></p>
        </div>
    </section>
</main>

<?php 
    require_once(VIEWS_PATH."footer.php");
?>