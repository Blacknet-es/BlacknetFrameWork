<?php
class jqgrid
{
    var $url;
    var $rowNum;
    var $rowList = array();
    var $sortName;
    var $sortOrder;
    var $editUrl;
    var $ordenable;
    var $params = array();
    var $campos = array();

    public function __construct($url = '', $rowNum = 20, $rowList = "", $sorName = 'id', $sortOrder = 'DESC', $editUrl = '', $params = '')
    {
        global $app;

        if ($url == ''){
            $this->url = $app->ruta_admin.'/entorno.php?seccion='.$app->seccion.'&accion=list';
        } else {
            $this->url = $url;
        }

        if ($editUrl == '') {
            $this->editUrl = $app->ruta_admin.'/entorno.php?seccion='.$app->seccion.'&accion=procesar';
        } else {
            $this->editUrl = $editUrl;
        }

        if ($rowList == "") {
            $this->rowList[0] = 20;
            $this->rowList[1] = 40;
            $this->rowList[2] = 60;
        }

        $this->rowNum = $rowNum;
        $this->sortName = $sorName;
        $this->sortOrder = $sortOrder;
        $this->editUrl = $editUrl;
        $this->params = $params;
        $this->ordenable = false;
    }

    public function addCampo(campo $c)
    {
        $this->campos[] = $c;
    }
   

}/* FIN JQGRID*/

class campo 
{
    var $nombreColumna;
    var $nombreTabla;
    var $index;
    var $tipo;
    var $ancho;
    var $busqueda;
    var $ordenable;
    var $editable;
    var $editOptions = array();

    public function __construct($nombreColumna = 'ID', $nombreTabla = 'id', $tipo = 'string', $ancho = 10, $busqueda = true, $ordenable = true, $editable = false, $editOptions = '',$index = '') 
    {
        $this->nombreColumna = $nombreColumna;
        $this->nombreTabla = $nombreTabla;
        $this->tipo = $tipo;
        $this->ancho = $ancho;
        $this->busqueda = $busqueda;
        $this->ordenable = $ordenable;
        $this->editable = $editable;
        $this->editOptions = $editOptions;
        
        if ($index == ''){
            $this->index = $this->nombreTabla;
        } else {
            $this->index = $index;
        }
    }
}/* FIN CAMPO */
