<?php
include ("controladores/queries.php");

session_start();

$datos_cab = array();

if (isset($_POST["btn_solicitar"])) {
	//echo "entra aqui solicitar";

	/* Cabecera */
	$pec_id_pedido = "NULL";
	$pec_fecha_entrega = "'" . date('Y-m-d') . "'";
	$pec_fecha_pedido = "'" . date('Y-m-d') . "'";
	$pec_lugar_pedido = "'Guayaquil'";
	$pec_condicion_pago = 1;
	$pec_condicion_entrega = 1;
	$pec_usuario = "'" . $_SESSION['n_usuario'] . "'";
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
	insertar_pedido_cab($datos_cab, $result);
	
	if ($result) {
		echo '<div class="success">Se registró su pedido, exitosamente.</div>';
		$id_pedido_grabado = $result;
	}else {

		echo '<div class="error">Hubo un error en el registro, favor intente nuevamente.</div>';
	}


}

$datos_det = array();
$resultado=array();

if (isset($id_pedido_grabado)){

	$detalles=array('2'=>$_POST['pro_pedido_2'],
				'3'=>$_POST['pro_pedido_3'],
				'4'=>$_POST['pro_pedido_4'],
				'5'=>$_POST['pro_pedido_5'],
				'6'=>$_POST['pro_pedido_6']);

	if (!empty($detalles)){
		$resultado = $detalles;

		f_inserta_detalle($resultado,$id_pedido_grabado);

	}
} else {
	echo '<div class="error">El detalle del pedido no ha sido generado.</div>';
}


//var_dump($resultado);

function f_inserta_detalle($valores,$cab_ped){
	//var_dump($valores);
	//echo "entro aqui";
	$sobrestock=0;

	foreach ($valores as $key=>$value) {
		consultar_producto_id($key,$result);

		$ped_id_detalle = "NULL";
		$ped_id_pedido = $cab_ped;

		$ped_id_producto =$result['pro_id_producto'];
		$pro_descripcion=$result['pro_descripcion'];
		$pro_stock=$result['pro_cantidad_stock'];
		$pro_precio =$result['pro_precio'];
		$pro_iva =$result['pro_iva'];

		/*verificar que haya stock disponible vs la cantidad que solicita el cliente */
		if ($pro_stock<$value) {
			echo '<div class="error">La cantidad pedida de '.$pro_descripcion.' supera el stock disponible: '.$pro_stock.' unds.</div>';
			$sobrestock++;
		}

		$ped_cantidad_pedida = $value;
		$ped_subtotal_pedido = $ped_cantidad_pedida * $pro_precio;
		$ped_total_pedido = $ped_subtotal_pedido * (1 + $pro_iva);

		if (($ped_cantidad_pedida>=1)&&($ped_cantidad_pedida<$pro_stock)) {

			$datos_det[] = array('ped_id_detalle'=>$ped_id_detalle,
			'ped_id_pedido'=>$ped_id_pedido,
			'ped_id_producto'=>$ped_id_producto,
			'ped_cantidad_pedida'=>$ped_cantidad_pedida,
			'ped_subtotal_pedido'=>$ped_subtotal_pedido,
			'ped_total_pedido'=>$ped_total_pedido,);
		}
	}
	//var_dump($datos_det);

	if ($sobrestock>0) {
		echo '<div class="error">Ingrese valores que no superen el stock disponible.</div>';
	}else {
		if (isset($datos_det)){
			insertar_pedido_det($datos_det, $result);
		}
	}

}

header("location: solpe.php?n_usuario=".$_SESSION['n_usuario']."");
exit();