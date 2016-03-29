
<?php
$num_pedido=$_GET['num_pedido'];
$n_usuario=$_GET['n_usuario'];

?>
<form name="PAGOS" action="" method="POST" >
	<div class="col-1">
		<table border="0" width="300" cellspacing="1" cellpadding="1">

			<thead>
				<tr>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Tipo de Pago</td>
					<td><select autofocus="true" name="ls_tipo_pago">
							<option value="0">Seleccione...</option>
							<option selected="selected" value="EFE">Efectivo</option>
							<option value="TAR">Tarjeta</option>
					</select></td>
				</tr>

				<tr>
					<th>Numero de Tarjeta</th>
					<th><input type="number" name="txt_tarjeta" value="" size="30" /></th>
				</tr>
				<tr>
					<td>Tipo Tarjeta</td>
					<td><select autofocus="true" name="ls_tipo_tarjeta">
							<option selected="selected" value="0">Seleccione...</option>
							<option value="DEB">Debito</option>
							<!--<option value="CRE">Credito</option>-->
					</select></td>
				</tr>
				<tr>
					<td>Tipo de Cuenta</td>
					<td><select autofocus="true" name="ls_tipo_cuenta">
							<option selected="selected" value="0">Seleccione...</option>
							<option value="AHO">Ahorro</option>
							<option value="COR">Corriente</option>
					</select></td>
				</tr>
				<tr>
					<td>Banco</td>
					<td><select autofocus="true" name="ls_banco">
							<option selected="selected" value="0">Seleccione...</option>
							<option value="Austro">Austro</option>
							<option value="Bolivariano">Bolivariano</option>
							<option value="Guayaquil">Guayaquil</option>
							<option value="Pichincha">Pichincha</option>
							<option value="Produbanco">Produbanco</option>
					</select></td>
				</tr>
				<tr>
					<th>Bin Seguridad</th>
					<th><input type="number" name="txt_tarjeta_seguridad" id="txt_tarjeta_seguridad" value=""
						size="30" /></th>
				</tr>
				<tr>
					<td>Pagar</td>
					<td><input type="submit" value="Finalizar Compra"
						name="btn_terminar_compra" /></td>
				</tr>

			</tbody>

		</table>
	</div>
</form>

<?php

include "controladores/queries.php";
$errores=array();
if (isset($_POST['btn_terminar_compra'])){


	if ($_POST['ls_tipo_pago']=='EFE') {
		echo('<br></br>');
		echo('<td>Pago con Dinero en Efectivo: </td>');


		//Validar numero de pedido
		if (isset($num_pedido)){
			if ($num_pedido=="") {
				$errores[]=1;
				echo ('<div class="error">No se puede realizar el pago. Debe seleccionar un pedido.</div>');
			}

		}

		//Validar numero de pedido
		if (isset($n_usuario)){
			if ($n_usuario=="") {
				$errores[]=1;
				echo ('<div class="error">Debe logearse antes de registrar el pago.</div>');
			}

		}


		if(count($errores)==0){
			$dato_pago=array('id'=>"null",
						'tr_fecha_transaccion'=>date("Y-m-d"),
						'txt_tarjeta'=>"null",
						'ls_tipo_cuenta'=>"NA",
						'ls_tipo_pago'=>$_POST['ls_tipo_pago'],						
						'ls_banco'=>"null",
						'txt_tarjeta_seguridad'=>"null",
						'np_entrega'=>$num_pedido,
						'nu_entrega'=>$n_usuario,);

		}

	}else {
		echo('<br></br>');
		echo('<td>Pago con Tarjeta: </td>');

		//Validar numero de tarjeta
		if ($_POST['txt_tarjeta']=="") {
			$errores[]=1;
			echo('<div class="error">Favor debe ingresar el numero de su tarjeta.</div>');

		}

		if (isset($_POST['txt_tarjeta'])){
			if (strlen($_POST['txt_tarjeta'])<14) {
				echo('<div class="error">El numero de tarjeta ingresado no cumple con los digitos minimos (14).</div>');
				$errores[]=1;
			}else {

				if(strlen($_POST['txt_tarjeta'])>16){
					echo('<div class="error">El numero de tarjeta ingresado no cumple con el standar.</div>');
					$errores[]=1;
				}
			}
		}


		//Validar tipo de tarjeta
		if (isset($_POST['ls_tipo_tarjeta'])){
			if ($_POST['ls_tipo_tarjeta']=='0') {
				$errores[]=1;
				echo ('<div class="error">Favor seleccione un Tipo de Tarjeta.</div>');
			}

		}



		//Validar tipo de cuenta
		if (isset($_POST['ls_tipo_cuenta'])){
			if ($_POST['ls_tipo_cuenta']=='0') {
				$errores[]=1;
				echo ('<div class="error">Favor seleccione un Tipo de Cuenta.</div>');
			}

		}


		//Validar seleccion de Banco

		if ($_POST['ls_banco']=='0') {
			$errores[]=1;
			echo ('<div class="error">Favor seleccione un Banco.</div>');
		}

		//Validar codigo de seguridad ingresado
		if ($_POST['txt_tarjeta_seguridad']=="") {
			$errores[]=1;
			echo ('<div class="error">Favor ingrese los digitos de seguridad.</div>');
		}elseif ((strlen($_POST['txt_tarjeta_seguridad'])<3) or (strlen($_POST['txt_tarjeta_seguridad'])>5)) {
			$errores[]=1;
			echo ('<div class="error">Favor ingrese la cantidad de digitos se seguridad correctamente.</div>');
		}else {
		
		}

		if(count($errores)==0){
			$dato_pago=array('id'=>"null",
						'tr_fecha_transaccion'=>date("Y-m-d"),
						'txt_tarjeta'=>$_POST['txt_tarjeta'],
						'ls_tipo_cuenta'=>$_POST['ls_tipo_cuenta'],
						'ls_tipo_pago'=>$_POST['ls_tipo_pago'],						
						'ls_banco'=>$_POST['ls_banco'],
						'txt_tarjeta_seguridad'=>$_POST['txt_tarjeta_seguridad'],
						'nu_entrega'=>$n_usuario,
						'np_entrega'=>$num_pedido,);
		}


	}

	if(count($errores)==0){
		insertar_transaccion_pedido($dato_pago, $result);
		
		if ($result>0) {
			echo ('<div class="success">El proceso se ha registrado.</div>');
			header("location: fin_pedido.php");
		}
	}

}

function validartarjetas($cc){
	#eg. 718486746312031
	return preg_match('/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})$/', $cc);
}
