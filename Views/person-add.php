
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="firstName" value=""  class="form-control" title="El campo solo acepta letras, y un maximo de 15 caracteres" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Apellido</label>
                            <input type="text" name="lastName" value="" class="form-control" title="El campo solo acepta letras, y un maximo de 15 caracteres" required>
                            <div class="valid-feedback">
                                ¡Bien!
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">DNI <small>[Sin puntos ni espacios]</small></label>
                            <input type="number" min="1111111" max="99999999" name="dni" value="" class="form-control" title="El campo solo acepta numeros validos, y entre 7 y 8 caracteres" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Direccion</label>
                            <input type="text" name="adress" value="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Telefono</label>
                            <input type="number" min="111" max="999999999999999" name="telephone" value="" class="form-control" title="El campo solo acepta numeros, y entre 3 y 15 caracteres" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" value="" class="form-control" maxlength="30" title="El campo requiere una direccion de correo valida, 30 carcateres maximo" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="password">Contraseña <small>[4 a 8 caracteres]</small></label>
                            <input type="password" name="password" minlength="4" maxlength="8" value="" class="form-control" title="El campo admite de 4 a 8 caracteres" required>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-dark ml-auto d-block">Crear</button>
            </form>
        </div>
    </section>
</main>