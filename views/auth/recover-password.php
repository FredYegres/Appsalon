<h1 class="nombre-pagina">Reestablecer Contraseña</h1>
<p class="descripcion-pagina">Ingresa tu nueva contraseña</p>

<form class="formulario" method="POST">

    <?php if(empty($usuario)) { ?>
        <div class="alerta error token">
            Token inválido
        </div>
    <?php } ?>
    <?php if($error) return ?>

    <?php $auth->mostrarAlertas('password', $password = true); ?>
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Tu Nueva Contraseña">
    </div>

    <input type="submit" class="boton" value="Reestablecer Contraseña">

</form>

<div class="acciones">
    <a href="/new-account">¿Aún no tienes una cuenta? Crea una</a>

    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
</div>

<?php 
    $script = "<script src='build/js/alertas.js'></script>";
?>