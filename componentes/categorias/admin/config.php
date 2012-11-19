<?

global $menu;
$url = '';


if ($app->seccion == 'categorias') {
//Creamos un elemento jqgrid que nos ayudará a crear el jav
    $j = new jqgrid($url, 20, '', 'orden', 'asc', '', '');

//añadimos los campos que va a tener jqgrid
    $j->addCampo(new campo());
    $j->addCampo(new campo('Nombre', 'nombre', 'string', '50', true, true, false, ''));    
    $j->ordenable = true;

    $acciones = new acciones("Acciones");
}


$sec = new seccion("Categorías", "categorias", 'ui-icon-bookmark');

$menu->addSeccion($sec);