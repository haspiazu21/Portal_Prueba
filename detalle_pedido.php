<?php

echo '<form id="form_pagar" action="pagos.php" method="post">
            <input name="pago" type="submit" value="Pagar Cuenta">
      </form>';
	  
	  if (isset($_POST["pago"])){
		  header("location: pagos.php");
	  }