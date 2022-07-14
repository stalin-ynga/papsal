<?php
require_once '../../../jq-config.php';
// include the jqGrid Class
require_once ABSPATH."php/jqGrid.php";
// include the driver class
require_once ABSPATH."php/jqGridPdo.php";
// Connection to the server
$conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
// Tell the db that we use utf-8
$conn->query("SET NAMES 'utf8'");

// Create the jqGrid instance
$grid = new jqGridRender($conn);
// Write the SQL Query
$grid->SelectCommand = 'SELECT OrderID, CustomerID, Freight, OrderDate, ShipCity FROM orders';
// set the ouput format to json
$grid->table = 'orders';
$grid->dataType = 'json';
// Let the grid create the model
$grid->setColModel();
// Set the url from where we obtain the data
$grid->setUrl('grid.php');
// Set some grid options
$grid->setGridOptions(array("rowNum"=>10,"rowList"=>array(10,20,30), "sortname"=>"OrderID","height"=>150));
// Change some property of the field(s)
$grid->setColProperty("OrderDate", array(
    "formatter"=>"date",
    "formatoptions"=>array("srcformat"=>"Y-m-d H:i:s","newformat"=>"m/d/Y"),
    "search"=>false,
    "editable"=>false
    )
);
$grid->setColProperty("OrderID",array("editable"=>false));
$grid->setColProperty("ShipCity",array("editable"=>false));
// We need custom select since the select should be updated 
// every time
$grid->setColProperty("CustomerID",array( "edittype"=>"select", "editoptions"=>array("dataUrl"=>"getcustomers.php")));

$grid->navigator = true;

//NOTE THE recreateForm
$grid->setNavOptions('navigator', array("del"=>false,"excel"=>false,"search"=>false,"refresh"=>false));
$grid->setNavOptions('edit', array("height"=>'auto',"dataheight"=>"auto","recreateForm"=>true));
$grid->setNavOptions('add', array("height"=>'auto',"dataheight"=>"auto", "recreateForm"=>true));
// Enjoy

$form = <<< FORM
function(){
   var ajaxDialog = $('<div id="ajax-dialog" style="display:hidden" title="Customer Edit"></div>').appendTo('body');
   data = {};
   ajaxDialog.load(
      'customer.php',
       data,
       function(response, status){
           ajaxDialog.dialog({
               width: 'auto',
               modal:true,
               open: function(ev, ui){
                  $(".ui-dialog").css('font-size','0.9em');
               },
               close: function(e,ui) {
                   ajaxDialog.remove();
               }
           });
        }
    );
}
FORM;

$buttonoptions = array("#pager",
    array(
      "caption"=>"Customers",
      "onClickButton"=>"js:".$form
    )
);
$grid->callGridMethod("#grid", "navButtonAdd", $buttonoptions);

$grid->renderGrid('#grid','#pager',true, null, null, true,true);
$conn = null;
?>
