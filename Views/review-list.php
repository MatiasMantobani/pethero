<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <?php if($ratings != null){ ?>
                <h2 class="mb-4">Todas las reviews de <?php echo $user->getName() ?> </h2>
                <table class="table bg-light-alpha">
                    <thead>
                    <th>ID</th>
                    <th>Dueno</th>
                    <th>Comentario</th>
                    <th>Rating</th>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($ratings as $rating) {
                        ?>
                        <tr>
                            <td><?php echo $rating->getReviewid() ?></td>
                            <td><?php echo $rating->getEmitterid() ?></td>
                            <td><?php echo $rating->getComment() ?></td>
                            <td><?php echo $rating->getRating() ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tr>
                    </tbody>
                </table>
            <?php }else{ ?>
                <h2 class="mb-4"><?php echo $user->getName() ?> no tiene reviews por el momento!</h2>
            <?php } ?>
        </div>
    </section>
</main>