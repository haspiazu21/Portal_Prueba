<?php 

$ruta = "uploads/"; // Indicar ruta
 $filehandle = opendir($ruta); // Abrir archivos
  $numero=0;
  while ($file = readdir($filehandle)) {
   if ($file != "." && $file != "..") {
    $tamanyo = GetImageSize($ruta . $file);
	$numero++;
?>
<table id='imgproductos'>
     <td><?php echo ("Imagen: ".$numero ." - ".$file)?></td>
	 <tr><img src="<?php echo $ruta.$file ?>" width="150px"></img></tr>
</table>
<?php
   } 
  } 
closedir($filehandle); // Fin lectura archivos
?>

