<?php
session_start();
$id_pedido_grabado= 1;//$_SESSION['pedido_grabado'];

$resultado=array();

$detalles=array($_POST['pro_pedido_2'],
$_POST['pro_pedido_3'],
$_POST['pro_pedido_4'],
$_POST['pro_pedido_5'],
$_POST['pro_pedido_6']);

if (!empty($detalles)){
	$resultado = $detalles;
}

f_inserta_detalle($resultado);

//var_dump($resultado);

function f_inserta_detalle($valores){
	var_dump($valores);


	/* Detalle */
	$ped_id_detalle = "NULL";
	$ped_id_pedido = $id_pedido_grabado;
	$ped_id_producto = 1;
	$precio = 1.25;
	$iva = 0.12;
	$ped_cantidad_pedida = $valores[0];
	$ped_subtotal_pedido = $ped_cantidad_pedida * $precio;
	$ped_total_pedido = $ped_subtotal_pedido * (1 + $iva);

	$datos_det = array($ped_id_detalle,
	$ped_id_pedido,
	$ped_id_producto,
	$ped_cantidad_pedida,
	$ped_subtotal_pedido,
	$ped_total_pedido,);

	print_r($datos_det);
}
//insertar_pedido_det($datos_det, &$result);
//header("location: solpe_det.php");
