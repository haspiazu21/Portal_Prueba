<?php

include_once "controladores/queries.php";

$resultados = array();
if (isset($_POST["btn_registrar"])) {

    if ($_POST["btn_registrar"]) {

        if ($_POST["cli_ruc_dni"] == "") {
            echo '<div class="error">Debe ingresar el numero de identificacion.</div>';
        } else {

            //identificacion
            if (!(strlen($_POST["cli_ruc_dni"]) >= 10) && (strlen($_POST["cli_ruc_dni"]) <= 13)) {
                echo '<div class="error">Su identificacion no tiene el numero de digitos correcto, intente nuevamente.</div>';
            } else {
                //var_dump('hola');
                if (verificar_cliente($_POST["cli_ruc_dni"], $result) == 1) {
                    echo '<div class="success">Su identificacion es valida. Sr(a). ' . $result->cli_nombre . '</div>';
                    header("location: login.php");
                } else {
                    echo '<div class="error">Su identificacion no es valida. Debe registrarse completando el formulario</div>';
                    header("location: registrar_cliente.php");
                }
            }
        }

    }
    
    if (($a >=4) && (verificar_cliente($_POST["cli_ruc_dni"], $result) == 0)) {
        //$_SESSION['userid'] = $result->cli_nombre;
        $datos_c = array();
        $datos_c = array($_POST["cli_ruc_dni"], $_POST["cli_telefono"], $_POST["cli_email"], $_POST["cli_nombre"], $_POST["usr_login"]);
        $respuesta1 = insertar_cliente($datos_c, $result_a);

        $datos_u = array();
        $datos_u = array($_POST["usr_login"], $_POST["cli_ruc_dni"],);
        $respuesta2 = insertar_usuario($datos_u, $result_b);

        header("location: login.php");
        
    }else{
        header("location: registrar_cliente.php");
        var_dump($_SERVER['PHP_SELF']);
    }
}