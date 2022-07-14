<?php
require_once '../../../tabs.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>jqGrid PHP Demo</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../../../themes/redmond/jquery-ui-1.8.2.custom.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../../../themes/ui.jqgrid.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../../../themes/ui.multiselect.css" />
    <style type="text">
        html, body {
        margin: 0;			/* Remove body margin/padding */
    	padding: 0;
        overflow: hidden;	/* Remove scroll bars on browser window */
        font-size: 75%;
        }
	.input-ui  {padding :4px;}
	.select-ui  {padding : 3px;}
	.textarea-ui {padding: 3px;}
	.globalparam {display:none;}
	.ui-input  {padding :4px;}
	.ui-select  {padding : 3px;}
	.ui-textarea {padding: 3px;}
	.ui-event-cell {padding: 5px;height:25px;white-space: nowrap; overflow:  hidden;}
	.ui-grid-footer { background-image: none; font-weight: normal; text-align: left;}
		
    </style>
    <script src="../../../js/jquery.js" type="text/javascript"></script>
    <script src="../../../js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script type="text/javascript">
	$.jgrid.no_legacy_api = true;
	$.jgrid.useJSON = true;
	</script>
    <script src="../../../js/jquery.jqGrid.min.js" type="text/javascript"></script>
    <script src="../../../js/jquery-ui-custom.min.js" type="text/javascript"></script>
	<script src="../../../js/jquery.form.js" type="text/javascript"></script>
  </head>
  <body>
      <div>
          <?php include ("grid.php");?>
      </div>
      <br/>
      <?php tabs(array("grid.php","customer.php"));?>
   </body>
</html>
