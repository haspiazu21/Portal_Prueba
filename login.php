<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include ("header.php"); ?>
        <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
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
                            <h2>Ingresar al Sistema</h2>
                            <br></br>
                            <fieldset>
                                <legend>Login</legend>
                                <form id="form_login" name="formlogin" method="post" action="logear.php">
                                    <table>
                                        <tr>
                                            <td>Usuario</td>
                                            <td><input name="user" type="text" id="user" ></input></td>
                                        </tr>
                                        <tr>
                                            <td>Contraseña</td>
                                            <td><input name="password" type="password" id="password"></input></td>
                                        </tr>
                                        <tr>
                                            <td><input name="login" type="submit" value="Ingresar"></input></td>
                                        </tr>
                                    </table>
                                </form>
                            </fieldset>
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
                                    <h2><b>Nuestras Delicias</b></h2>
                                    <p>Ofrecemos la mas alta calidad de sanduches de chancho y pavo, con el sabor mas exquisito de Guayaquil.</p>

                                </li>
                                <li>
                                    <h2>Categorias</h2>
                                    <?php include ("categorias.php"); ?>
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