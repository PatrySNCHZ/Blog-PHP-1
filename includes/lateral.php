 


<!-- sidebar -->
<aside id="sidebar">
    
    <div id="buscador" class="block">
        <h3> Buscar </h3>
        <form action="buscar.php" method="post">

            <input type="text" name="busqueda" />
            <input type="submit" value="Buscar" />

        </form>   
    </div>
    
        
    <?php if (isset($_SESSION['usuario'])): ?>
        <div id="usuario" class="block">
            <h3> Bienvenido/a, <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos'] ?></h3>
            <!-- botones -->
            <a href="crear-entradas.php" class="boton boton-verde"> Crear entradas </a>
            <a href="crear-categoria.php" class="boton"> Crear categorías </a>
            <a href="mis-datos.php" class="boton boton-naranja"> Mis datos </a>
            <a href="cerrar.php" class="boton boton-rojo"> Cerrar sesión </a>

        </div>

    <?php endif; ?>

    <?php if (!isset($_SESSION['usuario'])): ?>
    <div id="login" class="block">
        <h3> Identificate </h3>

        <?php if (isset($_SESSION['error_login'])): ?>

            <div class="alerta alerta-error">
                <?= $_SESSION['error_login']; ?>

            </div>

        <?php endif; ?>

        <form action="login.php" method="post">
            <label for="email">Email </label>
            <input type="email" name="email"/>

            <label for="password">Contraseña </label>
            <input type="password" name="password"/>

            <input type="submit" value="Entrar">

        </form>   
    </div>


    <div id="register" class="block">
        <!-- MOSTRAR ERRORES -->
        <?php if (isset($_SESSION['completado'])): ?>
            <div class="alerta alerta-exito">
                <?php echo $_SESSION['completado']; ?>
            </div>
        <?php elseif (isset($_SESSION['errores']['general'])): ?>
            <div class="alerta alerta-error">
                <?php echo $_SESSION['errores']['general']; ?>
            </div>
        <?php endif; ?>

        <!-- php -->
        <h3> Registrate </h3>
        <form action="registro.php" method="post">
            <label for="nombre">Nombre </label>
            <input type="text" name="nombre"/>
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre') : ''; ?>

            <label for="apellidos">Apellidos </label>
            <input type="text" name="apellidos"/>
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'apellidos') : ''; ?>

            <label for="email">Email </label>
            <input type="email" name="email"/>
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'email') : ''; ?>

            <label for="password">Contraseña </label>
            <input type="password" name="password"/>
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'password') : ''; ?>

            <input type="submit" name="submit" value="Registrar">

        </form>   

        <?php borrarErrores(); ?>
    </div>
    <?php endif; ?>
</aside>