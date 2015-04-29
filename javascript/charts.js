  $(function() {
  	$('#container').highcharts({
  		chart: {
  			zoomType: 'x',
  		},
  		title: {
  			text: 'Temperatur'
  		},
  		xAxis: {
  			categories: <? php
  			$time[] = [];
  			foreach($datetimes as $val) {
  				$time[] = date("H:i:s", strtotime($val));
  			}
  			echo json_encode($time); ?>
  		},
  		yAxis: {
  			max: 20,
  			min: -10,
  			title: {
  				text: 'Temperatur'
  			}
  		},
  		series: [{
  			data: [ <? php echo join($data, ',') ?> ],
  			type: 'area',
  			pointStart: 0,
  		}]
  	});
  })
  $(function() {
  	$('#container_avg_day').highcharts({
  		chart: {
  			zoomType: 'x'
  		},
  		title: {
  			text: 'Daglig medeltemperatur'
  		},
  		xAxis: {
  			categories: <? php
  			$dayAvg[] = [];
  			foreach($days as $i) {
  				$dayAvg[] = date("d/m-y", strtotime($i));
  			}
  			echo json_encode($dayAvg); ?>
  		},
  		yAxis: {
  			title: {
  				text: 'Temperatur'
  			}
  		},
  		series: [{
  			data: [ <? php echo join($avgDay, ',') ?> ],
  			type: 'area',
  			pointStart: 0,
  		}]
  	});
  })

  $(document).ready(function() {
  	$('#summerYet').text("<?php echo $summerYet ?>");
  });
  $('.bg-holder').parallaxScroll({
  	friction: 0.5
  });
  