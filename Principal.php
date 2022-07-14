<?php
ini_set("session.gc_maxlifetime","30000");
session_start();

if(isset($_SESSION["User"])!=1){
	header("Location:Index.php");
}
else{
?>
<!DOCTYPE html>

<html class="no-js" lang="en"> <!--<![endif]-->
	<head>
        <title>.:SISTEMA DE PAPELETAS D.R.S.A.U:.</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Creative CSS3 Animation Menus" />
        <meta name="keywords" content="menu, navigation, animation, transition, transform, rotate, css3, web design, component, icon, slide" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
         <link rel="stylesheet" href="modal/src/jquery.remodal.css">
   
        <link rel="stylesheet" type="text/css" href="css/menu/css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/menu/css/stimenu.css" />
		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow&v1' rel='stylesheet' type='text/css' />
		<link href='css/menu/css/wire.css' rel='stylesheet' type='text/css' />
    
        <link rel="stylesheet" type="text/css" href="logo-prin/css/style1.css" />
     
		<script type="text/javascript" src="logo-prin/js/modernizr.custom.40443.js"></script>
     
		<style>
			.Estilo9 {
				font-size: 12px;
				font-family: "Lucida Console", Monaco, monospace;
			}
			.remodal {
				max-width: 700px;
				margin: 20px auto;
				min-height: 0;

				-webkit-border-radius: 6px;
				border-radius: 6px;
			}
		
		</style>
    </head>
    <body background="images/1.jpg">
  
    	<script>
	
			function mymod()
			{
				document.getElementById('mod4').style.maxWidth = '1250px';
			}
			function mymod2()
			{
				document.getElementById('mod5').style.maxWidth = '1250px';
			}
			function mymod3()
			{
				document.getElementById('mod6').style.maxHeigth = '250px';
			}
			function mymod4()
			{
				document.getElementById('mod7').style.maxWidth = '1250px';
			}
    
    
    	</script>
   		<center>
   
     		<div id="letter-container" class="letter-container">
				<h2>
					<a href="#">DRSAU</a>
					<a href="#">SISPAP</a>
                   
				</h2>
			</div>

         	<div class="img">
            	<center>
                	<img src="images/logo.png">
                </center>
            </div>  
  
    		<!-- COMIENZO DEL MENU -->
    		<ul id="sti-menu" class="sti-menu">
				<li data-hovercolor="#9F0">
					<a href="#modal2">
						<h2 data-type="mText" class="sti-item">Papeletas De Salida</h2>
						<h3 data-type="sText" class="sti-item">Solicita Tus Permisos</h3>
						<span data-type="icon" class="sti-icon sti-icon sti-icon-alternative sti-item"></span>
					</a>
				</li>
				<li data-hovercolor="#9F0">
					<a href="#modal">
						<h2 data-type="mText" class="sti-item">Papeletas De Tardanza</h2>
						<h3 data-type="sText" class="sti-item">Gestiona Tus Tardanzas</h3>
						<span data-type="icon" class="sti-icon sti-icon-info sti-item"></span>
					</a>
				</li>
<?php

	if(($_SESSION["Codigo"] == "0000000186") || ($_SESSION["Codigo"] == "0000000107") || ($_SESSION["Codigo"] == "0000000219") || ($_SESSION["Codigo"] == "0000000379") || ($_SESSION["Codigo"] == "0000000173") || ($_SESSION["Codigo"] == "0000000122") ){

?>
				<li data-hovercolor="#9F0">
					<a href="#modal3">
						<h2 data-type="mText" class="sti-item">Papeletas Vehiculares</h2>
						<h3 data-type="sText" class="sti-item">Salidas Vehiculares</h3>
						<span data-type="icon" class="sti-icon sti-icon-family sti-item"></span>
					</a>
				</li>
<?php
	}
?>
				<li data-hovercolor="#9F0">
					<a href="#modal4" id="mo4" onClick="mymod()">
						<h2 data-type="mText" class="sti-item">Consultar Mis Papeletas</h2>
						<h3 data-type="sText" class="sti-item">Verifica Tus Permisos</h3>
						<span data-type="icon" class="sti-icon sti-icon-con sti-item"></span>
					</a>
				</li>
<?php

	if($_SESSION["Acceso"] == "0000000002" ){

?>
				<li data-hovercolor="#9F0">
					<a href="#modal5" id="mo5" onClick="mymod2()">
						<h2 data-type="mText" class="sti-item">Aprobar Papeletas</h2>
						<h3 data-type="sText" class="sti-item">Gestiona Su Aprobacion</h3>
						<span data-type="icon" class="sti-icon sti-icon-technology sti-item"></span>
					</a>
				</li>
<?php
	}
?>

<?php
if($_SESSION["Acceso"] == "0000000005" ){

?>
				<li data-hovercolor="#9F0">
					<a href="#modal5" id="mo5" onClick="mymod2()">
						<h2 data-type="mText" class="sti-item">Aprobar Papeletas</h2>
						<h3 data-type="sText" class="sti-item">Gestiona Su Aprobacion</h3>
						<span data-type="icon" class="sti-icon sti-icon-technology sti-item"></span>
					</a>
				</li>
<?php
	}
?>

 <?php
	
	if($_SESSION["Acceso"] == "0000000004"){

?>
                <li data-hovercolor="#9F0">
					<a href="#modal7" id="mo7" onClick="mymod4()">
						<h2 data-type="mText" class="sti-item">Consulta De Vigilancia</h2>
						<h3 data-type="sText" class="sti-item">Cerrado de Papeletas</h3>
						<span data-type="icon" class="sti-icon sti-icon-care sti-item"></span>
					</a>
				</li>
<?php
	}
?>    
                <li data-hovercolor="#9F0">
				  <a href="#modal6" id="mo6" onClick="mymod3()">
						<h2 data-type="mText" class="sti-item">Cambiar Mi Contraseña</h2>
				  		<h3 data-type="sText" class="sti-item">Actualiza Tu Clave</h3>
						<span data-type="icon" class="sti-icon sti-icon-fu sti-item"></span>
				  </a>
				</li>
                <li data-hovercolor="#9F0">
					<a href="./acceso/logout.php" onClick="mymod3()">
						<h2 data-type="mText" class="sti-item">Cerrar Mi Sesion Actual</h2>
						<h3 data-type="sText" class="sti-item">Finaliza Tu Sesion</h3>
						<span data-type="icon" class="sti-icon sti-icon-cla sti-item"></span>
					</a>
				</li>              
                <li data-hovercolor="#9F0">
					<a href="./Docs/Reglamento UPER-2012.pdf" target="_blank">
						<h2 data-type="mText" class="sti-item">Base Legal Del Sistema</h2>
						<h3 data-type="sText" class="sti-item">Reglamento Interno</h3>
						<span data-type="icon" class="sti-icon sti-icon-ba sti-item"></span>
					</a>
				</li>
            
			</ul>
			<!-- FIN DEL MENU -->
       
			<div class="remodal-bg">
	
				<div class="remodal" data-remodal-id="modal">
					<iframe name="fra1" id="fra1" src="http://192.168.4.79/papsal/FrmTardanza.php" style="width:589px; height:420px;" frameborder="0"></iframe>
				</div>

				<div class="remodal" data-remodal-id="modal2">
					<iframe name="fra2" id="fra2" src="http://192.168.4.79/papsal/FrmSalida.php" style="width:589px; height:495px;" frameborder="0"></iframe>
				</div>
	
				<div class="remodal" data-remodal-id="modal3">
					<iframe name="fra3" id="fra3" src="http://192.168.4.79/papsal/FrmVehisal.php" style="width:589px; height:440px;" frameborder="0"></iframe>
				</div>
			
				<div class="remodal" data-remodal-id="modal4" id="mod4">
					<iframe name="fra4" id="fra4" src="http://192.168.4.79/papsal/Pendiente.php" style="width:1200px; height:500px;" frameborder="0"></iframe>
				</div>

				<div class="remodal" data-remodal-id="modal5" id="mod5">
					<iframe name="fra5" id="fra5" src="http://192.168.4.79/papsal/PorAprobar.php" style="width:1200px; height:500px;" frameborder="0"></iframe>
				</div>
		
				<div class="remodal" data-remodal-id="modal6" id="mod6">
					<iframe name="fra6" id="fra6" src="http://192.168.4.79/papsal/CambiaPass.php" style="width:580px; height:250px;" frameborder="0"></iframe>
				</div>

				<div class="remodal" data-remodal-id="modal7" id="mod7">
					<iframe name="fra7" id="fra7" src="http://192.168.4.79/papsal/FrmConsultaVig.php" style="width:1200px; height:500px;" frameborder="0"></iframe>
				</div>
		
				<div class="remodal" data-remodal-id="aviso">
					<center>
					<table width="553" border="0">
						<tr>
							<td width="547" height="29" bgcolor="#FFFFFF"><div align="center"><img src="modal/logo.png" alt="d" width="552" height="98" /></div></td>
						</tr>
					</table>
					<img src="img/COMUNICADO.png">
				</div>
			</div>

			<script type="text/javascript" src="logo-prin/js/jquery-1.11.0.min.js"></script>
			<script type="text/javascript" src="css/menu/js/jquery-ui-1.10.4.custom.min.js"></script>
			<script type="text/javascript" src="css/menu/js/jquery.easing.1.3.js"></script>
			<script type="text/javascript" src="css/menu/js/jquery.iconmenu.js"></script>
			<script type="text/javascript">
				$(function() {
					$('#sti-menu').iconmenu({
						animMouseenter	: {
							'mText' : {speed : 50, easing : 'easeOutExpo', delay : 200, dir : 1},
							'sText' : {speed : 50, easing : 'easeOutExpo', delay : 0, dir : 1},
							'icon'  : {speed : 50, easing : 'easeOutExpo', delay : 250, dir : 1}
						},
						animMouseleave	: {
							'mText' : {speed : 50, easing : 'easeInExpo', delay : 200, dir : 1},
							'sText' : {speed : 50, easing : 'easeInExpo', delay : 250, dir : 1},
							'icon'  : {speed : 50, easing : 'easeInExpo', delay : 0, dir : 1}
						}
					});
				});
			</script>


			<script type="text/javascript" src="logo-prin/js/jquery.lettering.js"></script>
			<script type="text/javascript">
				$(function() {
					$("#letter-container h2 a").lettering();
				});
			</script>
			<script type="text/javascript" src="modal/js/jquery-1.6.2.min.js"></script>
			<script>window.jQuery || document.write('<script src="modal/js/jquery-1.11.0.min.js"><\/script>')</script>

			<script src="modal/src/jquery.remodal.js"></script>

			<!-- Events -->
			<script>
				$(document).on('open', '.remodal', function () {
					console.log('open');
				});

				$(document).on('opened', '.remodal', function () {
					console.log('opened');
				});

				$(document).on('close', '.remodal', function () {
					console.log('close');
					document.getElementById("fra1").src="http://192.168.4.79/papsal/FrmTardanza.php";
					document.getElementById("fra2").src="http://192.168.4.79/papsal/FrmSalida.php";
					document.getElementById("fra3").src="http://192.168.4.79/papsal/FrmVehiSal.php";
					document.getElementById("fra4").src="http://192.168.4.79/papsal/Pendiente.php";
					document.getElementById("fra5").src="http://192.168.4.79/papsal/PorAprobar.php";
					document.getElementById("fra6").src="http://192.168.4.79/papsal/CambiaPass.php";
					document.getElementById("fra7").src="http://192.168.4.79/papsal/FrmConsultaVig.php";
				});

				$(document).on('closed', '.remodal', function () {
					console.log('closed');
					document.getElementById("fra1").src="http://192.168.4.79/papsal/FrmTardanza.php";
					document.getElementById("fra2").src="http://192.168.4.79/papsal/FrmSalida.php"; 
					document.getElementById("fra3").src="http://192.168.4.79/papsal/FrmVehiSal.php"; 
					document.getElementById("fra4").src="http://192.168.4.79/papsal/Pendiente.php";
					document.getElementById("fra5").src="http://192.168.4.79/papsal/PorAprobar.php";
					document.getElementById("fra6").src="http://192.168.4.79/papsal/CambiaPass.php";
					document.getElementById("fra7").src="http://192.168.4.79/papsal/FrmConsultaVig.php"; 
				});

				//
		
				// You can open or close it like this:
				var inst = $.remodal.lookup[$('[data-remodal-id=aviso]').data('remodal')];
				inst.open();
				inst.close();

					// Or init in this way:
				// var inst = $('[data-remodal-id=modal2]').remodal();
					// inst.open();
			</script>
    </body>
</html>
<?php
}?>