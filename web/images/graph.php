<!DOCTYPE html>
<html>
	<head>
		<title>chart created with amCharts | amCharts</title>
		<meta name="description" content="chart created using amCharts live editor" />

		<!-- amCharts javascript sources -->
		<script src="http://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
		<script src="http://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>

		<!-- amCharts javascript code -->
		<script type="text/javascript">
			AmCharts.makeChart("chartdiv",
				{
					"type": "serial",
					"categoryField": "category",
					"startDuration": 1,
					"theme": "default",
					"categoryAxis": {
						"gridPosition": "start"
					},
					"trendLines": [],
					"graphs": [
						{
							"balloonText": "[[title]] of [[category]]:[[value]]",
							"fillAlphas": 0.7,
							"id": "AmGraph-1",
							"lineAlpha": 0,
							"title": "graph 1",
							"valueField": "column-1"
						},
						
					],
					"guides": [],
					"valueAxes": [
						{
							"id": "ValueAxis-1",
							"title": "Axis title"
						}
					],
					"allLabels": [],
					"balloon": {},
					"legend": {
						"enabled": true
					},
					"titles": [
						{
							"id": "Title-1",
							"size": 15,
							"text": "Chart Title"
						}
					],
					"dataProvider": [
						{
							"category": "category 1",
							"column-1": 8,
						
						},
						{
							"category": "category 2",
							"column-1": 6,
						
						},
						{
							"category": "category 3",
							"column-1": 2,
						
						},
						{
							"category": "category 4",
							"column-1": 1,
						
						},
						{
							"category": "category 5",
							"column-1": 2,
						
						},
						{
							"category": "category 6",
							"column-1": 3,
						
						},
						{
							"category": "category 7",
							"column-1": 6,
						
						}
					]
				}
			);
		</script>
	</head>
	<body>
		<div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
	</body>
</html>