<?php
class lang{
	private $file_formates=array('cpp' => 'cpp','c'=>'c','java'=>'java','python'=>'py','php'=>'php' );
	private $file_name=null;
	private $extension=null;
	private $code=null;
	private $input=null;
	private $id='default';
	private $temp_file_name='default';
	private $code_file_with_path='temp/default/default';
	private $input_file_with_path='temp/default/default.txt';
	private $target='temp/default/default';

	private $output=array();
	private $start_time;
	private $end_time;
	private $uid;

	public function __construct($arr){
		$this->extension=$this->file_formates[$arr['mode']];
		$this->code=$arr['code'];
		$this->input=$arr['input'];
		$this->uid=$arr['uid'];
		$this->temp_file_name=$this->get_unique_name();
		$this->set_file_with_path();
	}


	private function time_set($flag=false){
		if(!$flag)
			$this->start_time=microtime(true);
		else
			$this->end_time=microtime(true);
	}
	private function set_type($what){
		$this->save($what,$this->get_execution_dir()."/type.dat");
	}
	private function set_file_with_path(){
		$this->code_file_with_path=$this->get_execution_dir().$this->temp_file_name;
		$this->input_file_with_path=$this->get_execution_dir().$this->temp_file_name.'.txt';
	}
	private function get_id(){
		$this->id=$this->uid;//date('Y.m.d').md5(time());
		return $this->id;
	}
	private function get_unique_name(){
		$name=$this->get_id().".".$this->extension;
		return $name;
	}

	private function get_execution_dir(){
		return 'temp/'.$this->id.'/';
	}
	public function save($data,$file_name='default',$perm='w+'){
		$e=explode('/', $file_name);
		$e_length=count($e);
		$path="";
		for($i=0;$i<$e_length-1;$i++){
			if(empty($e[$i])) continue;
			else if(is_dir($path.$e[$i])){
				$path.=$e[$i]."/";
				continue;
			}
			mkdir($path.$e[$i],0777);
			$path.=$e[$i]."/";
		}
		$f=fopen($path.$e[$e_length-1], $perm) or die("Failed to open file");
		if(!empty($data)){
			fwrite($f, $data) or die("Failed to write");
		}
		fclose($f);
	}
	private function set_proc($proc){
		session_start();
		$_SESSION['current_proc']=$proc;
		session_write_close();
	}
	public function run(){
		$this->save($this->code,$this->code_file_with_path);
		$this->save($this->input,$this->input_file_with_path);
		$mode=$this->extension;
		$this->set_type($mode);
		if($mode=='c'){
			$this->c();
		}elseif($mode=='cpp'){
			$this->cpp();
		}elseif($mode=='py'){
			$this->py();
		}elseif($mode=='php'){
			$this->php();
		}elseif($mode=='java'){
			$this->java();
		}
		else{
			$this->output['error']='No compiler/interpreter found';
		}
	}
	public function get_output(){
		$this->output['execution_time']=number_format((float)($this->end_time-$this->start_time), 2, '.', '');
		$json_data=json_encode($this->output);
		$json_data=str_replace(array($this->id),array('hidden'),$json_data);
		return $json_data;
	}
	private function c(){
		$this->output["compiler"]='gcc';
		$this->target=$this->get_execution_dir().$this->id.".exe";
		$execution=$this->executor('gcc -std=c99 -g -o %target% %source%');
		if($execution[2]){
			$this->output['error']=$execution[0];
		}elseif(!empty($execution[0])&&$execution[2]==0){
			$this->output['warning']=$execution[0];
		}
		if($execution[2]==0){
			$this->time_set();
			$out=$this->executor('%target%<%input%');
			$this->time_set(true);
			$this->output['output']=$out[1];
		}
	}
	private function cpp(){
		$this->output["compiler"]='g++';
		$this->target=$this->get_execution_dir().$this->id.".exe";
		$execution=$this->executor('g++ -std=c++11 -g -o %target% %source%');
		if($execution[2]){
			$this->output['error']=$execution[0];
		}elseif(!empty($execution[0])&&$execution[2]==0){
			$this->output['warning']=$execution[0];
		}
		if($execution[2]==0){
			/*
			if it throws an error like
			@ /opt/lampp/lib/libstdc++.so.6: version `GLIBCXX_3.4.21' not found (required by temp/xxx
			then if linux, run this command in terminal
			#sudo mv /opt/lampp/lib/libstdc++.so.6 /opt/lampp/lib/libstdc++.so.6.orig
			*/
			$this->time_set();
			$out=$this->executor('%target%<%input%');
			$this->time_set(true);
			$this->output['output']=$out[1];
		}
	}
	private function py(){
		$this->output['interpreter']='python3';
		$this->time_set();
		/*
			@A bug here. I don't know how to input to the source
		*/
		$execution=$this->executor('python %source% %input%',true);
		$this->time_set(true);
		if($execution[2]){
			$this->output['error']=$execution[0];
		}elseif(!empty($execution[0])&&$execution[2]==0){
			$this->output['warning']=$execution[0];
		}
		if($execution[2]==0){
			$this->output['output']=$execution[1];
		}
	}
	private function php(){
		$this->output['interpreter']='php';
		$this->time_set();
		$execution=$this->executor('php %source% < %input%',true);
		$this->time_set(true);
		$this->output['output']=$execution[1];
		if($execution[2]){
			$this->output['error']=$execution[0];
		}elseif(!empty($execution[0])&&$execution[2]==0){
			$this->output['warning']=$execution[0];
		}
	}
	private function java(){
		$this->output['compiler']='java';
		$this->time_set();
		$execution=$this->executor('java %source% < %input%');
		$this->time_set(true);
		$this->output['output']=$execution[1];
		if($execution[2]){
			$this->output['error']=$execution[0];
		}elseif(!empty($execution[0])&&$execution[2]==0){
			$this->output['warning']=$execution[0];
		}
	}

	private function cli_helper($cli_map){
		$find = array('%source%','%target%','%input%');
		$replace = array($this->code_file_with_path,$this->target,$this->input_file_with_path);
		return str_replace($find, $replace, $cli_map);
	}
	private function executor($cmd,$interpreter=false){
		  $cmd=$this->cli_helper($cmd);
			$out="";$rt=0;$stderr="";$stdout="";
    		$proc = proc_open($cmd,array(
						0 => array('pipe','r'),
        		1 => array('pipe','w'),
        		2 => array('pipe','w'),
    		),$pipes);
    		$this->set_proc(proc_get_status($proc));
    		$stdout = stream_get_contents($pipes[1]);
    		fclose($pipes[1]);
    		$stderr = stream_get_contents($pipes[2]);
    		fclose($pipes[2]);
    		$rt = proc_close($proc);
    		$this->set_proc(null);
	    return array($stderr,$stdout,$rt);
	}

}
