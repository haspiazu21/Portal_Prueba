<?php

session_start();
include "controladores/queries.php";


echo '<script language="JavaScript1.2" src="js/script.js"></script>';
echo '<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>';
echo '<script src="https://code.jquery.com/jquery.js"></script>';

$nombre_usuario="";
if (isset($_SESSION['n_usuario'])) {
	
	$nombre_usuario=strtoupper($_SESSION['n_usuario']);
}

echo '<div class="success">Bienvenid@ "' . $nombre_usuario . '". Favor registre su pedido.</div>';
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

echo'</table>';




