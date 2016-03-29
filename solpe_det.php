<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
$num_pedido=$_GET['num_pedido'];
$n_usuario=$_GET['n_usuario'];

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ("header.php"); ?>
</head>
<body>
	<div id="wrapper">
	<?php include ("menu.php"); ?>

		<!-- end #menu -->
		<div id="header">
		<?php include ("logo_cabecera.php"); ?>
		</div>
		<!-- end #header -->
		<div id="page">
			<div id="page-bgtop">
				<div id="page-bgbtm">
					<div id="content">
						<h2>Detalle de Solicitud de Pedido</h2>
						<form id="form_condiciones" method="post" action="">
							<table>
								<tr>
									<td>Fecha de Entrega</td>
									<td><input name="fe_entrega" type="date" id="fe_entrega"
										value=<?php echo date('Y-m-d')?>></input></td>
								</tr>
								<tr>
									<td>Lugar de Entrega</td>
									<td><select name="lu_entrega">
											<option selected="selected" value="Seleccione">Seleccione...</option>
											<option value="Alborada">Alborada</option>
											<option value="Sauces">Sauces</option>
											<option value="Guayacanes">Guayacanes</option>
											<option value="Samanes">Samanes</option>
											<option value="Garzota">Garzota</option>
									</select>
									</td>
								</tr>
								<tr>
									<td>Condicion de Entrega</td>
									<td><select name="cd_entrega">
											<option value="CP" selected="selected">Contra Pago</option>
											<option value="CD">Contra Debito</option>
									</select>
									</td>
								</tr>
								<tr>
									<td>Restricion de Entregas</td>
									<td><select name="re_entrega">
											<option value="30" selected="selected">30 min</option>
											<option value="45">45 min</option>
											<option value="60">60 min</option>
											<option value="120">120 min</option>
									</select>
									</td>
								</tr>
								<tr>
									<td><input id="g_condicion" name="grabar_condiciones"
										type="submit" value="Grabar"></input></td>
								</tr>
							</table>
						</form>

						<?php

						include "controladores/queries.php";
						$dato_condicion=array();
						$result=0;

						if (isset($_POST['grabar_condiciones'])){

							$dato_condicion=array('id'=>"null",
							'fe_entrega'=>$_POST['fe_entrega'],
							'lu_entrega'=>$_POST['lu_entrega'],
							'cd_entrega'=>$_POST['cd_entrega'],
							're_entrega'=>$_POST['re_entrega'],
							'np_entrega'=>$num_pedido,
							'nu_entrega'=>$n_usuario);

							insertar_condicion_pedido($dato_condicion, $result);
							echo $result;
						}

						if ($result){
							header("location: pagos.php?num_pedido=$num_pedido"."&n_usuario=".$n_usuario."");
						}
							
						?>




					</div>
					<!-- end #content -->
					<div id="sidebar">
						<ul>
							<li>
								<div id="search">
								<?php include ("buscador.php"); ?>
								</div>
								<div style="clear: both;">&nbsp;</div>
							</li>
							<li>
								<h2>Nuestras Delicias</h2>
								<p>Ofrecemos la mas alta calidad de sanduches de chancho y pavo,
									con el sabor mas exquisito de Guayaquil.</p>
							</li>
							<li>
								<h2>Categorias</h2> <?php include ("categorias.php"); ?> <?php include ("salir.php"); ?>
							</li>

						</ul>
					</div>
					<!-- end #sidebar -->
					<div style="clear: both;">&nbsp;</div>
				</div>
			</div>
		</div>
		<!-- end #page -->
	</div>
	<?php include ("footer.php"); ?>
	<!-- end #footer -->
</body>
</html>
