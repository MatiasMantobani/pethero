<?php
require_once(VIEWS_PATH . "header.php");
require_once('nav.php');
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4"> Solicita una reserva </h2>

            <form action="<?php echo FRONT_ROOT ?>Reserve/showChooseKeeperView" method="post" class="bg-light-alpha p-5">

                <!--                Desplegable de mascotas-->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="petid">Selecciona tu mascota</label>
                        <select class="form-control" id="petid" name="petid" required>

                            <?php if ($listadoMascotas != null) {

                                if ($choosePet) {
                            ?> <option value="<?php echo $choosePet->getPetid() ?>"><?php echo $choosePet->getName() ?></option>

                                    <?php
                                } else {
                                    foreach ($listadoMascotas as $pet) { ?>
                                        <option value="<?php echo $pet->getPetid() ?>"><?php echo $pet->getName() ?></option>
                            <?php }
                                }
                            } ?>
                        </select>
                    </div>
                </div>

                <!--                calendario-->
                <div class="col-lg-5">
                    <label for="daterange">Selecciona el rango de fechas</label>
                    <script>
                        $(function() {
                            $('input[name="daterange"]').daterangepicker({
                                opens: 'left',
                                minDate: new Date(),
                                locale: {
                                    format: "YYYY-MM-DD",
                                    separator: ','
                                }
                            }, function(start, end, label) {
                                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                            });
                        });
                    </script>
                    <input type="text" name="daterange" />
                </div>

                <div class="col-lg-4">
                    <br>
                    <button type="submit" class="btn btn-primary">Buscar guardianes</button>
                </div>

            </form>
        </div>
    </section>
</main>

<?php
require_once(VIEWS_PATH . "footer.php");
?>