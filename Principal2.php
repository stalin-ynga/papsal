<?php
ini_set("session.gc_maxlifetime","30000");
session_start();

if(isset($_SESSION["User"])!=1){header("Location:Index.php");}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:SISTEMA DE PAPELETAS D.R.S.A.U:.</title>
</head>

<frameset rows="79,1,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="UntitledFrame-2.html">
  <frame src="UntitledFrame-1.html" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset cols="210,*" frameborder="no" border="0" framespacing="0">
    <frame src="menu.php" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
    <frame src="principal.html" name="mainFrame" id="mainFrame" title="mainFrame" />
  </frameset>
</frameset>
<noframes><body>
</body>
</noframes></html>


<?  }?>