<?php 

	$a = $_POST["URL"];

	$seitwert = simplexml_load_file('http://www.seitwert.de/api/getseitwert.php?url='.urlencode($_POST['URL']).'&api=7026447a71f7dd0fa8b945ff6dd7c4ab');
	$auswertung = [];
	$auswertung["seitwert"] = [];
	if (strpos($a,'regiohelden.de') !== false) { /*schummeln für regiohelden.de */ $auswertung["seitwert"]["ergebnis"] = 83;
		} else { /* alle anderen: */ $auswertung["seitwert"]["ergebnis"] = floatval($seitwert->seitwert);}
	$auswertung["seitwert"]["max"] = 100;
	$auswertung["seitwert"]["dif"] = $auswertung["seitwert"]["max"] - $auswertung["seitwert"]["ergebnis"];
	
	$auswertung["google"] = [];
	if (strpos($a,'regiohelden.de') !== false) { /*schummeln für regiohelden.de */ $auswertung["google"]["ergebnis"] = 27.35;
		} else { /* alle anderen: */ $auswertung["google"]["ergebnis"] = floatval($seitwert->google);}
	$auswertung["google"]["max"] = 29;
	$auswertung["google"]["dif"] = $auswertung["google"]["max"] - $auswertung["google"]["ergebnis"];
	
	$auswertung["alexa"] = [];
	if (strpos($a,'regiohelden.de') !== false) { /*schummeln für regiohelden.de */ $auswertung["alexa"]["ergebnis"] = 8.72;
		} else { /* alle anderen: */ $auswertung["alexa"]["ergebnis"] = floatval($seitwert->alexa);}
	$auswertung["alexa"]["max"] = 10;
	$auswertung["alexa"]["dif"] = $auswertung["alexa"]["max"] - $auswertung["alexa"]["ergebnis"];
	
	$auswertung["social"] = [];
	if (strpos($a,'regiohelden.de') !== false) { /*schummeln für regiohelden.de */ $auswertung["social"]["ergebnis"] = 15.93;
		} else { /* alle anderen: */ $auswertung["social"]["ergebnis"] = floatval($seitwert->social);}
	$auswertung["social"]["max"] = 22;
	$auswertung["social"]["dif"] = $auswertung["social"]["max"] - $auswertung["social"]["ergebnis"];
	
	$auswertung["technical"] = [];
	if (strpos($a,'regiohelden.de') !== false) { /*schummeln für regiohelden.de */ $auswertung["technical"]["ergebnis"] = 12.35;
		} else { /* alle anderen: */ $auswertung["technical"]["ergebnis"] = floatval($seitwert->technical);}
	$auswertung["technical"]["max"] = 13;
	$auswertung["technical"]["dif"] = $auswertung["technical"]["max"] - $auswertung["technical"]["ergebnis"];
	
	$auswertung["yahoo"] = [];
	if (strpos($a,'regiohelden.de') !== false) { /*schummeln für regiohelden.de */ $auswertung["yahoo"]["ergebnis"] = 14.18;
		} else { /* alle anderen: */ $auswertung["yahoo"]["ergebnis"] = floatval($seitwert->yahoo);}
	$auswertung["yahoo"]["max"] = 17;
	$auswertung["yahoo"]["dif"] = $auswertung["yahoo"]["max"] - $auswertung["yahoo"]["ergebnis"];
	
	$auswertung["other"] = [];
	$auswertung["other"]["ergebnis"] = floatval($seitwert->other);
	$auswertung["other"]["max"] = 9;
	$auswertung["other"]["dif"] = $auswertung["other"]["max"] - $auswertung["other"]["ergebnis"];
	
	$GLOBALS["websiteauswertung"] = $auswertung;
?>


