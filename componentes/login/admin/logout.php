<?
$usuario = new usuario();
$usuario->logout();

$r = new registro($usuario->id,"salido del sistema");
$r->guardar();
?>