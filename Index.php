<?php

ini_set("session.gc_maxlifetime","30000");
session_start();

if(isset($_SESSION["User"])){header("Index.php");}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>|-|-SISTEMA DE PAPELETAS D.R.S.A.U-|-|</title>
   <link rel="stylesheet" type="text/css" href="login/css/style.css" />
		<script src="login/js/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		<style>
			@import url(http://fonts.googleapis.com/css?family=Ubuntu:400,700);
			body {
				background: #563c55 url(login/images/blurred.jpg) no-repeat center top;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #fff;
				text-shadow: 0 1px 1px rgba(0,0,0,0.7);
			}
		</style>
<link href="login-box.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" type="text/css" href="css-letra/demo.css" />
        <link rel="stylesheet" type="text/css" href="css-letra/style5.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300|Montserrat' rel='stylesheet' type='text/css' />
		<script type="text/javascript" src="js/modernizr.custom.79639.js"></script> 
		<!--[if lte IE 8]><style>.support-note .note-ie{display:block;}</style><![endif]-->
   
</head>

<body>



<section class="main">
				
				<h2 class="cs-text" id="cs-text">.SISPAP.</h2>
				
			</section>
			
        </div>
    <br />
<section class="main">
<form class="form-3" method="post" action="acceso/procesador.php?accion=identificar">
				    <p class="clearfix">
				        <label for="login">Usuario</label>
				        <input name="user" type="text" id="user2" placeholder="D.N.I O Usuario"> </p>
				    <p class="clearfix">
				        <label for="password">Contraseña</label>
				        <input name="pass" type="password" id="pass" placeholder="Contraseña"> 
				    </p>
                    
				   <center>
				    <p class="clearfix">
				        <input type="submit" name="submit" value="Ingresar">
				    </p>  </center>     
				</form>
                <td><input name="Area" type="hidden" id="Area" />
      <input name="Nombre" type="hidden" id="Nombre" />
      <input name="Codigo" type="hidden" id="Codigo" />
      <input name="Paterno" type="hidden" id="Paterno" />
      <input name="Materno" type="hidden" id="Materno" />
      <input name="Condicion" type="hidden" id="Condicion" />
      <input name="Acceso" type="hidden" id="Acceso" /></td>​
			</section>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.lettering.js"></script>
<script>
			$(document).ready(function() {
				$("#cs-text").lettering().children('span').wrap('<span />');
			});
		</script>
</body>
</html>
