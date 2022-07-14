<?php
require_once 'HT5/jqSuitePHP_4_6_0/jq-config.php';
// include the jqGrid Class
require_once 'HT5/jqSuitePHP_4_6_0/php/jqGrid.php';
// include the driver class
require_once 'HT5/jqSuitePHP_4_6_0/php/jqGridPdo.php';
// Connection to the server
$conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
// Tell the db that we use utf-8
$conn->query("SET NAMES utf8");

// Create the jqGrid instance
$grid = new jqGridRender($conn);
// Write the SQL Query
$grid->SelectCommand = "select Codigo,FecSalida,FecRetorno,(select Nombre from tbltipomotivo where TipoMotivo=tbltipomotivo.Codigo) as Tipo,Lugar,Fundamento,Observacion,(CASE Statuss WHEN '01' THEN 'PENDIENTE' WHEN '02' THEN 'APROBADO' ELSE NULL END) AS Estado from tblsalida";
// Set the table to where you update the data
$grid->table = 'tblusuario';
// Set output format to json
$grid->dataType = 'json';
// Let the grid create the model
$grid->setColModel();
// Set the url from where we obtain the data
$grid->setUrl('grid.php');
// Set some grid options
$grid->setGridOptions(array(
    "rowNum"=>15,
    "rowList"=>array(10,20,30),
    "sortname"=>"Codigo",
	 "multiselect"=>true,
	  "height"=> 250,
	  "width"=> 900,
));
$grid->setColProperty('Codigo', array("label"=>"Codigo", "width"=>150));
$selectorder = <<<ORDER
function(rowid, selected)
{
    if(rowid != null) {
        jQuery("#detail").jqGrid('setGridParam',{postData:{Codigo:rowid}});
        jQuery("#detail").trigger("reloadGrid");
    }
}
ORDER;
$grid->setGridEvent('onSelectRow', $selectorder);
// Enable navigator
$grid->navigator = true;
// Enable only editing
$grid->setNavOptions('navigator', array("excel"=>false,"add"=>false,"edit"=>false,"del"=>false,"view"=>false));
// Enjoy
$grid->renderGrid('#grid','#pager',true, null, null, true,true);
$conn = null;
?>
