<?php
ini_set("session.gc_maxlifetime","90000");
session_start();

if(isset($_SESSION["User"])!=1 || $_SESSION['Acceso']!='0000000001'){header("Location:Index.php");}
else{
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>.:SISTEMA DE PAPELETAS D.R.S.A.U:.</title>
		<meta name="description" content="Responsive Retina-Friendly Menu with different, size-dependent layouts" />
		<meta name="keywords" content="responsive menu, retina-ready, icon font, media queries, css3, transition, mobile" />
		<meta name="author" content="Codrops" />
        <link rel="stylesheet" href="modal/src/jquery.remodal.css">
        
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="admin/css/default.css" />
		<link rel="stylesheet" type="text/css" href="admin/css/component.css" />
		<script src="admin/js/modernizr.custom.js"></script>
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

document.getElementById('mod6').style.maxHeigth = '1250px';
}
function mymod4()
{
	
document.getElementById('mod7').style.maxWidth = '1250px';
}
function mymod5()
{
	
document.getElementById('mod8').style.maxWidth = '1250px';
}
function mymod6()
{
	
document.getElementById('mod9').style.maxWidth = '1250px';
}   
function mymod7()
{
	
document.getElementById('mod10').style.maxHeigth= '250px';
document.getElementById('mod10').style.maxWidth = '700px';
}  

function mymod8()
{
	
document.getElementById('mod11').style.maxWidth = '1250px';
}    
function mymod9()
{
	
document.getElementById('mod11').style.maxWidth = '1250px';
} 

function mymod10()
{
	
document.getElementById('mod13').style.maxHeigth= '250px';
document.getElementById('mod13').style.maxWidth = '700px';
}  

     
    </script>
        
         <style>

        .remodal {
        max-width: 1290px;
        margin: 20px auto;
        min-height: 0;

        -webkit-border-radius: 6px;
        border-radius: 6px;
    }
	
	
	</style>
    
	</head>
	<body background="admin/img/1.png">
		<div class="container">	
			<div class="main clearfix">
				<nav id="menu" class="nav">					
					<ul>
						<li>
							<a href="#modal" onClick="mymod()">
								<span class="icon">
									<i aria-hidden="true"><img src="admin/img/users.png"></i>
								</span>
								<span>Usuarios</span>
							</a>
						</li>
						<li>
							<a href="#modal2" onClick="mymod2()">
								<span class="icon"> 
									<i aria-hidden="true"><img src="admin/img/truck.png"></i>
								</span>
								<span>Vehiculos</span>
							</a>
						</li>
						<li>
							<a href="#modal3" onClick="mymod3()">
								<span class="icon">
									<i aria-hidden="true"><img src="admin/img/loop.png"></i>
								</span>
								<span>Asignaciones</span>
							</a>
						</li>
						<li>
							<a href="#modal4" onClick="mymod4()">
								<span class="icon">
								<i aria-hidden="true"><img src="admin/img/numbered-list.png"></i>
								</span>
								<span>Motivos</span>
							</a>
						</li>
						  <li>
							<a href="#modal5" onClick="mymod5()">
								<span class="icon">
									<i aria-hidden="true"><img src="admin/img/office.png"></i>
								</span>
								<span>Areas</span>
							</a>
						</li>
						<li>
							<a href="#modal6" onClick="mymod6()">
								<span class="icon">
									<i aria-hidden="true"><img src="admin/img/indent-increase.png"></i>
								</span>
								<span>Condiciones</span>
							</a>
						</li>
					</ul>
				</nav>
            </div>
		</div><!-- /container -->
        <center>
        <img src="admin/img/logo.png" >
        </center>
    	<div class="container">	
			<div class="main clearfix">
				<nav id="menu" class="nav">					
					<ul>
						<li>
							<a href="#modal8" onClick="mymod8()" >
								<span class="icon">
									<i aria-hidden="true"><img src="admin/img/books.png"></i>
								</span>
								<span>Documentos</span>
							</a>
						</li>
						<li>
							<a href="#modal9" onClick="mymod9()">
								<span class="icon"> 
									<i aria-hidden="true"><img src="admin/img/clock.png"></i>
								</span>
								<span>Marcado</span>
							</a>
						</li>
						
						<li>
							<a href="#modal7" onClick="mymod7()">
								<span class="icon">
								<i aria-hidden="true"><img src="admin/img/unlocked.png"></i>
								</span>
								<span>Contraseña</span>
							</a>
						</li>
                        <li>
							<a href="#modal10" onClick="mymod10()">
								<span class="icon">
								<i aria-hidden="true"><img src="admin/img/upload.png"></i>
								</span>
								<span>Cargar Marcado</span>
							</a>
						</li>
						  <li>
							<a href="./Docs/Reglamento UPER-2012.pdf"  target="_blank">
								<span class="icon">
									<i aria-hidden="true"><img src="admin/img/spam.png"></i>
								</span>
								<span>Base Legal</span>
							</a>
						</li>
						<li>
							<a href="./acceso/logout.php">
								<span class="icon">
									<i aria-hidden="true"><img src="admin/img/redo.png"></i>
								</span>
								<span>Cerrar Sesion</span>
							</a>
						</li>
					</ul>
				</nav>
            </div>
		</div><!-- /container -->
	 <div class="remodal-bg">
    
   
    <div class="remodal" data-remodal-id="modal" id="mod4">
        <!-- <iframe name="fra1" id="fra1" src="http://192.168.4.79/papsal/FrmConsultaUsuario.php" style="width:1200px; height:540px;" frameborder="0"></iframe> -->
		<iframe name="fra1" id="fra1" src="http://localhost/papsal/FrmConsultaUsuario.php" style="width:1200px; height:540px;" frameborder="0"></iframe>
        
    </div>

