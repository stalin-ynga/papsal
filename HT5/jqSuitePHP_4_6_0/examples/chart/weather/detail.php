<?php
	
	//evento redraw
	$redraw="
			jQuery.each(masterChart.series[0].data, function(i, point) {
         		if (point.x >= detailStart) {
            		detailData.push(point.y);
         		}
      		});";
	
	//middle indica l'inizio dei dati da visualizzare
	
	$chart_dett = new jqChart();
	$chart_dett->setTitle(array('text'=>'Misure',"x"=>-20))
		  ->setChartOptions(array(
		  						"reflow"=>false,
								"marginBottom"=>"120",
								"style"=>array(
											"position"=>"absolute",
										),
								))
		  //->setSubtitle(array("text"=>"Per zoomare l'area cliccare e tenere premuto"))
		  ->setxAxis(array(
    					"type"=>"datetime",
    					"tickWidth"=> 0,
						"gridLineWidth"=>1,
						"labels"=>array(
								"align"=> 'left',
								"x"=> 3,
								"y"=>-3
								),
			)) 
		  ->setLegend(array(
			   					"enabled"=>true
							))
		  ->setyAxis(array(
		  			/*T*/
					array("labels"=>array(
						  			"formatter"=>"js:function(){return this.value +'C';}",
						  			"style"=>array("color"=>'#E54B4B')
									),
						  "title"=>array(
								   'text'=> 'Temperatura',
								   "style"=>array("color"=>'#E54B4B')
									),
						  "opposite"=> true
						),
					/*Pioggia*/
					array("title"=>array(
									'text'=> 'Pioggia',
									"style"=>array("color"=>'#4572A7')
									),
						  "labels"=>array(
						  			"formatter"=>"js:function(){return this.value +'mm';}",
									"style"=>array("color"=>'#4572A7'),
									),
						  "opposite"=> true
						 ),
					/*Umidità*/
					array("title"=>array(
									'text'=> 'Umidità',
									"style"=>array("color"=>'#FFA500')
									),
						  "labels"=>array(
						  			"formatter"=>"js:function(){return this.value +'%';}",
									"style"=>array("color"=>'#FFA500')
									),
						 ),
					/*Radiazione*/
					array("title"=>array(
									'text'=> 'Radiazione',
									"style"=>array("color"=>'#FFE246')
									),
						  "labels"=>array(
						  			"formatter"=>"js:function(){return this.value +'MJ/m^2';}",
									"style"=>array("color"=>'#FFE246')
									),
						 ),
					))
		  ->setTooltip(array("formatter"=>"function(){
			  								var unit = {
												'Pioggia': 'mm',
												'Tmin': 'C',
												'Tmax': 'C',
												'Umidità': '%',
												'Radiazione': 'MJ/m^2'
												}
											[this.series.name];
											unit=' '+unit;
											return ''+Highcharts.dateFormat('%d %m %Y', this.x+24*60*60*1000) +': '+ this.y +unit;
											}"			
							)
					  )
		  ->addSeries('Pioggia', $rain)
		  ->setSeriesOption('Pioggia',
		  					array('type'=>'column', 
								  "color"=>'#4572A7',
								  "yAxis"=>1,
								  "pointStart"=>$middle,))
		  ->addSeries('Tmin', $t_min)
		  ->setSeriesOption('Tmin',
		  					array('type'=>'line', 
								  "color"=>'#ADCBFF',
								  "yAxis"=>0,
								  "pointStart"=>$middle,))		 
		  ->addSeries('Tmax', $t_max)
		  ->setSeriesOption('Tmax',
		  					array('type'=>'line', 
								  "color"=>'#E54B4B',
								  "yAxis"=>0,
								  "pointStart"=>$middle))
		  ->addSeries('Umidità', $rh_max)
		  ->setSeriesOption('Umidità',
		  					array('type'=>'line', 
								  "color"=>'#FFA500',
								  "yAxis"=>2,
								  "pointStart"=>$middle))
		  ->addSeries('Radiazione', $r_inc)
		  ->setSeriesOption('Radiazione',
		  					array('type'=>'line',
							 	  "color"=>'#FFE246',
								  "yAxis"=>3,
								  "pointStart"=>$middle))
		  //->setExporting(array(
		  //					"url"=>$export_path
			//				)) 
		  ;
	//echo $chart->renderChart('chart_dettaglio',true,700, 350);
	//echo $chart_dett->renderChart('detail-container',true,$lar, $alt_d,'detailChart');
	$test=$chart_dett->renderChart('detail-container',true,$lar, $alt_d,'detailChart');
	$test=str_replace('var detailChart','detailChart',$test);
	//tolgo intestazione
	/*$test=str_replace('<script type="text/javascript">jQuery(document).ready(function(){',
					  '',
					  $test);
	//tolgo footer
	$test=str_replace('</script><div id="detail-container" style="width:1200px;height:600px;margin: 0 auto;"></div>',
					  '',
					  $test);*/
	echo $test;
?>