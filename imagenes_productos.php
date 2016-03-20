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
     <tr>
	 <br><?php echo ("Imagen: ".$numero ." - ".$file)?></br>
	 </tr>
	 <td>
	 <img src="<?php echo $ruta.$file ?>" width="150px"></img>
	 </td>
</table>
<?php
   } 
  } 
closedir($filehandle); // Fin lectura archivos
?>

