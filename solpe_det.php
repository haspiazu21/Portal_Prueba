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
                            <h2>Detalle de Solicitud de Pedido</h2>
                            <form id="form_condiciones" name="formcondition" method="post" action="solpe.php">
                                <table>
                                    <tr>
                                        <td>Fecha de Entrega</td>
                                        <td><input name="fe_entrega" type="date" id="fe_entrega"></input></td>
                                    </tr>
                                    <tr>
                                        <td>Lugar de Entrega</td>
                                        <td><select name="lu_entrega" type="select" id="lu_entrega">
                                                <option selected="selected" value="0">Seleccione...</option>
                                                <option value="1">Alborada</option>
                                                <option value="2">Sauces</option>
                                                <option value="3">Guayacanes</option>
                                                <option value="4">Samanes</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Condicion de Entrega</td>
                                        <td><select name="cd_entrega" type="select" id="cd_entrega">
                                                <option selected="selected">Opción 1</option>
                                                <option>Opción 2</option>
                                                <option>Opción 3</option>
                                                <option>Opción 4</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Restricion de Entregas</td>
                                        <td><select name="re_entrega" type="select" id="re_entrega">
                                                <option>25</option>
                                                <option>30</option>
                                                <option>40</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input name="grabar_condiciones" type="submit" value="Grabar"></input></td>

                                    </tr>
                                </table>
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
