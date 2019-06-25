<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1><?= $titulo?></h1>

    <div id="frm">
        <input type="hidden" name="id" id="id">
        <label for="txtNombre">Nombre</label>
        <input type="text" name="txtNombre" id="txtNombre"><br>

        <label for="txtNombre">Apellido</label>
        <input type="text" name="txtApellido" id="txtApellido"><br>

        <button type="submit" value="agregar" id="btn">AGREGAR</button>

    </div>
    <br>



    <div>
        <!-- creacion de la tabla -->
        <table border="2">
            <!-- Encabezado -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th colspan="2">OPCIONES</th>

                </tr>
                
            </thead>
            <!-- donde se carga la tabla -->
            <tbody id="cuerpo">
                
            </tbody>

        </table>
    </div>



    <script src="<?= base_url('assets/js/scripts.js')?>"> </script>
</body>
</html>