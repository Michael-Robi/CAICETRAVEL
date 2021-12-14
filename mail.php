<?php 
$correo=$_POST['txtCorreo'];
$asunto=$_POST['txtAsunto'];
$mensaje=$_POST['textAMensaje'];

mail($correo, $asunto, $mensaje);

echo'<script type="text/javascript">
    alert("Mensaje enviado satisfactoriamente al correo: '.$correo.'"); window.location.href="index.html";
    </script>';
?>