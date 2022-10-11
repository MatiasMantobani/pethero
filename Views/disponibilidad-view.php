<div class="d-flex align-items-center justify-content-center p-5">
    <div class="custom-control custom-checkbox bg-dark-alpha rounded">
        <h2>Modificando la disponibilidad</h2>
        <form action="<?php echo FRONT_ROOT ?>Guardian/ModifyDisponibilidad" method="post" class="bg-light-alpha p-5 rounded">
            <div>
                <input type="checkbox" class="custom-control-input" id="lunes" value="Lunes " name="lunes">
                <label class="custom-control-label" for="lunes">Lunes</label>
            </div>

            <div>
                <input type="checkbox" class="custom-control-input" id="martes" value="Martes " name="martes">
                <label class="custom-control-label" for="martes">Martes</label>
            </div>

            <div>
                <input type="checkbox" class="custom-control-input" id="miercoles" value="Miercoles " name="miercoles">
                <label class="custom-control-label" for="miercoles">Miercoles</label>
            </div>

            <div>
                <input type="checkbox" class="custom-control-input" id="jueves" value="Jueves " name="jueves">
                <label class="custom-control-label" for="jueves">Jueves</label>
            </div>

            <div>
                <input type="checkbox" class="custom-control-input" id="viernes" value="Viernes " name="viernes">
                <label class="custom-control-label" for="viernes">Viernes</label>
            </div>

            <div>
                <input type="checkbox" class="custom-control-input" id="sabado" value="Sabado " name="sabado">
                <label class="custom-control-label" for="sabado">Sabado</label>
            </div>

            <div>
                <input type="checkbox" class="custom-control-input" id="domingo" value="Domingo " name="domingo">
                <label class="custom-control-label" for="domingo">Domingo</label>
            </div>

            <div>
                <button type="submit" class="btn btn-dark ml-auto d-block">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
