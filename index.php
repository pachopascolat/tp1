<?php require('top.php'); ?>


<body></body>
<div class="grid">
    <header>
        Header
    </header>

    <aside class="sidebar-left">
        Left Sidebar
    </aside>

    <article>

        <form id="form" method="POST" action="Formulario.php">
            <div>
                <label>Nombre:</label>
                <input type="text" name="nombre" id="nombre">
                <span style="color:red" id=error-nombre></span>
            </div>
            <label>Edad:</label>
            <input type="text" name="edad" id="edad">
            <br>
            <label>Sexo:</label>
            <input type="radio" name="sexo" value="masculino">masculino
            <input type="radio" name="sexo" value="femenino">Femenino
            <input type="radio" name="sexo" value="otros">Otros
            <br>
            <label>Estudios</label>
            <select id="estudios" name="estudios">
                <option value="1">Primario</option>
                <option value="2">Secundario</option>
                <option value="3">Terciario</option>
                <option value="4">Universitario</option>

            </select>
            <div>
                <button type="button" id="submitBtn" onclick="validar()">Enviar</button>
            </div>

        </form>


    </article>

    <aside class="sidebar-right">
        Right Sidebar
    </aside>

    <?php require('bottom.php'); ?> 