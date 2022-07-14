<?php 
  //grafico master
  //funzione selection sul grafico master
  //this is the function that selects the dates
  $onSelection="function(event) {
    				var extremesObject = event.xAxis[0],
                    	min = extremesObject.min,
                    	max = extremesObject.max,
                    	rain = [],
						tmin = [],
						tmax = [],
						umid = [],
						rinc = [],
                    	xAxis = this.xAxis[0];
                    // reverse engineer the last part of the data
                  	jQuery.each(this.series[0].data, function(i, point) {
                     if (point.x > min && point.x < max) {
                        rain.push({
                           x: point.x,
                           y: point.y
                        });
                     }
                  	});
					jQuery.each(this.series[1].data, function(i, point) {
                     if (point.x > min && point.x < max) {
                        tmin.push({
                           x: point.x,
                           y: point.y
                        });
                     }
                  	});
					jQuery.each(this.series[2].data, function(i, point) {
                     if (point.x > min && point.x < max) {
                        tmax.push({
                           x: point.x,
                           y: point.y
                        });
                     }
                  	});
					jQuery.each(this.series[3].data, function(i, point) {
                     if (point.x > min && point.x < max) {
                        umid.push({
                           x: point.x,
                           y: point.y
                        });
                     }
                  	});
					jQuery.each(this.series[4].data, function(i, point) {
                     if (point.x > min && point.x < max) {
                        rinc.push({
                           x: point.x,
                           y: point.y
                        });
                     }
                  	});
					// move the plot bands to reflect the new detail span
                  	xAxis.removePlotBand('mask-before');
                  	xAxis.addPlotBand({
                    	id: 'mask-before',
                    	from: ".($min).",
                    	to: min,
                    	color: '#BEBEBE'
                  	});
					xAxis.removePlotBand('mask-after');
                  	xAxis.addPlotBand({
                     	id: 'mask-after',
                     	from: max,
                     	to: ".($max).",
                     	color: '#BEBEBE'
                  	});
					detailChart.series[0].setData(rain);
					detailChart.series[1].setData(tmin);
					detailChart.series[2].setData(tmax);
					detailChart.series[3].setData(umid);
					detailChart.series[4].setData(rinc);
                  	//.redraw()
					//createDetail(masterChart);
					return false;
				}";
