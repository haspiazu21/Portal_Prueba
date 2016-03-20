<?php 
if (!isset($_REQUEST['action'])){
	$action="";
}else{
$action=$_REQUEST['action']; 
}

if ($action=="")    /* display the contact form */ 
    { 
?> 
    <form id="contact_form" action="#" method="POST" enctype="multipart/form-data"> 
        <div class="row"> 
            <label for="name">Tu nombre:</label><br /> 
            <input id="name" class="input" name="name" type="text" value="" size="30" /><br /> 
        </div> 
        <div class="row"> 
            <label for="email">Tu email:</label><br /> 
            <input id="email" class="input" name="email" type="text" value="" size="30" /><br /> 
        </div> 
        <div class="row"> 
            <label for="message">Tu mensaje:</label><br /> 
            <textarea id="message" class="input" name="message" rows="7" cols="30"></textarea><br /> 
        </div> 
        <input type="hidden" name="action" value="submit"/> 
        <input id="submit_button" type="submit" value="Enviar email" /> 
    </form> 
<?php 
    } 
else    /* send the submitted data */ 
    { 
    $name=$_REQUEST['name']; 
    $email=$_REQUEST['email']; 
    $message=$_REQUEST['message']; 
    if (($name=="")||($email=="")||($message=="")) 
        { 
        echo "Todos los campos son obligatorios, por favor completa <a href=\"\">el formulario</a> nuevamente."; 
        } 
    else{         
        $from="From: $name<$email>\r\nReturn-path: $email"; 
        $subject="Mensaje enviado usando tu formulario de contacto"; 
        mail("haspiazu21@hotmail.com", $subject, $message, $from); 
        echo "¡Email enviado!"; 
        } 
    }   
?> 