<?php
$link = mysqli_connect("localhost", "root", "", "dbpap");	   
 

   
$temp="CALL Sp_GenCodDoc('GARCIA CHAVEZ, MIGUEL ANGEL','0000000001','SS','SS','','2014-05-01 00:00:00','2014-05-02 00:00:00'); ";
 



	 mysqli_multi_query($link,$temp);
mysqli_close($link);

$link = mysqli_connect("localhost", "root", "", "dbpap");	   

$temp="CALL Sp_GenCodDoc('GARCIA CHAVEZ, MIGUEL ANGEL','0000000001','SS','SS','','2014-05-01 00:00:00','2014-05-02 00:00:00'); "; 

mysqli_multi_query($link,$temp);
mysqli_close($link);






 // echo $temp;
 // header("location:concluye.php?cod=20");


?>



