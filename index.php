
<?php
include("fusioncharts.php");

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
$jsonEncodedData = json_encode($final_result);

$output_keys=array_keys($final_result);
$output_values=array_values($final_result);
						
$jsonFile=fopen("outputjson.json","w");
fwrite($jsonFile,$jsonEncodedData);
fclose($jsonFile);

?>
<html>
<head>
<title>DEMO</title>
  
</head>
<body>
<p>HI <?php print_r($output_keys); ?></p>
  	<div id="chartid">This is just a replacement in case Javascript is not available or used for SEO purposes</div>

  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <div id="myDiv" style="width: 480px; height: 400px;"><!-- Plotly chart will be drawn inside this DIV --></div>
<script>var data = [{
  type: 'bar',
  x: [20, 14, 23],
  y: ['giraffes', 'orangutans', 'monkeys'],
  orientation: 'h'
}];

Plotly.newPlot('myDiv', data);
</script>
</body>
</html>