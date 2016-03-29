<?php

include_once "controladores/queries.php";

$resultados = array();
echo '<script language="JavaScript1.2" src="js/script.js"></script>';

if (isset($_POST["btn_registrar"])) {

	if ($_POST["btn_registrar"]) {
		if ($_POST["cli_nombre"] == "") {
			echo '<div class="error">Debe ingresar su nombre y apellido.</div>';
		} else {
			$resultados[] = "ok";

		}


		if ($_POST["usr_login"] == "") {

			echo '<div class="error">Debe ingresar un nickname.</div>';
		} else {
			$resultados[] = "ok";
		}

		if ($_POST["cli_ruc_dni"] == "") {
			echo '<div class="error">Debe ingresar su numero de identificacion.</div>';
		} else {
			if ((strlen($_POST["cli_ruc_dni"]) == 10) or (strlen($_POST["cli_ruc_dni"]) == 13)) {
				$resultados[] = "ok";

			} else {
					
				echo '<div class="error">Su identificacion no tiene el numero de digitos correcto (Min. 10 - Max. 13), intente nuevamente.</div>';
			}
		}

		if ($_POST["cli_telefono"] == "") {
			echo '<div class="error">Debe ingresar el numero de telefono(Celular,Convencional).</div>';
		} else {
			$resultados[] = "ok";
		}

		if ($_POST["cli_email"] == "") {
			echo '<div class="error">Debe ingresar el email.</div>';
		} else {
			$resultados[] = "ok";
		}


		$a = 0;
		foreach ($resultados as $key => $value) {
			if ($value == "ok") {
				$a++;
			}
		}

		if (verificar_cliente($_POST["cli_ruc_dni"], $result) == 1) {
			echo '<div class="success">Su identificacion ya esta registrada. Sr(a). ' . $result->cli_nombre . ' </div>';
		}

		if ($a === 5) {

			$datos_c = array();
			$datos_c = array($_POST["cli_ruc_dni"], $_POST["cli_telefono"], $_POST["cli_email"], $_POST["cli_nombre"], $_POST["usr_login"]);

			$respuesta1 = insertar_cliente($datos_c, $result_a);

			$datos_u = array();
			$datos_u = array($_POST["usr_login"], $_POST["cli_ruc_dni"],);

			$respuesta2 = insertar_usuario($datos_u, $result_b);

			if ($result_a && $result_b	) {

				echo '<div class="success">Ud se ha registrado correctamente. Sr(a). ' . $result_a->cli_nombre . '</div>';
				header("location: login.php?user=".$result_a->cli_ruc_dni."");
			}
			else {

				echo '<div class="error">Su identificacion no es valida. Debe registrarse completando el formulario</div>';
				//header("location: registrar_cliente.php");
			}

		}else {

			echo ('Ud ha cumplido con :' . $a . ' datos para el registro. Se requiere llenar 5 datos');
			//header("location: registrar_cliente.php");
		}
	}
}
