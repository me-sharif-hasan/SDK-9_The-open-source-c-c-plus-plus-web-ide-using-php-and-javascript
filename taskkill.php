<?php
include("time.php");
$file = file_get_contents("sources/lastTask");
if($_GET['kill'] == 'build')
{
$file = "cc1plus.exe";
}
exec("start /B taskkill /IM ".$file." /F", $output, $return);
var_dump($output);
echo "$file";