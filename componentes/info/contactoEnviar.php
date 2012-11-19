<?php
/* DIFF 3.0 By Difusion Grafica
 * Framework php dinámico
 */


/* RECIBIMOS LOS DATOS DEL FORMULARIO */

$tipo_consulta = $_POST['consulta'];
$nombre = $_POST['nombre'];
$empresa = $_POST['empresa'];
$telefono = $_POST['telefono'];

$de = $_POST['mail'];

$provincia = $_POST['provincia'];
$poblacion = $_POST['poblacion'];

$texto = $_POST['texto'];

/* RECIBIMOS EL FICHERO ADJUNTO */
$fichero = '';
$nombref = "";
if ($_FILES['adjunto']['tmp_name'] != ""){
    $fichero = $_FILES['adjunto']['tmp_name'];
    $nombref = $_FILES['adjunto']['name'];
}

/* PREPARAMOS LOS DATOS PARA EL ENVÍO DEL MAIL */
switch ($tipo_consulta){
    case 1:
        $titulo = "$nombre te ha enviado su currículum desde Difusión Gráfica";
        break;
    case 2:
        $titulo = "$nombre de la empresa $empresa solicita presupuesto desde Difusión Gráfica";
        break;
    case 3:
        $titulo = "$nombre tiene ha enviado consulta técnica desde Difusión Gráfica";
        break;
    case 4:
        $titulo = "$nombre necesita información sobre productos y servicios de Difusión Gráfica";
        break;
}


include($app->ruta_absoluta.'/componentes/info/contactoPlantilla.php');

/* PREPARAMOS EL EMAIL */
$mail = new PHPMailer(true); //Creamos el objeto mail

$mail->IsHTML(true);
$mail->CharSet = 'UTF-8';


$mail->Subject = $titulo;
$mail->Body = $correo;

$mail->SetFrom($de,$nombre);
$mail->AddAddress('info@difusiongrafica.com','Contacto Difusión Gráfica');
$mail->AddAddress('correo2@localhost','Correo de prueba Difusión Gráfica');

if($fichero != ''){
    $mail->AddAttachment($fichero,$nombref);
}

$mail->Send();




mostrarComponente($app->seccion,'menu');

?>

<p>Su formulario de ha enviado correctamente.</p>