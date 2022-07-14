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
// By default we add to postData subgrid and rowid parameters in the main grid
$oper = jqGridUtils::GetParam("oper");
$subtable = jqGridUtils::GetParam("subgrid");
$rowid = jqGridUtils::GetParam("rowid");
//if(!$subtable && !$rowid) die("Missed parameters");
// Create the jqGrid instance
$grid = new jqGridRender($conn);
// Write the SQL Query
$grid->SelectCommand = "SELECT OrderID, RequiredDate, ShipName, ShipCity, Freight, CustomerID FROM orders WHERE CustomerID = ?";
// set the ouput format to json
$grid->dataType = 'json';
$grid->setPrimaryKeyId('OrderID');
// Let the grid create the model
$grid->setColModel(null,array(&$rowid));
// Set the url from where we obtain the data
$grid->setUrl('subgrid.php');
$grid->table = 'orders';
$grid->setColProperty('OrderID', array(
	"editoptions"=>array("readonly"=>true)
));
$grid->setColProperty('RequiredDate', array(
	"editable"=>false
));
$grid->setColProperty('CustomerID', array(
	"hidden"=>true
));
// Set some grid options
$grid->setGridOptions(array(
    "width"=>540,
    "rowNum"=>10,
    "sortname"=>"OrderID",
    "height"=>110,
    "postData"=>array("subgrid"=>$subtable,"rowid"=>$rowid)));
// Change some property of the field(s)
$grid->setColProperty("RequiredDate", array(
    "formatter"=>"date",
    "formatoptions"=>array("srcformat"=>"Y-m-d H:i:s","newformat"=>"m/d/Y"),
    "search"=>false
    )
);
$grid->navigator = true;
$grid->setNavOptions('navigator', array("excel"=>false,"add"=>true,"edit"=>true,"del"=>false,"view"=>false));
$grid->setNavOptions('add', array('editData'=>array("CustomerID"=>$rowid)));
// Enjoy
$subtable = $subtable."_t";
$pager = $subtable."_p";
$grid->renderGrid($subtable,$pager, true, null, array(&$rowid), true,true);
$conn = null;
?>
