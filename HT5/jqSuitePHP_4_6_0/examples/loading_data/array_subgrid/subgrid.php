<?php
require_once '../../../jq-config.php';
// include the jqGrid Class
require_once ABSPATH."php/jqGrid.php";
// include the driver class
require_once ABSPATH."php/jqGridArray.php";
// create the array connection
$conn = new jqGridArray();
// Get the needed parameters passed from the main grid
// By default we add to postData subgrid and rowid parameters in the main grid
$subtable = jqGridUtils::Strip($_REQUEST["subgrid"]);
$rowid = jqGridUtils::Strip($_REQUEST["rowid"]);
if(!$subtable && !$rowid) die("Missed parameters");
// Create the jqGrid instance
$grid = new jqGridRender($conn);
// Write the SQL Query
for ($i = 0; $i < 1000; $i++)
{
	$datas[$i]['subid']	= $i+1;
	$datas[$i]['subfoo']	= md5(rand(0, 10000));
	$datas[$i]['subbar']	= 'subbar'.($i+1);
}

$grid->SelectCommand = "SELECT * FROM datas WHERE subid = ?";
// set the ouput format to json
$grid->dataType = 'json';
// Let the grid create the model
$grid->setColModel(null,array($rowid));
// Set the url from where we obtain the data
$grid->setUrl('subgrid.php');
// Set some grid options
$grid->setGridOptions(array(
    "width"=>540,
    "rowNum"=>10,
    "sortname"=>"subid",
    "height"=>110,
    "postData"=>array("subgrid"=>$subtable,"rowid"=>$rowid)));
// Change some property of the field(s)
$grid->navigator = true;
$grid->setNavOptions('navigator', array("excel"=>false,"add"=>false,"edit"=>false,"del"=>false,"view"=>false));
// Enjoy
$subtable = $subtable."_t";
$pager = $subtable."_p";
$grid->renderGrid($subtable,$pager, true, null, array($rowid), true,true);
$conn = null;
?>
