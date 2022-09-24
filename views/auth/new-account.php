<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<form class="formulario" method="POST" action="/new-account">
    <?php $usuario->mostrarAlertas('nombre'); ?>
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo s($usuario->nombre); ?>">
    </div>

    <?php $usuario->mostrarAlertas('apellido'); ?>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido" value="<?php echo s($usuario->apellido); ?>">
    </div>

    <?php $usuario->mostrarAlertas('telefono'); ?>
    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Tu Teléfono" maxlength="11" value="<?php echo s($usuario->telefono); ?>">
    </div>

    <?php if($usuarioExiste) { ?>
        <div class="alerta error">
        El ususario ya esta registrado
        </div>
    <?php } ?>
    <?php $usuario->mostrarAlertas('email'); ?>
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu E-mail" value="<?php echo s($usuario->email); ?>">
    </div>

    <?php $usuario->mostrarAlertas('password', $password = true); ?>
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Tu Contraseña">
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>

    <a href="/reset">¿Olvidaste tú Contraseña?</a>
</div>

<?php 
    $script = "<script src='build/js/alertas.js'></script>";
?>