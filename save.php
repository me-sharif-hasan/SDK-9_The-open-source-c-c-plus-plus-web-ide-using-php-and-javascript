<?php
error_reporting(0);
$fname = str_replace(array(":"),array("_"),$_POST['name']);
$f = fopen("Favourites/".$fname,"w+");
if(fwrite($f,$_POST["code"]))
{
echo "Success";
}
else
{
echo "Faild";
}
fclose($f);
?>