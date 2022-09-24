<h1 class="nombre-pagina">Olvide mi Contraseña</h1>
<p class="descripcion-pagina">Reestablece tu contraseña escribiendo tu email a continuación</p>

<form class="formulario" action="/reset" method="POST">

    <?php $auth->mostrarAlertas('email', $usuarioInvalido = true); ?>
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu E-mail">
    </div>

    <input type="submit" class="boton" value="Recuperar Contraseña">

</form>

<div class="acciones">
    <a href="/new-account">¿Aún no tienes una cuenta? Crea una</a>

    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
</div>

<?php 
    $script = "<script src='build/js/alertas.js'></script>";
?>