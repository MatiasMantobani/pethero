<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar Persona</h2>
            <form action="<?php echo FRONT_ROOT ?>Person/ChooseType" method="post" class="bg-light-alpha p-5">

                    <div class="col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="personType" id="flexRadioDefault1" value="dueno">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Dueño
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="personType" id="flexRadioDefault2" value="guardian" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Guardian
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark ml-auto d-block">Siguiente</button>
                </div>
            </form>
        </div>
    </section>
</main>