//set the range on load				
  $onLoad="function() {
    				var min = ".($middle).",
                    	max = ".($max).",
                    	rain = [],
						tmin = [],
						tmax = [],
						umid = [],
						rinc = [],
                    	xAxis = this.xAxis[0];
                    // reverse engineer the last part of the data
                  	jQuery.each(this.series[0].data, function(i, point) {
                     if (point.x > min && point.x < max) {
                        rain.push({
                           x: point.x,
                           y: point.y
                        });
                     }
                  	});
					jQuery.each(this.series[1].data, function(i, point) {
                     if (point.x > min && point.x < max) {
                        tmin.push({
                           x: point.x,
                           y: point.y
                        });
                     }
                  	});
					jQuery.each(this.series[2].data, function(i, point) {
                     if (point.x > min && point.x < max) {
                        tmax.push({
                           x: point.x,
                           y: point.y
                        });
                     }
                  	});
					jQuery.each(this.series[3].data, function(i, point) {
                     if (point.x > min && point.x < max) {
                        umid.push({
                           x: point.x,
                           y: point.y
                        });
                     }
                  	});
					jQuery.each(this.series[4].data, function(i, point) {
                     if (point.x > min && point.x < max) {
                        rinc.push({
                           x: point.x,
                           y: point.y
                        });
                     }
                  	});
					// move the plot bands to reflect the new detail span
                  	xAxis.removePlotBand('mask-before');
                  	xAxis.addPlotBand({
                    	id: 'mask-before',
                    	from: ".($min).",
                    	to: min,
                    	color: '#BEBEBE'
                  	});
					xAxis.removePlotBand('mask-after');
                  	xAxis.addPlotBand({
                     	id: 'mask-after',
                     	from: max,
                     	to: ".($max).",
                     	color: '#BEBEBE'
                  	});
					detailChart.series[0].setData(rain);
					detailChart.series[1].setData(tmin);
					detailChart.series[2].setData(tmax);
					detailChart.series[3].setData(umid);
					detailChart.series[4].setData(rinc);
                  	detailChart.redraw();
					//.redraw()
					//createDetail(masterChart);
					return false;
				}
	  ";
  $chart_master = new jqChart();
  $chart_master->setTitle(array('text'=>''))
  			   ->setChartOptions(array(
			   						"reflow"=>false,
									"zoomType"=>"x",
									"spacingRight"=>20,
									"borderWidth"=>0,
									"backgroundColor"=>null))
			   //->setJSCode($onLoad)
			   ->setChartEvent("load", $onLoad)
			   ->setChartEvent("selection", $onSelection)
			   ->setxAxis(array(
    					"type"=>"datetime",
						"showLastLabel"=>true,
						"maxZoom"=>14 * 24 * 60 * 60 *1000,
    					//"tickInterval"=> 7 * 24 * 60 * 60 * 1000,
    					"plotBands"=>array(
										"id"=>"mask-before",
										"from"=>$min,
										"to"=>$middle,
										"color"=>"#BEBEBE"
									),
						"title"=>null))
			   ->setyAxis(array(
		  			/*T*/
					array("labels"=>array(
						  			"enabled"=>false
									),
						  "gridLineWidth"=>"0",
						  "title"=>array(
								   "text"=> null,
								   "style"=>array("color"=>'#E54B4B')
									),
						  "showFirstLabel"=> false
						),
					/*Pioggia*/
					array("labels"=>array(
						  			"enabled"=>false
									),
						  "gridLineWidth"=>"0",
						  "title"=>array(
								   "text"=> null,
								   "style"=>array("color"=>'#4572A7')
									),
						  "showFirstLabel"=> false
						),
					/*Umidità*/
					array("labels"=>array(
						  			"enabled"=>false
									),
						  "gridLineWidth"=>"0",
						  "title"=>array(
								   "text"=> null,
								   "style"=>array("color"=>'#FFA500')
									),
						  "showFirstLabel"=> false
						),
					/*Radiazione*/
					array("labels"=>array(
						  			"enabled"=>false
									),
						  "gridLineWidth"=>"0",
						  "title"=>array(
								   "text"=> null,
								   "style"=>array("color"=>'#FFE246')
									),
						  "showFirstLabel"=> false
						),))
			   ->setTooltip(array("formatter"=>"function(){return false;}"))
			   ->setLegend(array(
			   					"enabled"=>false
							))
			   ->setPlotOptions(array(
			   						"series"=>array(
												"lineWidth"=>"1",
												"marker"=>array(
															"enabled"=>false
															),
												"shadow"=>false,
												"states"=>array(
															"hover"=>array(
																		"lineWidth"=>"1"
																		)
															),
												"enableMouseTracking"=>false,
										)
									))
				->addSeries('Pioggia', $rain)
			    ->setSeriesOption('Pioggia',
				  				  array('type'=>'column', 
									    "color"=>'#4572A7',
									    "yAxis"=>1))
			    ->addSeries('Tmin', $t_min)
			    ->setSeriesOption('Tmin',
								  array('type'=>'line', 
									    "color"=>'#ADCBFF',
									    "yAxis"=>0))		 
			    ->addSeries('Tmax', $t_max)
			    ->setSeriesOption('Tmax',
								  array('type'=>'line', 
									    "color"=>'#E54B4B',
									    "yAxis"=>0))
			    ->addSeries('Umidità', $rh_max)
			    ->setSeriesOption('Umidità',
								  array('type'=>'line', 
									    "color"=>'#FFA500',
									    "yAxis"=>2))
			    ->addSeries('Radiazione', $r_inc)
			    ->setSeriesOption('Radiazione',
								  array('type'=>'line',
									    "color"=>'#FFE246',
									    "yAxis"=>3))
				->setExporting(array("enabled"=>false))
  ;
	$test=$chart_master->renderChart('master-container',true,$lar, $alt_m,'masterChart');
	$test=str_replace('var masterChart','masterChart',$test);
	//tolgo intestazione
	/*$test=str_replace('<script type="text/javascript">jQuery(document).ready(function(){',
					  '',
					  $test);
	//tolgo footer
	$test=str_replace('</script><div id="master-container" style="width:1200px;height:125px;margin: 0 auto;"></div>',
					  '',
					  $test);*/
	echo $test;
?>