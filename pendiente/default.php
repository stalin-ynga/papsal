<?php
require_once 'HT5/jqSuitePHP_4_6_0/tabs.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>jqGrid PHP Demo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="HT5/jqSuitePHP_4_6_0/themes/redmond/jquery-ui-custom.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="HT5/jqSuitePHP_4_6_0/themes/ui.jqgrid.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="HT5/jqSuitePHP_4_6_0/themes/ui.multiselect.css" />
    <style type="text">
        html, body {
        margin: 0;			/* Remove body margin/padding */
    	padding: 20;
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
  </head>
  <body>
      <div>
          <b>Customers</b>
          <?php include ("grid.php");?>
      </div>
     
   </body>
</html>
