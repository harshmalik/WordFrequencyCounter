
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

$output_keys=array_keys($final_result);
$output_values=array_values($final_result);
						
$jsonFile=fopen("outputjson.json","w");
fwrite($jsonFile,$jsonEncodedData);
fclose($jsonFile);
$filed=fopen("outputkey.json","w");
$jsonEncodedData1 =json_encode($output_keys);
fwrite($filed,$jsonEncodedData1);
fclose($filed);

?>
<html>
<head>
<title>DEMO</title>
  
</head>
<body>
<p>HI <?php print_r($jsonEncodedData); ?></p>
  	<div id="chartid">This is just a replacement in case Javascript is not available or used for SEO purposes</div>

  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <div id="myDiv" style="width: 480px; height: 400px;"><!-- Plotly chart will be drawn inside this DIV --></div>
<script>
var xmlhttp = new XMLHttpRequest();
var abc =[];
var data=[];

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
       // console.log(myObj);
	   		abc=myObj;

    }
		console.log(abc);
		 data = [{
  type: 'bar',
  x: abc,
  y: [1,1,1,1],
  orientation: 'h'
}];


	};
xmlhttp.open("GET", "outputkey.json", true);
xmlhttp.send();

Plotly.newPlot('myDiv', data);



</script>
</body>
</html>