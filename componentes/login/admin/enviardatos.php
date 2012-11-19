<?php
$nick = $_POST['nick'];
$pass = $_POST['pass'];

$usuario = new usuario();


if($usuario->login($nick, $pass)){
    echo "DATOS OK";
    $r = new registro($usuario->id, "entrado en el sistema");
    $r->guardar();
}
else{
    header("HTTP/1.0 404 Not Found");
}


?>