<?php

session_start();
include "controladores/queries.php";

echo '<script language="JavaScript1.2" src="js/script.js"></script>';
echo '<div class="success">Bienvenido estimad@ "' . $_SESSION['usuario'] . '". Favor registre su pedido.</div>';
echo '<table id="tbl_producto" border="0" >
        <tr>
            <th><b>Id Producto</b></td>
            <th><b>Descripcion</b></td>
            <th><b>Cantidad Stock</b></td>
            <th><b>Precio</b></td>
            <th><b>Iva</b></td>
            <th><b>Pedido</b></td>
        </tr>';

$result = mysql_query("SELECT * FROM `productos`") or trigger_error(mysql_error());

while ($row = mysql_fetch_array($result)) {

    foreach ($row AS $key => $value) {
        $row[$key] = stripslashes($value);
    }
    echo "<tr>";
    echo "<td valign='top'>" . nl2br($row['pro_id_producto']) . "</td>";
    echo "<td valign='top'>" . nl2br($row['pro_descripcion']) . "</td>";
    echo "<td valign='top'>" . nl2br($row['pro_cantidad_stock']) . "</td>";
    echo "<td valign='top'>" . nl2br($row['pro_precio']) . "</td>";
    echo "<td valign='top'>" . nl2br($row['pro_iva']) . "</td>";
    echo "<td valign='top'><input value=0 type=text id=pro_pedido_" . $row['pro_id_producto'] . "></td>";
    echo "</tr>";
}

echo'</table>';
echo '<br class="clear"/>
	  <form id="form_solpedet" action="#" method="post">
        <input name="btn_solicitar" type="submit" value="Registrar Pedido" onclick="datosTextos()"/>
      </form>
	  <br class="clear"/>
	  <form id="form_salir" action="" method="post">
        <input name="logout" type="submit" value="Salir">
	  </form>
      <br class="clear"/>';

$datos_cab = array();
$datos_det = array();

if (isset($_POST["btn_solicitar"])) {
    echo "entra aqui solicitar";

    /* Cabecera */
    $pec_id_pedido = "NULL";
    $pec_fecha_entrega = "'" . date('Y-m-d') . "'";
    $pec_fecha_pedido = "'" . date('Y-m-d') . "'";
    $pec_lugar_pedido = "'Guayaquil'";
    $pec_condicion_pago = 1;
    $pec_condicion_entrega = 1;
    $pec_usuario = "'" . $_SESSION['usuario'] . "'";
    $pec_estado = "'N'";


    $datos_cab = array($pec_id_pedido,
        $pec_fecha_entrega,
        $pec_fecha_pedido,
        $pec_lugar_pedido,
        $pec_condicion_pago,
        $pec_condicion_entrega,
        $pec_usuario,
        $pec_estado,);

    //print_r($datos_cab);
    //$resultado_cab = insertar_pedido_cab($datos_cab, $result);
    //$id_pedido_grabado = $resultado_cab;

    /* Detalle */

    echo '<script> var textos = "tbl_producto";
    for (var i = 0; i < document.getElementById("tbl_producto").rows.length; i++) {
        for (var j = 0; j < 5; j++) {
            textos = document.getElementById("tbl_producto").rows[i].cells[j].innerHTML;
            if ((i > 0) && (j = 6)) {
                alert("codigo producto: "+textos);
                var valor = document.getElementById("pro_pedido_" + textos).value;</script>';
    echo '<script> alert("valor pedido: "+valor);</script>';
    echo '<script>           
            }

        }

    }
    </script>';
    
    
    echo '<script>var variablejs = "contenido de la variable javascript" ;</script>';
    $variablephp = "<script> document.write(variablejs) </script>";
    echo "variablephp = $variablephp";

    for ($i = 1; $i <= 10; $i++) {
        echo $i;
    }


    $ped_id_detalle = "NULL";
    $ped_id_pedido = $id_pedido_grabado;
    $ped_id_producto = 1;
    $precio = 1.25;
    $iva = 0.12;
    $ped_cantidad_pedida = 2;
    $ped_subtotal_pedido = $ped_cantidad_pedida * $precio;
    $ped_total_pedido = $ped_subtotal_pedido * (1 + $iva);

    $datos_det = array($ped_id_detalle,
        $ped_id_pedido,
        $ped_id_producto,
        $ped_cantidad_pedida,
        $ped_subtotal_pedido,
        $ped_total_pedido,);

    print_r($datos_det);

    //insertar_pedido_det($datos_det, &$result);
    //header("location: solpe_det.php");
}


                   