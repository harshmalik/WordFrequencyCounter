
<?php
//include("fusioncharts.php");

header('Content-Type: text/html; charset=UTF-8');
//$file=fopen("sample.txt","r");
$file = file_get_contents('./sample.txt', true);
$abc=str_word_count($file,1,"utf-8");
$shortword=file("google-10000-english-usa-no-swears-short.txt",FILE_IGNORE_NEW_LINES);
$keyarr=array_flip($shortword);
$krr=array_keys($keyarr);
$krk=array_flip($krr);
for($i=0;$i<count($abc);$i++)
{
$value=(substr_count($file,$abc[$i]));
$arrays[$abc[$i]]=$value;
}
arsort($arrays);
$final_result=array_diff_key($arrays,$krk);
$files=fopen("output.txt","w");
fwrite($files,print_r($final_result,true));
fclose($files);
$jsonEncodedData =json_encode($final_result);
$jsonArray=array();
 $output_keys=array_keys($final_result);
$output_values=array_values($final_result);
						
$jsonFile=fopen("outputjson.json","w");
fwrite($jsonFile,$jsonEncodedData);
fclose($jsonFile);
$filed=fopen("outputkey.json","w");
$jsonEncodedData1 =json_encode($output_keys);

fwrite($filed,$jsonEncodedData1);
fclose($filed);
$filed1=fopen("outputValues.json","w");
$jsonEncodedData2 =json_encode($output_values);

fwrite($filed1,$jsonEncodedData2);
fclose($filed1);


 for($point=0;$point<count($output_keys);$point++){
 $jsonArrayItem = array();
		    $jsonArrayItem['label'] = $output_keys[$point];
		    $jsonArrayItem['value'] = $output_values[$point];
		    //append the above created object into the main array.
		    array_push($jsonArray, $jsonArrayItem);
			}
$jsonBarData =json_encode($jsonArray);

$files5=fopen("outputBar.json","w");
fwrite($files5,$jsonBarData);
fclose($files5);




?>
<html>
<head>
<title>DEMO</title>
  
</head>
<body>
<p>WORD FREQUENCY COUNTER- PRIME MINISTER OF INDIA SPEECHES</p>
  	<div id="chartid">This is just a replacement in case Javascript is not available or used for SEO purposes</div>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	  <script src="js/fusioncharts.js"></script>
	  <script src="js/fusioncharts.charts.js"></script>
	  <script src="js/themes/fusioncharts.theme.zune.js"></script>
	
  <script>
  $(function(){
	  $.ajax({
	    url: 'http://localhost/WordCounter/outputBar.json',
	    type: 'GET',
	    success : function(data) {
	      chartData = data;
		  
	      var chartProperties = {
	        "caption": "Most Frequent Words Used By Narender Modi",
	        "xAxisName": "Words",
	        "yAxisName": "Frequency",
	        "rotatevalues": "1",
	        "theme": "zune"
	      };
	      apiChart = new FusionCharts({
	        type: 'column2d',
	        renderAt: 'chart-container',
	        width: '11550',
	        height: '1350',
	        dataFormat: 'json',
	        dataSource: {
	          "chart": chartProperties,
	          "data": chartData
	        }
	      });
	      apiChart.render();
	    }
	  });
	});
	console.log("HI");
  </script>
	 
     <div id="chart-container">FusionCharts will render here</div>

  <div id="myDiv" style="width: 480px; height: 400px;"><!-- Plotly chart will be drawn inside this DIV --></div>
<script>


</script>
</body>
</html>