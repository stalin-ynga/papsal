<?php
require_once '../../../jq-config.php';
require_once ABSPATH."php/jqUtils.php";

require_once ABSPATH."php/jqChart.php";
ini_set("display_errors","1");

$chart = new jqChart();
$chart->setChartOptions(array(
	"defaultSeriesType"=>"gauge",
	"plotBackgroundColor" => null,
	"plotBackgroundImage"=> null,
	"plotBorderWidth"=> 0,
	"plotShadow"=> false
))
->setTitle(array('text'=>'Speedometer'))
->setPane(array(
	"startAngle"=>-150,
	"endAngle"=> 150,
	"background"=> array( array(
	            "backgroundColor" => array(
	            "linearGradient" => array( "x1"=> 0, "y1"=> 0, "x2"=> 0, "y2"=> 1 ),
	                "stops"=>array(
	                    array(0, '#FFF'),
	                    array(1, '#333')
	                )
	            ),
	            "borderWidth"=> 0,
	            "outerRadius"=> '109%'
	        ), array(
	            "backgroundColor"=>array(
	                "linearGradient"=> array( "x1"=> 0, "y1"=> 0, "x2"=> 0, "y2"=> 1 ),
	                "stops"=> array(
	                    array(0, '#333'),
	                    array(1, '#FFF')
	                )
	            ),
	            "borderWidth"=> 1,
	            "outerRadius"=> '107%'
	        ), array("",
	            // default background
	        ), array(
	            "backgroundColor"=> '#DDD',
	            "borderWidth"=> 0,
	            "outerRadius"=> '105%',
	            "innerRadius"=> '103%'
	        ))
))
->setyAxis(array(
	        "min"=> 0,
	        "max"=> 200,
	        
	        "minorTickInterval"=> 'auto',
	        "minorTickWidth"=> 1,
	        "minorTickLength"=> 10,
	        "minorTickPosition"=> 'inside',
	        "minorTickColor"=> '#666',
	
	        "tickPixelInterval"=> 30,
	        "tickWidth"=> 2,
	        "tickPosition"=> 'inside',
	        "tickLength"=> 10,
	        "tickColor"=> '#666',
	        "labels"=> array(
	            "step"=> 2,
	            "rotation"=> 'auto'
	        ),
	        "title"=> array(
	            "text"=> 'km/h'
	        ),
	        "plotBands"=>array(array(
	            "from"=> 0,
	            "to"=> 120,
	            "color"=> '#55BF3B' // green
	        ), array(
	            "from"=> 120,
	            "to"=> 160,
	            "color"=> '#DDDF0D' // yellow
	        ), array(
	            "from"=> 160,
	            "to"=> 200,
	            "color"=> '#DF5353' // red
	        ))
	    )
)
->addSeries('Speed', array(80));

echo $chart->renderChart('', true, 700, 350);

?>
