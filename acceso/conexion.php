<?php
function encrypt($string, $key) {
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}

function decrypt($string, $key) {
   $result = '';
   $string = base64_decode($string);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "dbpap";
// $conexion = mysql_connect($host, $user, $pass) or header('Location:../error4.php');
// mysql_select_db($db,$conexion);

$conexion = mysqli_connect($host, $user, $pass, $db);

// Check connection
   // if (!$conn) {
   //    //  die("Connection failed: " . mysqli_connect_error());
   //    die('Location:../error4.php');
   // }
   // echo "Connected successfully";
   // phpinfo();
   // mysqli_close($conn);

?>