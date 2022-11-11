<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">

            <?php if ($paymentList) { ?>

                <h2 class="mb-4"> Tus pagos </h2>
                <table class="table bg-light-alpha">
                    <thead>
                    <th>PaymentID</th>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($paymentList as $payment) {
                        ?>
                        <tr>
                            <td><?php echo $payment->getPaymentid() ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tr>
                    </tbody>
                </table>

            <?php } else {
                echo "Opcion 1: Mostrar un perrito lindo triste y algo asi como no hay reservas";
                echo "Opcion 2: Devolverlo al perfil con mensaje de no hay reservas para mostrar ";
            } ?>


        </div>
    </section>
</main>