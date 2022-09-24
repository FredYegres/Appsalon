<?php include_once __DIR__ . '/../templates/barra.php'; ?>

<h1 class="nombre-pagina">Actualizar Servicios</h1>
<p class="descripcion-pagina">Modifica los valores del formulario para actualizar el servicio</p>

<?php include_once __DIR__ . '/../templates/botones-nav.php'; ?>

<form method="POST" class="formulario">
    <?php include_once __DIR__ . '/formulario.php'; ?>
    <input type="submit" class="boton" value="Actualizar Servicio">
</form>

<?php 
    $script = "<script src='/build/js/alertas.js'></script>";
?>