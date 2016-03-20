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
						<h2>Nuestros Productos</h2>
                            <form enctype='multipart/form-data' action='<?= $_SERVER['PHP_SELF'] ?>' method='post'>
<input name='uploadedfile' type='file'><br>
<input type='submit' name="btn_subir_imagen" value='Subir archivo'>
</form>

<?php include ("imagenes_productos.php"); ?>
							
							<?php 
							
							 if (isset($_POST["btn_subir_imagen"])) {
							
							
$target_path = "uploads/";
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
{ 
echo "<span style='color:green;'>El archivo ". basename( $_FILES['uploadedfile']['name']). " ha sido subido</span><br>";
}else{
echo "<a>Ha ocurrido un error, trate de nuevo!</a>";
} 
							 }

							 
?>
                            <div style="clear: both;">&nbsp;</div>
                        </div>
                        <!-- end #content -->
                        <div id="sidebar">
                            <ul>
                                <li>
                                    <div id="search" >
                                        <?php include ("buscador.php"); ?>
                                    </div>
                                    <div style="clear: both;">&nbsp;</div>
                                </li>
                                <li>
                                    <h2>Nuestras Delicias</h2>
                                    <p>Ofrecemos la mas alta calidad de sanduches de chancho y pavo, con el sabor mas exquisito de Guayaquil.</p>
                                </li>
                                <li>
                                    <h2>Categorias</h2>
                                    <?php include ("categorias.php"); ?>
                                    <?php include ("salir.php"); ?>
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
