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
                            <form id="form_pedidos_cab" name="form_pedidos_cab" method="POST" action="#" enctype="multipart/form-data">
                                <div id="content1">
                                    <h2>Cabecera y Detalle de Solicitudes de Pedido</h2>
                                    <?php include ("cabecera_pedido.php"); ?>
                                    <?php include ("detalle_pedido.php"); ?>
                                </div>
                                <div style="clear: both;">&nbsp;</div>
                            </form>


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
