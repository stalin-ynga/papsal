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
$chart->setChartOptions(array(
	"polar"=>true
))->setTitle(array(
	'text'=>'Highcharts Polar Chart'
))->setPane(array(
	"startAngle"=> 0,
	"endAngle"=>360
))->setxAxis(array(
	"tickInterval"=>45,
	"min"=> 0,
	"max"=>360,
	"labels"=>array("formatter"=>"js:function(){ return this.value; }")	
))->setyAxis(array(
	"min"=>0
))->setPlotOptions(array(
	"series"=>array(
		"pointStart"=>0, 
		"pointInterval"=>45
	),
	"column"=>array(
		"pointPadding"=>0, 
		"groupPadding"=>0
	)
))
->addSeries('Column', array(8, 7, 6, 5, 4, 3, 2, 1))
->setSeriesOption('Column', array(
	"type"=>"column",
	"pointPlacement"=>'between'
))
->addSeries('Line', array(1, 2, 3, 4, 5, 6, 7, 8))
->setSeriesOption('Line',array(
	"type"=>"line"
))
->addSeries('Area', array(1, 8, 2, 7, 3, 6, 4, 5))
->setSeriesOption('Area',array(
	"type"=>"area"
));
echo $chart->renderChart('',true,700, 350);

?>
