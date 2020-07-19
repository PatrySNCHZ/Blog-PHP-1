<!DOCTYPE HTML>
<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title> Blog de Videojuegos </title>
        <link rel="stylesheet" type="text/css" href="./assets/css/style.css"/> 

    </head>
    <body>
        <!-- cabecera -->
        <header id="header">
            <div id="logo">
                <a href="index.php">
                    Blog de videojuegos
                </a>
            </div>


            <!-- menu -->

            <nav id="nav">
                <ul>
                    <li>
                        <a href="index.php"> Inicio </a>
                    </li>  

                    <?php
                    $categorias = conseguirCategorias($db);
                    if (!empty($categorias)):
                        while ($categoria = mysqli_fetch_assoc($categorias)):
                            ?>
                            <li>
                                <a href="categoria.php?id=<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?> </a>
                            </li>  
                        <?php
                        endwhile;
                    endif;
                    ?>
                    <li>
                        <a href=""> Sobre mi </a>
                    </li>
                    <li>
                        <a href=""> Contacto </a>
                    </li>  
                </ul>
            </nav>
            <div class="clearfix"></div>
        </header>

        <div id="container">
