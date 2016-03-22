<?php

session_start();
include "controladores/queries.php";


echo '<script language="JavaScript1.2" src="js/script.js"></script>';
//echo '<script type="text/javascript" src="/js/jquery.js"></script>';
echo '<script src="https://code.jquery.com/jquery.js"></script>';

echo '<div class="success">Bienvenido estimad@ "' . $_SESSION['usuario'] . '". Favor registre su pedido.</div>';
echo '<table id="tbl_producto" border="0" >
        <tr>
            <th><b>Id Producto</b></th>
            <th><b>Descripcion</b></th>
            <th><b>Cantidad Stock</b></th>
            <th><b>Precio</b></th>
            <th><b>Iva</b></th>
            <th><b>Pedido</b></th>
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
	echo "<td valign='top'><input value=0 type=text name=pro_pedido_" . $row['pro_id_producto'] . " id=pro_pedido_" . $row['pro_id_producto'] . "></td>";
	$identificadores[]= "pro_pedido_" . $row['pro_id_producto'];
	
	echo "</tr>";
	
	
}
$_SESSION['identificadores']=$identificadores;

echo'</table>
	  <br class="clear"/>
	  <form id="form_salir" action="" method="post">
        <input name="logout" type="submit" value="Salir">
	  </form>
      <br class="clear"/>';
//onclick="datosTextos()

$datos_cab = array();
$datos_det = array();

if (isset($_POST["btn_solicitar"])) {
	/*echo "entra aqui solicitar";*/

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
	$_SESSION['$pedido_grabado'] = $resultado_cab;

	$id_pedido_grabado= $_SESSION['$pedido_grabado'];

	/**************************************************************/
	/********************DETALLE***********************************/


}


