<?php

include "controladores/queries.php";
session_start();
if (isset($usuario)) {
	echo "";
} else {
	$usuario = $_SESSION['n_usuario'];
}

$result = mysql_query("SELECT pec_id_pedido, pec_fecha_entrega, "
. "pec_fecha_pedido, pec_lugar_pedido, pec_condicion_pago, "
. "pec_condicion_entrega, pec_usuario "
. "FROM pedidos_cabecera,transacciones WHERE tr_id_pedido=pec_id_pedido and tr_confirma_pago='N'  and pec_usuario='" . $usuario . "' order by pec_id_pedido DESC") or trigger_error(mysql_error());
echo "<br class=clear/>";
echo "<h3>Cabecera de Solicitudes de Pedido</h3>";

echo "<table id=ped_cab >";
echo "<tr>";
echo "<th valign='top'>Cod. Pedido</td>";
echo "<th valign='top'>Fecha Entrega</td>";
echo "<th valign='top'>Fecha Pedido</td>";
echo "<th valign='top'>Lugar Pedido</td>";
echo "<th valign='top'>Cond. Pago</td>";
//echo "<th valign='top'>Cond. Entrega</td>";
echo "<th valign='top'>Ver Detalle</td>";
echo "<th valign='top'>Pagar Pedido</td>";
echo "</tr>";

if ($result) {
	while ($row = mysql_fetch_array($result)) {
		foreach ($row AS $key => $value) {
			$row[$key] = stripslashes($value);
		}

		echo "<tr>";
		echo "<td valign='top'>" . nl2br($row['pec_id_pedido']) . "</td>";
		echo "<td valign='top'>" . nl2br($row['pec_fecha_entrega']) . "</td>";
		echo "<td valign='top'>" . nl2br($row['pec_fecha_pedido']) . "</td>";
		echo "<td valign='top'>" . nl2br($row['pec_lugar_pedido']) . "</td>";
		echo "<td valign='top'>" . nl2br($row['pec_condicion_pago']) . "</td>";
		//echo "<td valign='top'>" . nl2br($row['pec_condicion_entrega']) . "</td>";
		echo "<td valign='top'><a href=solpe.php?num_pedido=" . $row['pec_id_pedido'] . ">Ver detalle</a></td>";
		echo "<td valign='top'><a href=solpe_det.php?num_pedido=" . $row['pec_id_pedido']."&n_usuario=".$usuario.">Pagar...</a></td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<br class=clear/>";
}

$pedido = $_GET['num_pedido'];

if (!isset($_GET['num_pedido'])) {
	echo "Debe especificar un valor a buscar";
	echo "</html></body> \n";
	exit;
} else {

	$result = mysql_query("SELECT ped_id_detalle, ped_id_pedido, "
	. "ped_id_producto, ped_cantidad_pedida, "
	. "ped_subtotal_pedido, ped_total_pedido "
	. "FROM pedidos_detalle,transacciones WHERE tr_id_pedido=ped_id_pedido and tr_confirma_pago='N' and ped_id_pedido=" . $pedido . "") or trigger_error(mysql_error());
}

if ($result) {

	echo "<br class=clear/>";
	echo "<h3>Detalle de Solicitud de Pedido seleccionada</h3>";
	
	echo "<table id=ped_det >";
	echo "<tr>";
	echo "<th valign='top'>Id detalle pedido</td>";
	echo "<th valign='top'>Id cabecera pedido</td>";
	echo "<th valign='top'>Producto</td>";
	echo "<th valign='top'>Cantidad</td>";
	echo "<th valign='top'>Subtotal</td>";
	echo "<th valign='top'>Total</td>";
	echo "<th valign='top'>Cancelar</td>";
	echo "</tr>";

	$total=0;
	if ($result) {
		while ($row = mysql_fetch_array($result)) {
			foreach ($row AS $key => $value) {
				$row[$key] = stripslashes($value);
			}
			
			$total+=$row['ped_total_pedido'];
			
			echo "<tr>";
			echo "<td valign='top'>" . nl2br($row['ped_id_detalle']) . "</td>";
			echo "<td valign='top'>" . nl2br($row['ped_id_pedido']) . "</td>";
			echo "<td valign='top'>" . nl2br($row['ped_id_producto']) . "</td>";
			echo "<td valign='top'>" . nl2br($row['ped_cantidad_pedida']) . "</td>";
			echo "<td valign='top'>" . nl2br($row['ped_subtotal_pedido']) . "</td>";
			echo "<td valign='top'>" . nl2br($row['ped_total_pedido']) . "</td>";
			echo "</tr>";
			
			
		}
			echo "<tr>";
			echo "<td valign='top'></td>";
			echo "<td valign='top'></td>";
			echo "<td valign='top'></td>";
			echo "<td valign='top'></td>";
			echo "<td valign='top'>Total</td>";
			echo "<td valign='top'>" . $total . "</td>";
			echo "</tr>";
		
		
	}
	echo "</table>";
	echo "<br class=clear/>";
}




?>