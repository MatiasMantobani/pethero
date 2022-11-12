<?php
    require_once(VIEWS_PATH."header.php");
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">

            

                <h2 class="mb-4">Todas las reviews de <?php echo $user->getName() ?> </h2>
                <table class="table bg-light-alpha">
                    <thead>
                    <th>Dueño</th>
                    <th>Mascota</th>
                    <th>Comentario</th>
                    <th>Rating</th>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($ratings as $rating) {
                        ?>
                        <tr>
                            <td><?php echo $userController->GetUserById($rating->getEmitterid())->getName() ?></td>
                            <td><a href="<?php echo FRONT_ROOT ?>Pet/ShowProfileView/<?php echo $reserveInfo->getReserveById($rating->getReserveid())->getPetid() ?>" class="btn btn-primary btn-sm"><?php echo $petInfo->PetFinder($reserveInfo->getReserveById($rating->getReserveid())->getPetid())->getName() ?></a></td>
                            <td><?php echo $rating->getComment() ?></td>
                            <td><?php echo $rating->getRating() ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16" color="gold">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
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