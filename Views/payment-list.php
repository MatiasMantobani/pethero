<?php
    require_once(VIEWS_PATH."header.php");
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
                <h2 class="mb-4">Tus Pagos </h2>
                <table class="table bg-light">
                    <thead>
                        <?php if($_SESSION["type"] == "G"){ ?>
                            <th>ID de Reserva</th>
                        <?php } ?>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Pagado</th>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($paymentList as $payment) {
                        ?>
                        <tr>
                            <?php if($_SESSION["type"] == "G"){ ?>
                                <td><?php echo $payment->getPaymentid() ?></td>
                            <?php } ?>
                            <td><?php echo $payment->getDate() ?></td>
                            <td><?php echo "$" . $payment->getMonto() ?></td>
                            <td>
                                <?php if($payment->getPayed() == 1){ ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16" color="green">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                <?php }else { ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16" color="red">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                    </svg>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tr>
                    </tbody>
                </table>
        </div>
    </section>
</main>

<?php 
    require_once(VIEWS_PATH."footer.php");
?>