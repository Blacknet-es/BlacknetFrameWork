<?php
class imgproyecto extends imagen{
    var $id;
    var $id_proyecto;
    var $nombre;
    var $descripcion;
    var $principal;

    public function __construct($id = '') {
        global $app;
        if ($id != '') {
            $c = new mysql($app);
            $consulta = "SELECT * FROM proyectosimagenes WHERE id = '$id'";

            $res = $c->consulta($consulta);
            $row = $c->extarerArray($res);

            $this->id = $id;
            $this->nombre = $row['nombre'];            
            $this->id_proyecto = $row['id_proyecto'];
            $this->descripcion = $row['descripcion'];
            $this->principal = $row['principal'];
            $this->ruta = $row['ruta'];
            $this->w = $row['w'];
            $this->h = $row['h'];
            $this->x = $row['x'];
            $this->y = $row['y'];
            $this->x2 = $row['x2'];
            $this->y2 = $row['y2'];
        }
    }

    public function guardar(){
        global $app;
        $c = new mysql($app);
        if ($this->id != ''){
            $c->consulta("UPDATE proyectosimagenes SET nombre = '$this->nombre', descripcion = '$this->descripcion', principal = '$this->principal', id_proyecto = '$this->id_proyecto', ruta = '$this->ruta', x='$this->x', y='$this->y', x2='$this->x2', y2='$this->y2', w='$this->w', h='$this->h' WHERE id = $this->id");
        }
        else{
            $res = $c->consulta("SELECT MAX(id) as maxi FROM proyectosimagenes");
            $row = $c->extarerArray($res);
            $this->id = $row['maxi'] + 1;
            $c->consulta("INSERT INTO proyectosimagenes (id,id_proyecto,nombre,ruta,descripcion,principal,x,y,x2,y2,w,h) VALUES ('$this->id','$this->id_proyecto','$this->nombre','$this->ruta','$this->descripcion','$this->principal','$this->x','$this->y','$this->x2','$this->y2','$this->w','$this->h')");
        }
        return 1;
    }

    public function eliminar(){
        global $app;
        $c = new mysql($app);

        $c->consulta("DELETE FROM proyectosimagenes WHERE id = '$this->id'");
        @unlink($app->ruta_absoluta.'/img/proyectos/'.$this->id_proyecto.'/'.$this->id.'.jpg');
        @unlink($app->ruta_absoluta.'/img/proyectos/'.$this->id_proyecto.'/'.$this->id.'.png');
        @unlink($app->ruta_absoluta.'/img/proyectos/'.$this->id_proyecto.'crop/'.$this->id.'.jpg');
        @unlink($app->ruta_absoluta.'/img/proyectos/'.$this->id_proyecto.'crop/'.$this->id.'.png');
    }
    

}
