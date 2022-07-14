<?php
require_once '../../../jq-config.php';
require_once ABSPATH."php/jqUtils.php";
require_once ABSPATH."php/jqChart.php";
ini_set("display_errors","1");
$data2 =  array( 
	array(
		"name"=>'not Watched',
		"y"=> 83.08 ,
		"color"=>'blue',
	),
	array(
		"name"=>'not Watched',
		"y"=> 86.47 ,
		"color"=>'blue',
	),
	array(
		"name"=>'not Watched',
		"y"=> 86.17 ,
		"color"=>'blue',
	)
);

$data = array(
	array(
		"y"=> 16.92,
		"color"=>"js:colors[1]"		
	),
	array(
		"y"=> 13.53,
		"color"=>"js:colors[2]",
		"drilldown"=>array(
			"name"=>'Market',
			"level"=>1,
			"type"=>"column",
			"categories"=>array('Market', 'Advanced', 'Expert'),
			"data"=>array(
				array("name"=>'A', "y"=>10838),
				array("name"=>'B', "y"=>11349),
				array("name"=>'C', "y"=>11894),
				array("name"=>'A', "y"=>10838),
				array("name"=>'B', "y"=>11349),
				array("name"=>'C', "y"=>11894)
			),
			"data2"=>array(
				array("name"=>'A', "y"=>10838),
				array("name"=>'B', "y"=>11349),
				array("name"=>'C', "y"=>11894),
				array("name"=>'A', "y"=>10838),
				array("name"=>'B', "y"=>11349),
				array("name"=>'C', "y"=>11894)
			),
			"color"=>"js:colors[2]"
		)
	),
	array(
		"y"=> 13.81,
		"color"=>"js:colors[3]",
		"drilldown"=>array(
			"name"=>'Option',
			"level"=>1,
			"type"=>"column",
			"categories"=>array('Option', 'Advanced', 'Options'),
			"data"=>array(
				array("name"=>'A', "y"=>10838),
				array("name"=>'B', "y"=>11349),
				array("name"=>'C', "y"=>11894),
				array("name"=>'A', "y"=>10838),
				array("name"=>'B', "y"=>11349),
				array("name"=>'C', "y"=>11894)
			),
			"data2"=>array(
				array("name"=>'A', "y"=>10838),
				array("name"=>'B', "y"=>11349),
				array("name"=>'C', "y"=>11894),
				array("name"=>'A', "y"=>10838),
				array("name"=>'B', "y"=>11349),
				array("name"=>'C', "y"=>11894)
			),
			"color"=>"js:colors[3]"
		)
	)	
);
$sdata = jqGridUtils::encode($data);
$sdata2 = jqGridUtils::encode($data2);
$click = <<<CLICK
function(){
	var drilldown = this.drilldown; 
	if (drilldown) { 
        this.series.chart.setTitle({text: drilldown.name});
		setChart(drilldown.name, drilldown.categories, [drilldown.data,drilldown.data2], drilldown.color, drilldown.level, drilldown.type);
	} else {
		setChart(name, categories, [$sdata2,$sdata], null, 0, 'column');
	}
}
CLICK;

$chart = new jqChart();
$chart->setChartOptions(array(
	"defaultSeriesType"=>"column"
))
->setTitle(array('text'=>'Total watched'))
->setSubtitle(array("text"=>"Click the columns to view into bundles. Click again to go back."))
->setxAxis(array("categories"=>array('How', 'market', 'option')))
->setyAxis(array(
	"title"=>array("text"=>'Total watched')
))
->setTooltip(array("formatter"=>"function(){var point = this.point, s = this.x +':<b>'+ this.y +'% market share</b><br/>'; if (point.drilldown) {s += 'Click to view '+ point.category +' what makes up this bundle';} else {s += 'Click to go to the bundles';} return s;}"))
->setPlotOptions(array(
	"column"=> array(
		"stacking"=> 'percent',
		"cursor"=>'pointer',
		"point"=>array(
			"events"=>array(
				"click"=>"js:".$click
		),
		"dataLabels"=>array(
			"enabled"=>true,
			"color"=>"js:Highcharts.getOptions().colors[0]",
			"style"=>array("fontWeight"=>'bold'),
			"formatter"=>"js:function(){return this.y +'%';}"
		)
	)
)));
//->addSeries('Education Center', array($data2, $data) );
/*
->addSeries('Education Center', $data );
*/
$chart->coptions["series"]=array(array("name"=>'Education Center', "data"=>$data2, "color"=>"white"), array("name"=>'Education Center', "data"=>$data, "color"=>"white"));

$setser = <<<SETSER
function setChart(name, categories, data, color, level, type) {
	chart.xAxis[0].setCategories(categories);
      var dataLen = data.length;
      
       chart.series[0].remove();
       if(dataLen === 1){
           chart.series[0].remove();
       } else {
           for(var i = 0; i< chart.series.length; i++){
               chart.series[i].remove();
           }
       }
       for(var i = 0; i< dataLen; i++){
      chart.addSeries({
          type: type,
         name: name,
          stacking: 'percent',
         data: data[i],
         level: level,
          
         color: color || 'white'
      });
   }
 }
SETSER;
$chart->setJSCode($setser);
//$test = $chart->getChartOptions();
//var_dump($test['series']);
echo $chart->renderChart('', true, 700, 350);

?>
