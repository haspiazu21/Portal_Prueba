<?php

include "controladores/queries.php";

//var_dump('logineo: '.$_POST['login']);


session_start();

if (!isset($_SESSION['usuario'])) { //para saber si existe o no ya la variable de sesión que se va a crear cuando el usuario se logee
	if (isset($_POST['login'])) { //Si la primera condición no pasa, haremos otra preguntando si el boton de login fue presionado
		if (verificar_login($_POST['user'], $_POST['password'], $result) == 1) {
			session_start();
			$_SESSION['n_usuario'] = $result->us_usuario;

			$cookie_name = "n_usuario";
			$cookie_value = $result->us_usuario;
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

			echo '<div class="success">Bienvenido estimad@ "' . $_SESSION['n_usuario'] . '". Favor registre su pedido.</div>';
			header("location: pedidos.php?n_usuario=".$_SESSION['n_usuario']."");
		} else {
			header("location: login.php?error=1");
		}
	}
} else {
	session_start();
	$_SESSION['n_usuario'] = $_SESSION['n_usuario'];

	echo '<div class="success">Su usuario ingreso correctamente.</div>';
	header("location: pedidos.php");
}

if (isset($_POST["logout"])) {
	header("location: logout.php");
}
