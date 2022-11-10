<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <form action="<?php echo FRONT_ROOT ?>Review/Add" method="post">

                <div class="container">
                    <label for="rating" class="control-label">Como calificarias el cuidado de...:</label>
                    <input id="rating" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="5">
                </div>

                <textarea class="form-control" id="" name="comment" rows="3" maxlength="200"></textarea>

                <script>
                    $("#input-id").rating();
                </script>

                <br>
                <button type="submit" class="btn btn-primary">Enviar review</button>

            </form>
        </div>
    </section>
</main>