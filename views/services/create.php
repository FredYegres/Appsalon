<?php include_once __DIR__ . '/../templates/barra.php'; ?>

<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">Llena todos los campos para añadir un nuevo servicio</p>

<?php include_once __DIR__ . '/../templates/botones-nav.php'; ?>

<form action="/services/create" method="POST" class="formulario">
    <?php include_once __DIR__ . '/formulario.php'; ?>
    <input type="submit" class="boton" value="Guardar Servicio">
</form>

<?php 
    $script = "<script src='/build/js/alertas.js'></script>";
?>