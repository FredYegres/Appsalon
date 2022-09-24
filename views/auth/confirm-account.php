<h1 class="nombre-pagina">Confirmar Cuenta</h1>

<?php if(empty($usuario)) { ?>
    <div class="alerta error token">
        Token inválido
    </div>

<?php } else { ?>
    <div class="alerta exito">
        Cuenta creada Satisfactoriamente
    </div>

    <div class="acciones">
        <a href="/">Iniciar Sesión</a>
    </div>
<?php } ?>