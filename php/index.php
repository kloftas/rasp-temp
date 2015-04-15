<html>

  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
  	<link href="./bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="./bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="./Parallax-Scroll/dist/jquery.parallax-scroll.js"></script>
  </head>
  <body>
  <?php
    $db = new SQLite3('templog.db');
    $results = $db->query('SELECT * FROM (SELECT * FROM temps ORDER BY date DESC LIMIT 288) sub ORDER BY date ASC');
    while ($row = $results->fetchArray()) {
		$data[] = $row['temp'];
		$datetimes[] = $row['date'];
	}

	$avgtemp = $db->query('SELECT date, AVG(temp) AS avg FROM temps GROUP BY DATE(date)');
	while ($row = $avgtemp->fetchArray()) {
		$avgDay[] = $row['avg'];
		$days[] = $row['date'];
	}

	$summerRes = $db->query('SELECT AVG(temp) AS avg FROM temps GROUP BY DATE(date)
		LIMIT 7');
	while ($row = $summerRes->fetchArray()) {
		$summerTemps[] = $row['avg'];
	}

	if (sizeof($summerTemps) < 7) {
		$summerYet = "Not enough data.";
	} else {
		$pos = 0;
		foreach ($summerTemps as $val) {
			if ($val > 10) {
				$pos += 1;
			}
		}
		if ($pos >= 7) {
			$summerYet = "Yes, it's summer!";
		} else {
			$summerYet = "Nope, not summer!";
		}
	}
  ?>
	<section>
		<center><h2>Is it summer yet? </h2><h2 id="summerYet"></h2> </br></center>
    </section>
	<div id="pic1" class="bg-holder" data-width="1920" data-height="1080"></div>
	<section>
	<div class="panel panel-default">
		<div class="panel-body">
			<div id="container" style="width:100%, height:400px;"></div>
		</div>
	</div>
	</section>
	<div id="pic2" class="bg-holder" data-width="1920" data-height="1080"></div>
	<section>
	<div class="panel panel-dafult">
		<div class="panel-body">
			<div id="container_avg_day" style="width:50%, height:400px;"></div>
		</div>
	</div>
	</section>
	<div id="pic3" class="bg-holder" data-width="1920" data-height="1080"></div>
</body>
</html>
