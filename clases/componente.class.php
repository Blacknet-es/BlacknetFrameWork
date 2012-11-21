<?php

/**
 * Esta clase generaliza todos los componentes que se agregaran.
 * Cada componente debe extender de este.
 *
 * @author Difusión Gráfica
 */
class componente {
    
    var $id;
    var $orden;
    var $nombre;
    var $metades;
    var $metatags;

    function existePropiedad($propiedad){
        return property_exists($this, $propiedad);
    }
   
}

class listado{
    var $elementos = array();

    function numeroElementos(){
        return count($this->elementos);
    }

    function existePropiedad($propiedad){
        return property_exists($this, $propiedad);
    }
}
?>
