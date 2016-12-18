<?php
header('Content-Type: text/html; charset=UTF-8');
//$file=fopen("sample.txt","r");
$file = file_get_contents('./sample.txt', true);
$abc=str_word_count($file,1,"utf-8");

for($i=0;$i<count($abc);$i++)
{
$value=(substr_count($file,$abc[$i]));
$arrays[$abc[$i]]=$value;
}
arsort($arrays);
$files=fopen("output1.txt","w");
fwrite($files,print_r($arrays,true));
fclose($files);
?>
<html>
<title>DEMO</title>
<body>
<p>HI <?php print_r($arrays); ?></p>
</body>
</html>