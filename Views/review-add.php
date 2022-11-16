<?php
    require_once(VIEWS_PATH."header.php");
    require_once('nav.php');
?>
<header>
    <!--    Sistema de rating starts-->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
</header>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <form action="<?php echo FRONT_ROOT ?>Review/AddWithCheck" method="post">

                <div class="container">
                    <label for="rating" class="control-label">Como calificarias el cuidado de...:</label>
                    <input id="rating" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="5">
                </div>

                <textarea class="form-control" id="" name="comment" rows="3" maxlength="200" placeholder="Deja tu comentario aqui (maximo 200 caracteres)"></textarea>

                <script>
                    $("#input-id").rating();
                </script>

                <input type="hidden" name="reserveid" value="<?php echo $reserva ?>">

                <br>
                <button type="submit" class="btn btn-primary">Enviar review</button>

            </form>
        </div>
    </section>
</main>

<?php 
    require_once(VIEWS_PATH."footer.php");
?>