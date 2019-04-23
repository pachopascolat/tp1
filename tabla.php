<?php
$con = new mysqli('localhost', 'root', 'jupit3r', 'tp1');

 if ($con->connect_error) {
     die("Connection failed: " . $con->connect_error);
     echo "error de conexion a la base";
 }

 $sql = "select * from formulario";

 $result = $con->query($sql);
     
 
?>

<div class="container">
    <table>
        <thead>
        <th>Nombre</th>
        <th>Edad</th>
        <th>Sexo</th>
        <th>Estudios</th>
        </thead>
        <tbody>
            <?php while($persona=$result->fetch_assoc()) { ?>
            <tr>
                <td><?= $persona['nombre'] ?></td>
                <td><?= $persona['edad']?></td>
                <td><?= $persona['sexo']?></td>
                <td><?= $persona['estudios']?></td>
            </tr>
            <?php
            
 }
            
            $result->free();
            $con->close();
            ?>
        </tbody>
    </table>
    <a href="index.php"> Cargar nuevo</a>
</div>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

