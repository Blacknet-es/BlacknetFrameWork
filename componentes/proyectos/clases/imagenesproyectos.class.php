<?php

class imagenesproyecto extends listado
{
     
    public function __construct($id_proyecto = '') {
        global $app;
        $c = new mysql($app);
        $consulta = "SELECT id FROM proyectosimagenes WHERE id_proyecto = $id_proyecto";

        $res = $c->consulta($consulta);

        while ($row = $c->extarerArray($res)) {
            $p = new imgproyecto($row['id']);
            $this->elementos[] = $p;
        }        
    }

    public function buscarNombre($nombre){
        foreach ($this->categoria as $c){
            if ($c->nombre == $nombre){
                return $c->id;
            }
            return 0;
        }
    }
}