<div class="remodal" data-remodal-id="modal2" id="mod5" >
        <!-- <iframe name="fra2" id="fra2" src="http://192.168.4.79/papsal/FrmConsultaVehi.php" style="width:1200px; height:540px;" frameborder="0"></iframe> -->
		<iframe name="fra2" id="fra2" src="http://localhost/papsal/FrmConsultaVehi.php" style="width:1200px; height:540px;" frameborder="0"></iframe>
    </div>
  
       <div class="remodal" data-remodal-id="modal3" id="mod6">
        <!-- <iframe name="fra3" id="fra3" src="http://192.168.4.79/papsal/FrmConsultaAsignacion.php" style="width:1200px; height:540px;" frameborder="0"></iframe> -->
		<iframe name="fra3" id="fra3" src="http://localhost/papsal/FrmConsultaAsignacion.php" style="width:1200px; height:540px;" frameborder="0"></iframe>
        
    </div>
  <div class="remodal" data-remodal-id="modal4" id="mod7">
        <!-- <iframe name="fra4" id="fra4" src="http://192.168.4.79/papsal/FrmConsultaMotivo.php" style="width:1200px; height:540px;" frameborder="0"></iframe> -->
		<iframe name="fra4" id="fra4" src="http://localhost/papsal/FrmConsultaMotivo.php" style="width:1200px; height:540px;" frameborder="0"></iframe>
        
    </div>
    <div class="remodal" data-remodal-id="modal5" id="mod8">
        <!-- <iframe name="fra5" id="fra5" src="http://192.168.4.79/papsal/FrmConsultaArea.php" style="width:1200px; height:500px;" frameborder="0"></iframe> -->
		<iframe name="fra5" id="fra5" src="http://localhost/papsal/FrmConsultaArea.php" style="width:1200px; height:500px;" frameborder="0"></iframe>
        
    </div>
     <div class="remodal" data-remodal-id="modal6" id="mod9">
        <!-- <iframe name="fra6" id="fra6" src="http://192.168.4.79/papsal/FrmConsultaCondicion.php" style="width:1200px; height:500px;" frameborder="0"></iframe> -->
		<iframe name="fra6" id="fra6" src="http://localhost/papsal/FrmConsultaCondicion.php" style="width:1200px; height:500px;" frameborder="0"></iframe>
        
    </div>
     <div class="remodal" data-remodal-id="modal7" id="mod10">
        <!-- <iframe name="fra7" id="fra7" src="http://192.168.4.79/papsal/CambiaPass.php" style="width:580px; height:250px;" frameborder="0"></iframe> -->
		<iframe name="fra7" id="fra7" src="http://localhost/papsal/CambiaPass.php" style="width:580px; height:250px;" frameborder="0"></iframe>
        
    </div>
     <div class="remodal" data-remodal-id="modal8" id="mod11">
        <!-- <iframe name="fra8" id="fra8" src="http://192.168.4.79/papsal/ConsultaJusti.php" style="width:1200px; height:500px;" frameborder="0"></iframe> -->
		<iframe name="fra8" id="fra8" src="http://localhost/papsal/ConsultaJusti.php" style="width:1200px; height:500px;" frameborder="0"></iframe>
        
    </div>
     <div class="remodal" data-remodal-id="modal9" id="mod12">
        <!-- <iframe name="fra9" id="fra9" src="http://192.168.4.79/papsal/ConsultaGen.php" style="width:1200px; height:500px;" frameborder="0"></iframe> -->
		<iframe name="fra9" id="fra9" src="http://localhost/papsal/ConsultaGen.php" style="width:1200px; height:500px;" frameborder="0"></iframe>
        
         <div class="remodal" data-remodal-id="modal10" id="mod13">
        <!-- <iframe name="fra10" id="fra10" src="http://192.168.4.79/papsal/CargaReloj.php" style="width:500px; height:280px;" frameborder="0"></iframe> -->
		<iframe name="fra10" id="fra10" src="http://localhost/papsal/CargaReloj.php" style="width:500px; height:280px;" frameborder="0"></iframe>
        
    </div>
