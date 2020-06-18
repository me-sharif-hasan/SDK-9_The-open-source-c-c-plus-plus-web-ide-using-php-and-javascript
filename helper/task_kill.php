<?php
error_reporting(0);
session_start();
$session = $_SESSION['uid'];
$type=file_get_contents(__DIR__."/../temp/$session/type.dat");
$res=array();
$res['success']=false;
if($_SESSION['current_proc']!=null){
	$pid= $_SESSION['current_proc']['pid']+1;
	$out="";$rt=0;
	exec("kill $pid 2>&1",$out,$rt);
	if($rt==0){
		$res['success']=true;
	}else{
		$res['error']=json_encode($out);
	}
}
$_SESSION['current_proc']=null;
echo json_encode($res);