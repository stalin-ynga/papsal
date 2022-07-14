<?php

include_once("conexion.php");
$nombre = encrypt($_POST["user"],"user");
$pass = encrypt($_POST["pass"],"pass");
$nombre2=$nombre;
$accion = $_GET["accion"];

// var_dump($nombre, $pass);

/*echo '<script language="javascript">alert("'.$pass.'");</script>';*/

// if($accion == "identificar") {
// 	echo "<script language='javascript'>";
// 	echo "alert('Todo OK!.')";
// 	echo "</script>"; 
// }
// else{
// 	echo "<script language='javascript'>";
// 	echo "alert('Error!! Torna a identificar-te. Les dades no són correctes.')";
// 	echo "</script>"; 
// }

if ($accion == "identificar") {
	$sql = "SELECT Codigo, Nombre, ApellidoPat, ApellidoMat, (select Nombre From tblarea where tblarea.codigo=tblusuario.area) as Area,(select Nombre From tblcondicion where tblcondicion.codigo=tblusuario.condicion) as Condicion,Acceso FROM tblusuario WHERE Estado='A' and Usser ='".$nombre."' AND Pass ='".$pass."' ";
	$consulta  = mysqli_query($conexion, $sql);
	//$consulta  = $conn->query($sql);

	if(mysqli_num_rows($consulta)> 0){
		
		ini_set("session.gc_maxlifetime","30000");
		session_start();
		$_SESSION['User'] = 1;
												
		while ($reg = mysqli_fetch_array($consulta))
		{  
			$_SESSION['Codigo']=$reg[0];
			$_SESSION['Nombre']=$reg[1];
			$_SESSION['Paterno']=$reg[2];
			$_SESSION['Materno']=$reg[3];
			$_SESSION['Area']=$reg[4];
			$_SESSION['Condicion']=$reg[5];
			$_SESSION['Acceso']=$reg[6];			
		}

		if($_SESSION['Acceso']=="0000000001"){ 		
			?>
			<script language="javascript" type="text/javascript">		
				document.location.href = "../Admin.php";
			</script>
			<?php
		}		
		else {			
			?>
			<script language="javascript" type="text/javascript">
			document.location.href = "../Principal.php";
			</script>
			<?php
		}
	}
	else{
		?>
				<script language="javascript" type="text/javascript">
				alert('Sus Datos son Incorrectos'); 
				document.location.href = "../Index.php";
				</script>
		<?php
	}
}
?>