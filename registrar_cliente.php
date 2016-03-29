<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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
						<h2>Registrarse en el Sistema</h2>
						<br></br>
						<fieldset>
							<legend>Alta en el servicio</legend>
							<form id="form_indice" method="post"
								action="<?= $_SERVER['PHP_SELF'] ?>">
								<table>
									<tr>
										<td>Nombre Cliente</td>
										<td><input type="text" name="cli_nombre" id="cli_nombre"></input>
										</td>
									</tr>
									<tr>
										<td>Usuario</td>
										<td><input type="text" name="usr_login" id="usr_login"></input>
										</td>
									</tr>
									<tr>
										<td>Num. Identificacion</td>
										<td><input type="text" name="cli_ruc_dni" id="cli_ruc_dni"
											value=""></input></td>
									</tr>
									<tr>
										<td>Num. Telefono</td>
										<td><input type="number" name="cli_telefono" id="cli_telefono"
											value=""></input></td>
									</tr>
									<tr>
										<td>Correo Electronico</td>
										<td><input type="email" name="cli_email" id="cli_email"
											value=""></input>
										</td>
									</tr>
									<tr>
										<td><input type="submit" value="Registrar sus datos"
											name="btn_registrar"></input></td>
									</tr>
								</table>

								<?php

								include_once "controladores/queries.php";

								$resultados = array();
								echo '<script language="JavaScript1.2" src="js/script.js"></script>';

								if (isset($_POST["btn_registrar"])) {

									if ($_POST["btn_registrar"]) {
										if ($_POST["cli_nombre"] == "") {
											echo '<div class="error">Debe ingresar su nombre y apellido.</div>';
										} else {
											$resultados[] = "ok";

										}


										if ($_POST["usr_login"] == "") {

											echo '<div class="error">Debe ingresar un nickname.</div>';
										} else {
											$resultados[] = "ok";
										}

										if ($_POST["cli_ruc_dni"] == "") {
											echo '<div class="error">Debe ingresar su numero de identificacion.</div>';
										} else {
											if ((strlen($_POST["cli_ruc_dni"]) == 10) or (strlen($_POST["cli_ruc_dni"]) == 13)) {
												$resultados[] = "ok";

											} else {
													
												echo '<div class="error">Su identificacion no tiene el numero de digitos correcto (Min. 10 - Max. 13), intente nuevamente.</div>';
											}
										}

										if ($_POST["cli_telefono"] == "") {
											echo '<div class="error">Debe ingresar el numero de telefono(Celular,Convencional).</div>';
										} else {
											$resultados[] = "ok";
										}

										if ($_POST["cli_email"] == "") {
											echo '<div class="error">Debe ingresar el email.</div>';
										} else {
											$resultados[] = "ok";
										}


										$a = 0;
										foreach ($resultados as $key => $value) {
											if ($value == "ok") {
												$a++;
											}
										}

										if (verificar_cliente($_POST["cli_ruc_dni"], $result) == 1) {
											echo '<div class="success">Su identificacion ya esta registrada. Sr(a). ' . $result->cli_nombre . ' </div>';
										}

										if ($a === 5) {

											$datos_c = array();
											$datos_c = array($_POST["cli_ruc_dni"], $_POST["cli_telefono"], $_POST["cli_email"], $_POST["cli_nombre"], $_POST["usr_login"]);

											$respuesta1 = insertar_cliente($datos_c, $result_a);

											$datos_u = array();
											$datos_u = array($_POST["usr_login"], $_POST["cli_ruc_dni"],);

											$respuesta2 = insertar_usuario($datos_u, $result_b);

											if ($result_a && $result_b	) {

												echo '<div class="success">Ud se ha registrado correctamente. Sr(a). ' . $result_a->cli_nombre . '</div>';
												echo '<script> alert ("Bienvenido: "'.$result_a->cli_nombre.')</script>';

												verificar_cliente($_POST["cli_ruc_dni"], $result);
												$_SESSION['n_usuario']= $result->cli_nombre;
												header("location: login.php?user=".$result->cli_nombre."");

											}
											else {

												echo '<div class="error">Su identificacion no es valida. Debe registrarse completando el formulario</div>';
												//header("location: registrar_cliente.php");
											}

										}else {

											echo ('Ud ha cumplido con :' . $a . ' datos para el registro. Se requiere llenar 5 datos');
											//header("location: registrar_cliente.php");
										}
									}
								}
								?>
							</form>
						</fieldset>
						<div style="clear: both;">&nbsp;</div>
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

