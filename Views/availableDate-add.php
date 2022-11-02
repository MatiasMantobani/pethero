<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <form action="<?php echo FRONT_ROOT ?>AvailableDate/Update/" method="post" class="bg-light-alpha p-5">
                <h4>Selecciona tus fechas disponibles para cuidar mascotas</h4>
                <br>
                <script>
                    $(function() {
                        $('input[name="daterange"]').daterangepicker({
                            opens: 'left',
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
                <br>
                <br>
                <br>
                <button type="submit" class="btn btn-primary">ENVIAR</button>

            </form>
        </div>
    </section>
</main>