<?php
require_once '../../../jq-config.php';
// include the jqGrid Class
require_once ABSPATH."php/jqGrid.php";
// include the driver class
require_once ABSPATH."php/jqGridPdo.php";
// Connection to the server
$conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
// Tell the db that we use utf-8
$conn->query("SET NAMES utf8");
// Get the needed parameters passed from the main grid
if(isset ($_REQUEST["Codigo"]))
    $rowid = jqGridUtils::Strip($_REQUEST["Codigo"]);
else
    $rowid = "";
// Create the jqGrid instance
$grid = new jqGridRender($conn);
// Write the SQL Query
$grid->SelectCommand = "SELECT Usuario,Codigo,FecSalida,FecRetorno FROM tblsalida where Usuario=?";
// set the ouput format to json
$grid->dataType = 'json';
// Let the grid create the model
$grid->setColModel(null, array(&$rowid));
// Set the url from where we obtain the data
$grid->setUrl('detail.php');
// Set some grid options
$grid->setGridOptions(array(
    "rowNum"=>10,
    "sortname"=>"Codigo",
    "rowList"=>array(10,20,30),
    "multiselect"=>true));
// Change some property of the field(s)
$grid->setColProperty("OrderID", array("label"=>"Codigo", "width"=>60));
$grid->setColProperty("OrderDate", array(
    "formatter"=>"date",
    "formatoptions"=>array("srcformat"=>"Y-m-d H:i:s","newformat"=>"m/d/Y")
    )
);
$custom = <<<CUSTOM
jQuery("#getselected").click(function(){
    var selr = jQuery('#grid').jqGrid('getGridParam','selarrrow');
    if(selr) alert(selr);
});
CUSTOM;
$grid->setJSCode($custom);
$grid->navigator = true;
$grid->setNavOptions('navigator', array("excel"=>true,"add"=>false,"edit"=>false,"del"=>false,"view"=>false));
// Enjoy
//$summaryrow = array("Freight"=>array("Freight"=>"SUM"));
$grid->renderGrid("#detail","#pgdetail", true, null, array(&$rowid), true,true);
$conn = null;
?>
