<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesión con tus datos</p>

<form class="formulario" method="POST" action="/">
    <?php if($usuarioInvalido) { ?>
        <div class="alerta error">
            Usuario Invalido
        </div>
    <?php } ?>
    <?php $auth->mostrarAlertas('email'); ?>
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu Email" name="email" value="<?php echo s($auth->email); ?>">
    </div>

    <?php if($passwordInvalida) { ?>
        <div class="alerta error">
            Contraseña Incorrecta
        </div>
    <?php } else if($noConfirmado) {?>
        <div class="alerta error">
            Usuario no confirmado
        </div>
    <?php } ?>
    <?php $auth->mostrarAlertas('password'); ?>
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="Tu Contraseña" name="password">
    </div>

    <input type="submit" class="boton" value="Iniciar Sesión">
</form>

<div class="acciones">
    <a href="/new-account">¿Aún no tienes una cuenta? Crea una</a>

    <a href="/reset">¿Olvidaste tú Contraseña?</a>
</div>

<?php 
    $script = "<script src='build/js/alertas.js'></script>";
?>