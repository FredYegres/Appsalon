<?php include_once __DIR__ . '/../templates/barra.php'; ?>

<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de Servicios</p>

<?php include_once __DIR__ . '/../templates/botones-nav.php'; ?>

<ul class="servicios">
    <?php foreach($servicios as $servicio) { ?>
        <li>
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
            <p>Precio: <span>$<?php echo $servicio->precio; ?></span></p>

            <div class="acciones">
                <a class="boton" href="/services/update?id=<?php echo $servicio->id; ?>">Actualizar</a>

                <form action="/services/delete" method="POST">
                    <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                    <input type="submit" value="Eliminar" class="boton-eliminar">
                </form>
            </div>
        </li>

    <?php } ?>
</ul>

<?php 
    $script = "<script src='/build/js/alertas.js'></script>";
?>