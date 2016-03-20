<?php

include "controladores/queries.php";

//var_dump('logineo: '.$_POST['login']);


session_start();

if (!isset($_SESSION['usuario'])) { //para saber si existe o no ya la variable de sesión que se va a crear cuando el usuario se logee
    if (isset($_POST['login'])) { //Si la primera condición no pasa, haremos otra preguntando si el boton de login fue presionado
        if (verificar_login($_POST['user'], $_POST['password'], $result) == 1) {
            session_start();
            $_SESSION['usuario'] = $result->us_usuario;
            echo '<div class="success">Bienvenido estimad@ "' . $_SESSION['usuario'] . '". Favor registre su pedido.</div>';
            header("location: pedidos.php");
        } else {
            echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>';
            header("location: logout.php");
        }
    }
} else {
    session_start();
    $_SESSION['usuario'] = $_SESSION['usuario'];

    echo '<div class="success">Su usuario ingreso correctamente.</div>';
    header("location: pedidos.php");
}

if (isset($_POST["logout"])) {
     header("location: logout.php");
}
