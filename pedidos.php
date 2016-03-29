<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<?php include ("header.php");?>
<body>
	<div id="wrapper">
	<?php include ("menu.php");?>
		<!-- end #menu -->
		<div id="header">
		<?php include ("logo_cabecera.php");?>
		</div>
		<!-- end #header -->
		<div id="page">
			<div id="page-bgtop">
				<div id="page-bgbtm">
					<div id="content">
						<h2>Generar Solicitud de Pedido</h2>
						<?php include ("iniciar_pedido.php");

						$ident_cantidad=array();
						$ident_cantidad=($_SESSION['identificadores']);

						$valor=array();
						foreach ($ident_cantidad as $valor) {
							$variables1[]=("($('#".$valor."').val())") ;

						}

						?>

						<form id="form_solpedet" action="#" method="post">
							<input name="btn_solicitar" id="btn_solicitar" type="button" href="javascript:;"
								onclick="realizaProceso($('#btn_solicitar').val(),$('#pro_pedido_2').val(), $('#pro_pedido_3').val(), $('#pro_pedido_4').val(), $('#pro_pedido_5').val(), $('#pro_pedido_6').val());return false; limpiarCajas();"
								value="Registrar Pedido"></input> Resultado:<span id="resultado">0</span>
						</form>
						<div style="clear: both;">&nbsp;</div>
					</div>
					<!-- end #content -->
					<div id="sidebar">
						<ul>
							<li>
								<div id="search">
								<?php include ("buscador.php");?>
								</div>
								<div style="clear: both;">&nbsp;</div>
							</li>
							<li>
								<h2>Nuestras Delicias</h2>
								<p>Ofrecemos la mas alta calidad de sanduches de chancho y pavo,
									con el sabor mas exquisito de Guayaquil.</p>
							</li>
							<li>
								<h2>Categorias</h2> <?php include ("categorias.php");?> <?php include ("salir.php"); ?>
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
	<?php include ("footer.php");?>
	<!-- end #footer -->
</body>
</html>
