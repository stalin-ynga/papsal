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
<div class="h">Search By:</div>
<div>
	<input type="checkbox" id="autosearch" onclick="enableAutosubmit(this.checked)"> Enable Autosearch <br/>
	Code<br />
	<input type="text" id="search_cd" onkeydown="doSearch(arguments[0]||event)" />
</div>
<div>
	Name<br>
	<input type="text" id="item_nm" onkeydown="doSearch(arguments[0]||event)" />
	<button onclick="gridReload()" id="submitButton" style="margin-left:30px;">Search</button>
</div>

<br />
<table id="bigset"></table>
<div id="pagerb"></div>
<script src="bigset.js" type="text/javascript"> </script>