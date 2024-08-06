<?php
    define("controlador","app/controller/");
    $control= isset($_GET['C'])? $_GET['C']:'';
    $ruta = controlador. $control . ".php";
    if (is_file($ruta)){
        require_once($ruta);
        $objeto = new $control();
        $metodo = isset($_GET['M']) ? $_GET['M']:'';
        
        if(method_exists($objeto,$metodo)){
            $objeto -> $metodo();
        }
    }
    else{
        require_once("app/controller/defaultController.php");
        $default= new defaultcontroller();
        $default->index();
    }
?>

