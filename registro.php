<?php

if (isset($_POST)) {

require_once 'includes/conexion.php';


// Recoger los valores del formulario    
    if (isset($_POST['nombre'])) {
        $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    } else {
        $nombre = false;
    }


    $apellidos = isset($_POST ['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST ['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST ['password']) ? mysqli_real_escape_string($db, $_POST ['password']) : false;

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



// VALIDAR LA CONTRASEÑA

if (!empty($email)) {
    $password_validate = true;
} else {
    $password_validate = false;
    $errores['password'] = "La password está vacía";
};



$guardar_usuario = false;
if (count($errores) == 0) {
    // INSERTAR USUARIOS EN LA BBDD;
    $guardar_usuario = true;
    //CIFRAR CONTRASEÑA
    $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
    // VERIFICAR
    // password_verify($password, $password_segura);
    
    // INSERTAR USUARIO EN LA TABLA USUARIO DE LA BBDD
    
    $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos' , '$email' , '$password_segura', CURDATE());";
    $query = mysqli_query($db, $sql);
    
    
    if($query){
        $_SESSION['completado']= "El registro se ha completado con exito";
    }else{
        $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
    }
            
} else {
    $_SESSION['errores'] = $errores;

}
}

    header('location: index.php');
    
    