</div>
<script type="text/javascript" src="modal/js/jquery-1.6.2.min.js"></script>
    
<script>window.jQuery || document.write('<script src="modal/js/jquery-1.11.0.min.js"><\/script>')</script>

<!-- Instead of JQuery, you can use zepto now! -->
<!--<script src="js/zepto.min.js"></script>-->

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
		// document.getElementById("fra1").src="http://192.168.4.79/papsal/FrmConsultaUsuario.php";
		// document.getElementById("fra2").src="http://192.168.4.79/papsal/FrmConsultaVehi.php";
		// document.getElementById("fra3").src="http://192.168.4.79/papsal/FrmConsultaAsignacion.php";
		// document.getElementById("fra4").src="http://192.168.4.79/papsal/FrmConsultaMotivo.php";
		// document.getElementById("fra5").src="http://192.168.4.79/papsal/FrmConsultaArea.php";
		// document.getElementById("fra6").src="http://192.168.4.79/papsal/FrmConsultaCondicion.php";
		// document.getElementById("fra7").src="http://192.168.4.79/papsal/CambiaPass.php";
		// document.getElementById("fra8").src="http://192.168.4.79/papsal/ConsultaJusti.php";
		// document.getElementById("fra9").src="http://192.168.4.79/papsal/ConsultaGen.php";
		// document.getElementById("fra10").src="http://192.168.4.79/papsal/CargaReloj.php";

		document.getElementById("fra1").src="http://localhost/papsal/FrmConsultaUsuario.php";
		document.getElementById("fra2").src="http://localhost/papsal/FrmConsultaVehi.php";
		document.getElementById("fra3").src="http://localhost/papsal/FrmConsultaAsignacion.php";
		document.getElementById("fra4").src="http://localhost/papsal/FrmConsultaMotivo.php";
		document.getElementById("fra5").src="http://localhost/papsal/FrmConsultaArea.php";
		document.getElementById("fra6").src="http://localhost/papsal/FrmConsultaCondicion.php";
		document.getElementById("fra7").src="http://localhost/papsal/CambiaPass.php";
		document.getElementById("fra8").src="http://localhost/papsal/ConsultaJusti.php";
		document.getElementById("fra9").src="http://localhost/papsal/ConsultaGen.php";
		document.getElementById("fra10").src="http://localhost/papsal/CargaReloj.php";
    });

    $(document).on('closed', '.remodal', function () {
        console.log('closed');
		// document.getElementById("fra1").src="http://192.168.4.79/papsal/FrmConsultaUsuario.php";
        // document.getElementById("fra2").src="http://192.168.4.79/papsal/FrmConsultaVehi.php"; 
        // document.getElementById("fra3").src="http://192.168.4.79/papsal/FrmConsultaAsignacion.php"; 
		// document.getElementById("fra4").src="http://192.168.4.79/papsal/FrmConsultaMotivo.php";
		// document.getElementById("fra5").src="http://192.168.4.79/papsal/FrmConsultaArea.php";
		// document.getElementById("fra6").src="http://192.168.4.79/papsal/FrmConsultaCondicion.php";
		// document.getElementById("fra7").src="http://192.168.4.79/papsal/CambiaPass.php"; 
		// document.getElementById("fra8").src="http://192.168.4.79/papsal/ConsultaJusti.php";
		// document.getElementById("fra9").src="http://192.168.4.79/papsal/ConsultaGen.php";
		// document.getElementById("fra10").src="http://192.168.4.79/papsal/CargaReloj.php";

		document.getElementById("fra1").src="http://localhost/papsal/FrmConsultaUsuario.php";
        document.getElementById("fra2").src="http://localhost/papsal/FrmConsultaVehi.php"; 
        document.getElementById("fra3").src="http://localhost/papsal/FrmConsultaAsignacion.php"; 
		document.getElementById("fra4").src="http://localhost/papsal/FrmConsultaMotivo.php";
		document.getElementById("fra5").src="http://localhost/papsal/FrmConsultaArea.php";
		document.getElementById("fra6").src="http://localhost/papsal/FrmConsultaCondicion.php";
		document.getElementById("fra7").src="http://localhost/papsal/CambiaPass.php"; 
		document.getElementById("fra8").src="http://localhost/papsal/ConsultaJusti.php";
		document.getElementById("fra9").src="http://localhost/papsal/ConsultaGen.php";
		document.getElementById("fra10").src="http://localhost/papsal/CargaReloj.php";
  	});

    //
	

    // You can open or close it like this:
    // var inst = $.remodal.lookup[$('[data-remodal-id=modal]').data('remodal')];
    // inst.open();
    // inst.close();

    // Or init in this way:
    var inst = $('[data-remodal-id=modal2]').remodal();
    // inst.open();
</script>
</body>
</html>
<?php  }?>