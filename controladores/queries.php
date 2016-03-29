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

	//var_dump($datos);
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

function consultar_producto_id($iproducto,&$row) {

	$query = "SELECT pro_id_producto, pro_descripcion, pro_cantidad_stock, pro_precio, pro_iva "
	. "FROM productos WHERE pro_id_producto = '$iproducto' LIMIT 0, 1";
	$result = mysql_query($query);
	$row=mysql_fetch_array($result);

	//var_dump($row['pro_descripcion']);

	if ($result) {
		//echo 'Success';
	} else {
		//echo 'Query Failed';
	}
}


function insertar_pedido_cab($datos, &$id) {

	//var_dump($datos);
	//INSERT

	$query = "INSERT INTO pedidos_cabecera(pec_id_pedido, pec_fecha_entrega, pec_fecha_pedido, pec_lugar_pedido, "
	. "pec_condicion_pago, pec_condicion_entrega,pec_usuario,pec_estado) "
	. "VALUES ($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$datos[6],$datos[7])";

	$result = mysql_query($query);

	$query_a = mysql_query("SELECT @@identity AS id");

	if ($row = mysql_fetch_row($query_a)) {
		$id = trim($row[0]);
	}

	if ($result) {

		mysql_query("COMMIT");

	} else {

		mysql_query("ROLLBACK");
	}

}

function insertar_pedido_det($datos, &$numerodetalles) {

	//echo "Se insertaran detalles del pedido";

	$pedido=array();
	$numerodetalles=0;
	foreach ($datos as $key=>$value) {

		/*echo $value['ped_id_detalle'];
		 echo $value['ped_id_pedido'];
		 echo $value['ped_id_producto'];
		 echo $value['ped_cantidad_pedida'];
		 echo $value['ped_subtotal_pedido'];
		 echo $value['ped_total_pedido'];*/

		actualiza_producto($value['ped_cantidad_pedida'],$value['ped_id_producto']);
		
		
		//INSERT
		$query = "INSERT INTO pedidos_detalle(ped_id_detalle, ped_id_pedido, ped_id_producto, "
		. "ped_cantidad_pedida, ped_subtotal_pedido, ped_total_pedido) "
		. "VALUES (".$value['ped_id_detalle'].",".$value['ped_id_pedido'].",".$value['ped_id_producto'].",
		".$value['ped_cantidad_pedida'].",".$value['ped_subtotal_pedido'].",".$value['ped_total_pedido'].")";

		$result = mysql_query($query);
		$query_b = mysql_query("SELECT @@identity AS id");

		if ($result){
			if ($row = mysql_fetch_row($query_b)) {
				$id = trim($row[0]);
				$numerodetalles++;
			}
			mysql_query("COMMIT");

		}else {
			mysql_query("ROLLBACK");
		}

	}

	if ($numerodetalles>=1) {
		//echo 'Se registró su pedido, exitosamente';
		echo '<div class="ok">Se registró su detalle de pedido, exitosamente.</div>';

	} else {
		//echo 'Hubo un error en el registro, favor intente nuevamente';
		echo '<div class="error">Hubo un error en el registro de los detalles, favor intente nuevamente.</div>';
	}
	unset($query);
	unset($datos);

}

function actualiza_producto($valor,$param) {


	$query = "UPDATE productos SET pro_cantidad_stock=(pro_cantidad_stock-".$valor.")
			  WHERE pro_id_producto=".$param.";";
	
	//print $query;
	
	$result = mysql_query($query);


	if ($result) {
		echo 'Success';
	} else {
		echo 'Query Failed';
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


function insertar_condicion_pedido($datos, &$id) {

	//var_dump($datos);
	//INSERT

	$datos['id'];
	$datos['fe_entrega'];
	$datos['lu_entrega'];
	$datos['cd_entrega'];
	$datos['re_entrega'];
	$datos['np_entrega'];
	$datos['nu_entrega'];

	$query = "INSERT INTO condiciones_entrega(ce_id_condicion_entrega,ce_fecha, ce_lugar, ce_condicion,ce_restriccion, ce_pedido_asociado)
	VALUES (".$datos['id'].",'".$datos['fe_entrega']."','".$datos['lu_entrega']."','".$datos['cd_entrega']."',".$datos['re_entrega'].",".$datos['np_entrega'].")";

	print $query;

	$result = mysql_query($query);

	$query_a = mysql_query("SELECT @@identity AS id");

	if ($row = mysql_fetch_row($query_a)) {
		$id = trim($row[0]);
		//var_dump($row);
	}

	if ($result) {
		mysql_query("COMMIT");
		return $id;
	} else {
		mysql_query("ROLLBACK");
	}

}

function insertar_transaccion_pedido($datos, &$id) {

	//var_dump($datos);
	//INSERT

	$tr_id_transaccion=$datos['id'];
	$tr_fecha_transaccion=$datos['tr_fecha_transaccion'];
	$tr_num_tarjeta=$datos['txt_tarjeta']?$datos['txt_tarjeta']:'9999999999999999';
	$tr_tipo_cuenta=$datos['ls_tipo_cuenta']?$datos['ls_tipo_pago']:0;
	$tr_banco_emisor=$datos['ls_banco'];
	$tr_cod_seg_tarjeta=md5($datos['txt_tarjeta_seguridad'])?$datos['txt_tarjeta_seguridad']:'999';
	$tr_confirma_pago="N";
	$tr_id_cliente=$datos['nu_entrega'];
	$tr_id_pedido=$datos['np_entrega'];


	$query = "INSERT INTO transacciones(tr_id_transaccion, tr_fecha_transaccion, tr_num_tarjeta, tr_tipo_cuenta, tr_banco_emisor, tr_cod_seg_tarjeta, tr_confirma_pago, tr_id_cliente, tr_id_pedido)
	VALUES (".$tr_id_transaccion.",'".$tr_fecha_transaccion."',".$tr_num_tarjeta.",'".$tr_tipo_cuenta."','".$tr_banco_emisor."',".$tr_cod_seg_tarjeta.",'".$tr_confirma_pago."','".$tr_id_cliente."',".$tr_id_pedido.")";

	//print $query;

	$result = mysql_query($query);

	$query_a = mysql_query("SELECT @@identity AS id");

	if ($row = mysql_fetch_row($query_a)) {
		$id = trim($row[0]);
		//var_dump($row);
	}

	if ($result) {
		mysql_query("COMMIT");
		return $id;
	} else {
		mysql_query("ROLLBACK");
	}

}



