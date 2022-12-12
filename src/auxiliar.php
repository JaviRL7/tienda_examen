<?php

function conectar()
{
    return new \PDO('pgsql:host=localhost,dbname=tienda', 'tienda', 'tienda');
}

function hh($x)
{
    return htmlspecialchars($x ?? '', ENT_QUOTES | ENT_SUBSTITUTE);
}

function dinero($s)
{
    return number_format($s, 2, ',', ' ') . ' €';
}

function obtener_get($par)
{
    return obtener_parametro($par, $_GET);
}

function obtener_post($par)
{
    return obtener_parametro($par, $_POST);
}

function obtener_parametro($par, $array)
{
    return isset($array[$par]) ? trim($array[$par]) : null;
}

function volver()
{
    header('Location: /index.php');
}

function carrito()
{
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = serialize(new \App\Generico\Carrito());
    }

    return $_SESSION['carrito'];
}

function carrito_vacio()
{
    $carrito = unserialize(carrito());

    return $carrito->vacio();
}

function volver_admin()
{
    header("Location: /admin/");
}

function redirigir_login()
{
    header('Location: /login.php');
}

function validar_contraseña($password, &$error){
    if(strlen($password) < 8){
       $error['password_validada'] = "La contraseña debe tener al menos 8 caracteres";
       return false;
    }
    if (!preg_match('`[a-z]`',$password)){
       $error['password_validada'] = "La contraseña debe tener al menos una letra minúscula";
       return false;
    }
    if (!preg_match('`[A-Z]`',$password)){
       $error['password_validada'] = "La contraseña debe tener al menos una letra mayúscula";
       return false;
    }
    if (!preg_match('`[0-9]`',$password)){
        $error['password_validada'] = "La contraseña debe tener al menos un caracter numérico";
       return false;
    }
    if (!preg_match('`[[:punct:]]`',$password)){
        $error['password_validada'] = "La contraseña debe tener al menos un caracter de puntuacion";
       return false;
    }
    return true;
 }
function comprobar_existencias($existencia, &$enlace_comprobado){
    if ($existencia < 1 ){
        $enlace_comprobado = "Sin existencias";
        return $enlace_comprobado;
    } else{
        $enlace_comprobado = "Añadir al carrito";
        return $enlace_comprobado;
    }
    }
function comprobar_enlace($existencia, &$enlace){
    if($existencia > 1){
        return $enlace;
    } else{
        $enlace = "sin existencias";
        return $enlace;
    }
}