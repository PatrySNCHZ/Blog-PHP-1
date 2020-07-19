<?php


function mostrarErrores($errores, $campo) {
    $alerta = "";
    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = "<div class='alerta alerta-error'>" . $errores[$campo] . "</div>";
    }

    return $alerta;
}

function borrarErrores() {
    $borrado = false;

    if (isset($_SESSION['errores'])) {

        $_SESSION['errores'] = null;
        $borrado=true;
    }
    
      if (isset($_SESSION['errores_entrada'])) {

        $_SESSION['errores_entrada'] = null;
        $borrado=true;
    }

        if (isset($_SESSION['completado'])) {
            $_SESSION['completado'] = null;
           $borrado=true;
        }
    }    
    
    
function conseguirCategorias($db){
    $sql= "SELECT * FROM categorias ORDER BY id ASC";
    $categorias = mysqli_query($db, $sql);
    $resultado=array();
    if($categorias && mysqli_num_rows($categorias)>= 1){
        $resultado=$categorias;
    }
        
   return $resultado;
    
}

    
function conseguirCategoria($db, $id){
    $sql= "SELECT * FROM categorias WHERE id='$id'";
    $categorias = mysqli_query($db, $sql);
    $resultado=array();
    if($categorias && mysqli_num_rows($categorias)>= 1){
        $resultado= mysqli_fetch_assoc($categorias);
    }
        
   return $resultado;
    
}


function conseguirEntrada($db, $id){
    $consulta = "SELECT e.*, c.nombre AS 'categoria', CONCAT( u.nombre, ' ', u.apellidos) as 'usuario' FROM entradas e"
            . " INNER JOIN categorias c ON e.categoria_id = c.id"
            . " INNER JOIN usuarios u ON e.usuario_id = u.id"
            . " WHERE e.id= $id;";
    
  
    
    $entrada = mysqli_query ($db, $consulta);
    
    $resultado = array();
    if($entrada && mysqli_num_rows($entrada)>= 1){
        $resultado = mysqli_fetch_assoc($entrada); 
    }
    return $resultado;
}


function conseguirEntradas ($db, $limit=null, $categoria=null, $busqueda=null){
    $consulta= "SELECT e.*, c.nombre AS 'categoria' FROM entradas e INNER JOIN categorias c ON e.categoria_id=c.id";
    
    if(!empty($categoria)){
        
        $consulta.=" WHERE e.categoria_id='$categoria'"; 
    }
    
     if(!empty($busqueda)){
        
        $consulta.=" WHERE e.titulo LIKE '%$busqueda%'"; 
    }
    
    $consulta.=" ORDER BY e.id DESC";
    
    if($limit){
        
        $consulta.=" LIMIT 4";
        //$consulta = $consulta." LIMIT 4";
    }

    
    $entradas = mysqli_query($db, $consulta);
    
    $resultado=0;
    if($entradas && mysqli_num_rows($entradas)>= 1){
        
        $resultado=$entradas;
    }
 
    return $resultado;
}




