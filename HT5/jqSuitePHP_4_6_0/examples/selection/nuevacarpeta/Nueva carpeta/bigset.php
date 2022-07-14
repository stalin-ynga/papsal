<?php
//ini_set('max_execution_time', 600);
// coment the above lines if php 5

$json = new Services_JSON();
// end comment
$examp = $_GET["q"]; //query number

$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
if(!$sidx) $sidx =1;


if(isset($_GET["nm_mask"]))
	$nm_mask = $_GET['nm_mask'];
else
	$nm_mask = "";
if(isset($_GET["cd_mask"]))
	$cd_mask = $_GET['cd_mask'];
else
	$cd_mask = "";
//construct where clause
$where = "WHERE 1=1";
if($nm_mask!='')
	$where.= " AND item LIKE '$nm_mask%'";
if($cd_mask!='')
	$where.= " AND item_cd LIKE '$cd_mask%'";

// connect to the database
$db = mysql_pconnect('localhost','root','')
or die("Connection Error: " . mysql_error());

mysql_select_db('dbpap') or die("Error conecting to db.");

$result = mysql_query("SELECT COUNT(*) AS count FROM tblusuario ");
$row = mysql_fetch_array($result,MYSQL_ASSOC);

$count = $row['count'];

if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;
if ($limit<0) $limit = 0;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
if ($start<0) $start = 0;
$SQL = "SELECT Codigo,NombreCom,Acceso FROM tblusuario ";
$result = mysql_query( $SQL ) or die("Couldnt execute query.".mysql_error());
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce->rows[$i]['id']=$row[Codigo];
    $responce->rows[$i]['cell']=array($row[Codigo],$row[NombreCom],$row[Acceso]);
    $i++;
} 
echo $json->encode($responce); // coment if php 5
//echo json_encode($responce);
mysql_close($db);
?>
