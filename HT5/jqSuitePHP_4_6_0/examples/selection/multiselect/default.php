<?php 
require_once '../../../tabs.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>jqGrid PHP Demo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="../../../themes/redmond/jquery-ui-custom.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../../../themes/ui.jqgrid.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../../../themes/ui.multiselect.css" />
    <style type="text">
        html, body {
        margin: 0;			/* Remove body margin/padding */
    	padding: 0;
        overflow: hidden;	/* Remove scroll bars on browser window */
        font-size: 75%;
        }
    </style>
    <script src="../../../js/jquery.js" type="text/javascript"></script>
    <script src="../../../js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script type="text/javascript">
	$.jgrid.no_legacy_api = true;
	$.jgrid.useJSON = true;
	</script>
    <script src="../../../js/jquery.jqGrid.min.js" type="text/javascript"></script>
    <script src="../../../js/jquery-ui-custom.min.js" type="text/javascript"></script>
  <style type="text/css">
  .tb6 {	border: 3px double #CCCCCC;
	width: 180px;
	text-align: left;
}
.titulo_cabecera {	color: #000;
	text-align: right;
}
  </style>
  </head>
  <body>
  <center>
  <form method="GET">
  <table width="977" border="0">
    <tr>
      <td><span class="titulo_cabecera">Desde:</span></td>
      <td><input name="inicio" type="text" class="tb6" id="inicio"  readonly="readonly"/></td>
      <td class="titulo_cabecera">Hasta:</td>
      <td><input name="final" type="text" class="tb6" id="final"  readonly="readonly"/>
        </span></td>
      <td class="titulo_cabecera">Estado: </td>
      <td><select name="estado" class="tb6" id="estado">
     
        <option value="01"> PENDIENTE</option>
        <option value="02"> APROBADO</option>
      </select></td>
      <td><span class="titulo_cabecera">Tipo:</span></td>
      <td><label for="select"></label>
        <select name="tipo" class="tb6" id="tipo">
          <option value="01"> PAPELETA DE SALIDA</option>
          <option value="02"> PAPELETA DE TARDANZA</option>
          <option value="03"> PAPELETA VEHICULAR</option>
        </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="FILTRAR" onclick="asigna(); "  /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  
    <div>
      <?php include ("grid.php");?>
    </div>
      <button id="getselected">Get Selected Rows</button>
      <br/>
      <br/>
      <input name="ver" type="hidden" id="ver" value="0000000001"  />
      </form>
   </body>
</html>
