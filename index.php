<?php
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
?>
<html>
<title>DEMO</title>
<body>
<p>HI <?php print_r($krr); ?></p>
</body>
</html>