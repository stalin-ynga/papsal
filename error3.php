<head>
<title>Mensaje De Retorno</title>
<SCRIPT language=JavaScript1.1>
function right(e) {
if (navigator.appName == 'Netscape' &&
(e.which == 3 || e.which == 2))
return false;
else if (navigator.appName == 'Microsoft Internet Explorer' && (event.button == 2 || event.button == 3)) {
alert("ACCION NO PERMITIDA!!");
return false;
}
return true;
}
document.onmousedown=right;
if (document.layers) window.captureEvents(Event.MOUSEDOWN);
 window.onmousedown=right;
// End -->
</script>
</head>
<center>
<p>&nbsp;</p>
<table width="88%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%">&nbsp;</td>
    <td width="96%"><div align="center"><font color="#006633"><strong><font color="#009966" face="Arial, Helvetica, sans-serif">.::No Hay Datos En Tu Consulta::.</font></strong></font></div></td>
    <td width="2%"><div align="center"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td> 
    <td><div align="center"><strong><font color="#009966" face="Arial, Helvetica, sans-serif"><a >Retornar</a></font></strong></div></td>
    <td> <div align="center"><a href="javascript:window.close();"></a></div></td>
  </tr>
</table>
<p>&nbsp;</p>
