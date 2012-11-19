<?
$messageParte1 = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">' ."\n";

	$messageParte1 .= '<html>' ."\n";

	$messageParte1 .= '<head>' ."\n";

	$messageParte1 .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' ."\n";

	$messageParte1 .= '<title>'.$titulo.'</title>' ."\n";
	

        $estilos = '<style type="text/css">
            body {
                font-family:  Arial, Helvetica, sans-serif; font-size: 12px; color:#777;
            }
            .logo{
		font-size: 18px;
		font-family:: Georgia, "Times New Roman", Times, serif;
                margin-left: 30px;
            }

            .derecha{
                text-align: left;
                padding-right: 15px;
            }
                        
            table tr td{
                padding: 5px;
            }

        </style>';

        $messageParte1 .= $estilos;

       $messageParte1 .= '
           </head>' ."\n";
$correo = $messageParte1;

$correo .= '<body>




<div class="comentario">
<h1 class="logo">Difusión Gráfica</h1>

';
 

  $correo .= '

<table border="0" cellpadding="1" cellspacing="0" width="600">
    <tr class="titulo">
        <th colspan="2"><h3>'.$titulo.'</h3></th>
    </tr>
     <tr>
        <td class="derecha"><b>Nombre:</b> </td><td>'.$nombre.'</td>
    </tr>
    <tr>
        <td class="derecha"><b>Empresa:</b> </td><td>'.$empresa.'</td>
    </tr>
    <tr>
        <td class="derecha"><b>Teléfono:</b> </td><td>'.$telefono.'</td>
    </tr>
    <tr>
        <td class="derecha"><b>Mail: </b></td><td>'.$de.'</td>
    </tr>
    <tr>
        <td class="derecha"><b>Provincia:</b> </td><td>'.$provincia.'</td>
    </tr>
    <tr>
        <td class="derecha" ><b>Población:</b> </td><td>'.$poblacion.'</td>
    </tr>

    <tr>
        <td colspan="2"><b>Consulta/mensaje:</b> <br/>'.nl2br($texto).'</td>
    </tr>
    

  </table>';

  
  $correo .='
</body>
</html>';


//echo $correo;
?>