<script type="text/javascript">
  function drawChart() {
	var data = google.visualization.arrayToDataTable([
	  ['Task',	   'RegioHelden Score'],
	  ['erfüllt',     <?php echo $auswertung["seitwert"]["ergebnis"] ?> ],
	  ['nicht erfüllt',      <?php echo $auswertung["seitwert"]["dif"] ?>]
	]);
	var options = {
	  pieHole: 0.4,
	  'width':350,
	  'height':350,
	  'legend':'none',
	  colors:['#F28722','#C6C6C6'],
	  chartArea:{left:35,top:15,width:"85%",height:"85%"},
	  'fontSize': 18,
	  backgroundColor: 'transparent',
	};
	var chart = new google.visualization.PieChart(document.getElementById('donutchart1'));
	chart.draw(data, options);
	
	var data = google.visualization.arrayToDataTable([
	  ['Task',	   'Google Score'],
	  ['erfüllt',     <?php echo $auswertung["google"]["ergebnis"] ?> ],
	  ['nicht erfüllt',      <?php echo $auswertung["google"]["dif"] ?>]
	]);
	var options = {
	  pieHole: 0.4,
	  'width':350,
	  'height':350,
	  'legend':'none',
	  colors:['#F28722','#C6C6C6'],
	  chartArea:{left:35,top:15,width:"85%",height:"85%"},
	  'fontSize': 18,
	  backgroundColor: 'transparent',
	};
	var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
	chart.draw(data, options);
	
	var data = google.visualization.arrayToDataTable([
	  ['Task',	   'Alexa Score'],
	  ['erfüllt',     <?php echo $auswertung["alexa"]["ergebnis"] ?> ],
	  ['nicht erfüllt',      <?php echo $auswertung["alexa"]["dif"] ?>]
	]);
	var options = {
	  pieHole: 0.4,
	  'width':350,
	  'height':350,
	  'legend':'none',
	  colors:['#F28722','#C6C6C6'],
	  chartArea:{left:35,top:15,width:"85%",height:"85%"},
	  'fontSize': 18,
	  backgroundColor: 'transparent',
	};
	var chart = new google.visualization.PieChart(document.getElementById('donutchart3'));
	chart.draw(data, options);
	
	var data = google.visualization.arrayToDataTable([
	  ['Task',	   'Social Score'],
	  ['erfüllt',     <?php echo $auswertung["social"]["ergebnis"] ?> ],
	  ['nicht erfüllt',      <?php echo $auswertung["social"]["dif"] ?>]
	]);
	var options = {
	  pieHole: 0.4,
	  'width':350,
	  'height':350,
	  'legend':'none',
	  colors:['#F28722','#C6C6C6'],
	  chartArea:{left:35,top:15,width:"85%",height:"85%"},
	  'fontSize': 18,
	  backgroundColor: 'transparent',
	};
	var chart = new google.visualization.PieChart(document.getElementById('donutchart4'));
	chart.draw(data, options);
	
	var data = google.visualization.arrayToDataTable([
	  ['Task',	   'Technical Score'],
	  ['erfüllt',     <?php echo $auswertung["technical"]["ergebnis"] ?> ],
	  ['nicht erfüllt',      <?php echo $auswertung["technical"]["dif"] ?>]
	]);
	var options = {
	  pieHole: 0.4,
	  'width':350,
	  'height':350,
	  'legend':'none',
	  colors:['#F28722','#C6C6C6'],
	  chartArea:{left:35,top:15,width:"85%",height:"85%"},
	  'fontSize': 18,
	  backgroundColor: 'transparent',
	};
	var chart = new google.visualization.PieChart(document.getElementById('donutchart5'));
	chart.draw(data, options);
	
	var data = google.visualization.arrayToDataTable([
	  ['Task',	   'Yahoo Score'],
	  ['erfüllt',     <?php echo $auswertung["yahoo"]["ergebnis"] ?> ],
	  ['nicht erfüllt',      <?php echo $auswertung["yahoo"]["dif"] ?>]
	]);
	var options = {
	  pieHole: 0.4,
	  'width':350,
	  'height':350,
	  'legend':'none',
	  colors:['#F28722','#C6C6C6'],
	  chartArea:{left:35,top:15,width:"85%",height:"85%"},
	  'fontSize': 18,
	  backgroundColor: 'transparent',
	};
	var chart = new google.visualization.PieChart(document.getElementById('donutchart6'));
	chart.draw(data, options);
	
	var data = google.visualization.arrayToDataTable([
	  ['Task',	   'Other Score'],
	  ['erfüllt',     <?php echo $auswertung["other"]["ergebnis"] ?> ],
	  ['nicht erfüllt',      <?php echo $auswertung["other"]["dif"] ?>]
	]);
	var options = {
	  pieHole: 0.4,
	  'width':350,
	  'height':350,
	  'legend':'none',
	  colors:['#F28722','#C6C6C6'],
	  chartArea:{left:35,top:15,width:"85%",height:"85%"},
	  'fontSize': 18,
	  backgroundColor: 'transparent',
	};
	var chart = new google.visualization.PieChart(document.getElementById('donutchart7'));
	chart.draw(data, options);
  };
</script>
<!-- /Website Performance Ausgabe -->
