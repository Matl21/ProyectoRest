        <input type="hidden" name="id" id="id" value="<?= $usuarios->id?>">
        <label for="txtNombre">Nombre</label>
        <input type="text" name="txtNombre" id="txtNombre" value="<?= $usuarios->nombre?>"><br>

        <label for="txtApellido">Apellido</label>
        <input type="text" name="txtApellido" id="txtApellido" value="<?= $usuarios->apellido?>"><br>

        <button type="submit" id="btn" value="update">GUARDAR</button>

    