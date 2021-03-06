<?php
error_reporting(0);
session_start();
if($_SESSION['current_proc']!=null){
	$rt=array("error"=>"You already have a running program. Click run again!");
	$_SESSION['current_proc']=null;
	echo json_encode($rt);
	exit(1);
}
$_SESSION['last_run']=json_encode($_POST);
session_write_close();
require("helper/class.lang.php");
$lang_mode=$_POST['mode'];
$code=$_POST['code'];
$std_input=$_POST['input'];
$uid=$_SESSION['uid'];
$lang=new lang(array('mode'=>$lang_mode,'code'=>$code,'input'=>$std_input,'uid'=>$uid));
$lang->run();
echo $lang->get_output();