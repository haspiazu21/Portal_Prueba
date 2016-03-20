<?php

include "controladores/conexion.php";

function verificar_login($user, $password, &$result) {
    $sql = "SELECT * FROM usuarios WHERE us_usuario = '$user' and us_password = '$password'";
    $rec = mysql_query($sql);
    $count = 0;
    while ($row = mysql_fetch_object($rec)) {
        $count++;
        $result = $row;
    }
    if ($count == 1) {
        return 1;
    } else {
        return 0;
    }
}

function verificar_cliente($cliente, &$result) {

    //var_dump($cliente);

    $sql = "SELECT * FROM clientes WHERE cli_ruc_dni = '$cliente' LIMIT 0, 1";
    $rec = mysql_query($sql);

    $count = 0;
    while ($row = mysql_fetch_object($rec)) {
        $count++;
        $result = $row;
    }

    //var_dump($result);

    if ($count == 1) {
        return 1;
    } else {
        return 0;
    }
}

function insertar_cliente($datos, &$result) {

    //var_dump($datos);
//INSERT 
    $query = " INSERT INTO clientes ( cli_id_cliente, cli_ruc_dni, cli_telefono, cli_email, cli_nombre )  "
            . "VALUES ( 'NULL', '$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]' ) ";
    $result = mysql_query($query);

    if ($result) {
        echo 'Success';
    } else {
        echo 'Query Failed';
    }
}

function insertar_usuario($datos, &$result) {

    // var_dump($datos);
//INSERT 
    $query = "INSERT INTO usuarios(idusuario, us_usuario, us_password,us_ruc_dni) "
            . "VALUES ('NULL', '$datos[0]','$datos[1]','$datos[1]')";

    $result = mysql_query($query);

    if ($result) {
        echo 'Success';
    } else {
        echo 'Query Failed';
    }
}

function consultar_productos(&$result) {

    $query = "SELECT pro_id_producto, pro_descripcion, pro_cantidad_stock, pro_precio, pro_iva "
            . "FROM productos";
    $result = mysql_query($query);


    if ($result) {
        echo 'Success';
    } else {
        echo 'Query Failed';
    }
}

function insertar_pedido_cab($datos, &$result) {

    // var_dump($datos);
//INSERT 

    $query = "INSERT INTO pedidos_cabecera(pec_id_pedido, pec_fecha_entrega, pec_fecha_pedido, pec_lugar_pedido, "
            . "pec_condicion_pago, pec_condicion_entrega,pec_usuario,pec_estado) "
            . "VALUES ($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$datos[6],$datos[7])";

    $result = mysql_query($query);

    $query = mysql_query("SELECT @@identity AS id");

    if ($row = mysql_fetch_row($query)) {
        $id = trim($row[0]);
    }

    if ($result) {
        echo 'Se registró su pedido, exitosamente';
        return $id;
    } else {
        echo 'Hubo un error en el registro, favor intente nuevamente';
    }
}

function insertar_pedido_det($datos, &$result) {

    // var_dump($datos);
//INSERT 
    $query = "INSERT INTO pedidos_detalle(ped_id_detalle, ped_id_pedido, ped_id_producto, "
            . "ped_cantidad_pedida, ped_subtotal_pedido, ped_total_pedido) "
            . "VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])";

    $result = mysql_query($query);

    if ($row = mysql_fetch_row($query)) {
        $id = trim($row[0]);
    }

    if ($result) {
        echo 'Success';
    } else {
        echo 'Query Failed';
    } if ($result) {
        echo 'Se registró su pedido, exitosamente';
        return $id;
    } else {
        echo 'Hubo un error en el registro, favor intente nuevamente';
    }
}

function consultar_pedidos(&$result) {

    $query = "SELECT * FROM pedidos_cabecera where ";
    $result = mysql_query($query);


    if ($result) {
        echo 'Success';
    } else {
        echo 'Query Failed';
    }
}
