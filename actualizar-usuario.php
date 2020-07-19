<?php

if (isset($_POST)) {

    require_once 'includes/conexion.php';


// Recoger los valores del formulario de actualizacion   
    if (isset($_POST['nombre'])) {
        $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    } else {
        $nombre = false;
    }
    $apellidos = isset($_POST ['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST ['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;

    // Array de errores

    $errores = array();


    // VAlidar los datos anteriores
    // VALIDAR CAMPO NOMBRE
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/{0-9}/", $nombre)) {
        $nombre_validate = true;
    } else {
        $nombre_validate = false;
        $errores['nombre'] = "El nombre no es válido";
    };

    // VALIDAR CAMPO APELLIDO
    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/{0-9}/", $apellidos)) {
        $apellidos_validate = true;
    } else {
        $apellidos_validate = false;
        $errores['apellidos'] = "Los apellidos no son válidos";
    };

    // VALIDAR CAMPO EMAIL

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validate = true;
    } else {
        $email_validate = false;
        $errores['email'] = "El email no es válido";
    };


    $guardar_usuario = false;
    if (count($errores) == 0) {
        
        $usuario = $_SESSION['usuario'];
        // INSERTAR USUARIOS EN LA BBDD;
        $guardar_usuario = true;
        
        
        // COMPROBAR QUE EL EMAIL AL QUE VAVMOS A ACTUALIZAR NO EXISTE EN LA BASE DE DATOS
        
        $sql = "SELECT email FROM usuarios WHERE email='$email'";
        $isset_email= mysqli_query($db, $sql);
        $isset_user= mysqli_fetch_assoc($isset_email);
        
        if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
        
        
        
        // ACTUALIZAR USUARIO Y RECOGER EL USUARIO DE LA VARIABLE DE SESION
        
        $sql = "UPDATE usuarios SET "
                . "nombre = '$nombre', "
                . "apellidos='$apellidos', "
                . "email='$email' "
                . "WHERE id=". $usuario['id'];
        $actualizar = mysqli_query($db, $sql);


        if ($actualizar) {
            $_SESSION['usuario']['nombre']= $nombre;
            $_SESSION['usuario']['apellidos']= $apellidos;
            $_SESSION['usuario']['email']= $email;
                    
                    
            $_SESSION['completado'] = "Tus datos se han actualizado con exito";
        } else {
            $_SESSION['errores']['general'] = "Fallo al actualizar";
        }
        } else {
            $_SESSION['errores']['general'] = "El usuario ya existe";
        }
        
        
    } else {
        $_SESSION['errores'] = $errores;
    }
}

header('location: mis-datos.php');



