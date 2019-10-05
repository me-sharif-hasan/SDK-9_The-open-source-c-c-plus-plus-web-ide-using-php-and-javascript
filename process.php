<xmp>
<?php
include("time.php");
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);


$p = $_POST;
$t=time();
$pre = file_get_contents(__DIR__."/sources/save");
$pre++;
$f = fopen(__DIR__."/sources/save", "w+");
fwrite($f, $pre);
fclose($f);

$source = "sources/$pre._upload_sources_".date('m_d_Y__H_i_s',$t).".c";
$inputs = "sources/$pre._upload_inputs_".date('m_d_Y__H_i_s',$t).".txt";
$out = "sources/$pre._upload_output_".date('m_d_Y__H_i_s',$t).".txt";
$name = "sources/$pre._upload_exe_".date('m_d_Y__H_i_s',$t).".exe";
$obj = "sources/$pre._upload_exe_".date('m_d_Y__H_i_s',$t).".o";

file_put_contents($inputs,$p["input"]);
file_put_contents($source,$p["source"]);


$f = fopen(__DIR__."/sources/last", "w+");
fwrite($f, $p["source"]);
fclose($f);

$f = fopen(__DIR__."/sources/lastTask", "w+");
fwrite($f, str_replace("sources/", "", $name));
fclose($f);


function my_shell_exec($cmd, &$stdout=null, &$stderr=null) {
    $proc = proc_open($cmd,[
        1 => ['pipe','w'],
        2 => ['pipe','w'],
    ],$pipes);
    $stdout = stream_get_contents($pipes[1]);    
    fclose($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[2]);
    proc_close($proc);
    return array($stderr,$stdout);
}

$e = my_shell_exec('g++ -g -o '.$name.' '.$source.'>error.log');

if($e[0])
{
	echo str_replace($source.":", "================================\n", $e[0]);
	echo("___________________________\n".date('M:d:Y H:i:s',time()));
	exit(file_get_contents("php://stderr"));
}



$ts = microtime(true);
$exe = __DIR__."\\".$name;
$in = __DIR__."\\".$inputs;
$out = __DIR__."\\".$out;
//echo $out;
exec("$exe < $in",$o,$e);
//var_dump($e);
$te= microtime(true);

foreach ($o as $value) {
	echo($value);
	echo "\n";
}


echo "\n================================\nExecution time: ".number_format((float)($te-$ts)+.01, 2, '.', '')." Seconds\n";
?>
</xmp>