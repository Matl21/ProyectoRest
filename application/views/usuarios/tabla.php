<?php

    foreach ($usuarios as $usuario) {
        # code...
    ?>
        <tr>
            <td><?= $usuario->id?></td>
            <td><?= $usuario->nombre?></td>
            <td><?= $usuario->apellido?></td>
            <td>
                <button class="btnEditar" value="<?= $usuario->id?>">EDITAR</button>
                <button class="btnEliminar"  value="<?= $usuario->id?>">ELIMINAR</button>
            </td>
        </tr>
    
    
    <?php }
?>