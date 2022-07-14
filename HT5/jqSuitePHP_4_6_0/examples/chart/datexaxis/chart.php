<?php
require_once '../../../jq-config.php';
require_once ABSPATH."php/jqUtils.php";
//require_once ABSPATH."php/jqGridPdo.php";
require_once ABSPATH."php/jqChart.php";
ini_set("display_errors","1");
//$conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);

// Tell the db that we use utf-8
//jqGridDB::query($conn,"SET NAMES utf8");

$chart = new jqChart();

//========Data conversion==================
$source = array(
array('2013-01-01',1406),
array('2013-02-01',1275),
array('2013-03-01',1522),
array('2013-04-01',1525),
array('2013-05-01',1973),
array('2013-06-01',1951),
array('2013-07-01',1807),
array('2013-08-01',1819),
array('2013-09-01',1532),
array('2013-10-01',1843),
array('2013-11-01',1786),
array('2013-12-01',1795),
array('2014-01-01',1858)
);
$data = array();
$data2 = array();
foreach ($source as $key => $value) {
	$value[0] = strtotime($value[0])*1000;
	$data[] = array($value[0], (int)$value[1]) ;
	$data2[] = array($value[0], (int)$value[1]-rand(-300,500)) ;
}
//var_dump($data);

$chart->setChartOptions(array(
	"defaultSeriesType"=>"line"
));
$chart->setTitle(array('text'=>'Dealer CA232 Activity Summary'));
$chart->setxAxis(array(
   "type"=> 'datetime',
	"tickInterval"=> 30*24 * 3600 * 1000,
	"dateTimeLabelFormats"=>array(
		"month"=> "%b %Y"
	),
	"tickWidth"=> 0,
));

$chart->addSeries("DMS Appts",$data);
$chart->addSeries("Other Appts",$data2);

echo $chart->renderChart('',true,1000, 350); 
?>
