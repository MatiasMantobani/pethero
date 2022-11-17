<?php
    require_once(VIEWS_PATH."header.php");
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Ups! La pagina que buscas no existe. Error 404</h2>
            <img src="<?php echo FRONT_ROOT ?>Views/img/404.png" class="rounded mx-auto d-block" width="50%" alt="error-dog">
        </div>
    </section>
</main>

<?php 
    require_once(VIEWS_PATH."footer.php");
?>