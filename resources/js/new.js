var code_tab_button=$("#code-tab");
var input_tab_button=$("#input-tab");
var output_tab_button=$("#output-tab-button");
var run_button=$("#run-button");
var stop_button=$("#stop-button");
var fullscreen_button=$("#fullscreen-button");
var save_button=$("#save-button");
var copy_button=$("#copy-button");

var code_form=$("#code-form");

var code_tab_button_target=$("#"+code_tab_button.data("target"));
var input_tab_button_target=$("#"+input_tab_button.data("target"));
var output_tab_button_target=$("#"+output_tab_button.data("target"));

var notification_firstrun=$("#notification-firstrun");
var notification_updated=$("#notifiation-updated");
var output_terminal= $("#output-terminal");
var output_terminal= $("#output-terminal");
var progress_overlay=$("#progress-overlay");

resize();

stop_button.prop('disabled',true);

input_tab_button.click(function (){switch_input_tab(); });

output_tab_button.click(function (){switch_output_tab();});
run_button.click(function(){switch_output_tab();run();});
stop_button.click(function(){
	stop_current_run();
})
code_tab_button.click(function (){switch_code_tab();});
save_button.click(function(e){save(e);});
copy_button.click(function(){
	var temp = $("<textarea>");
	$("body").append(temp);
	temp.val($("#program").text()).select();
	document.execCommand("copy");
	temp.remove();
});

$(window).keydown(function (e){
	if(e.ctrlKey&&e.key.toLowerCase()=='s'){
		save(e);
		return false;
	}
});

fullscreen_button.click(function(){
	toggleFullScreen($("#"+fullscreen_button.data("target"))[0]);
});
window.onbeforeunload = function() { return "Dude, are you sure you want to leave? Think of the kittens!"; }


function run() {
	var url = code_form.attr('action');
	var out = $("#output-terminal");
	run_button.addClass("is-loading");

	run_button.prop('disabled', true);/* @@@@*/
	stop_button.prop('disabled',false);

	notification_firstrun.addClass('is-hidden');
	progress_overlay.removeClass('is-hidden');
	$.ajax({
		type: "POST",
		url: "process.php",
		data: code_form.serialize(), // serializes the form's elements.
		success: function (data) {
			var json = JSON.parse(data);
			progress_overlay.addClass('is-hidden');
			var err="";
			var war="";
			var out="";
			output_terminal.css('color','white');
			if(json['error']!=undefined&&json['error']!=""){
				output_terminal.css('color','red');
				err=json['error'];
			}
			if(json['warning']!=undefined&&json['warning']!=""){
				war=json['warning'];
			}
			if(json['output']!=undefined&&json['output']!=""){
				out=json['output']+"\n"+"Execution time: "+json['execution_time']+" seconds\n\n";
			}
			output_terminal.html(out+war+"\n\n"+err);
			run_button.removeClass("is-loading");
			run_button.prop('disabled', false);/* @@@@*/
			stop_button.prop('disabled',true);
		}
	});

	return false;
}




function switch_input_tab(){
	input_tab_button_target.removeClass("is-hidden");
	code_tab_button_target.addClass("is-hidden");
	output_tab_button_target.addClass("is-hidden");

	input_tab_button.addClass("is-active");
	code_tab_button.removeClass("is-active");
	output_tab_button.removeClass("is-active");
}
function switch_output_tab(){
	input_tab_button_target.addClass("is-hidden");
	code_tab_button_target.addClass("is-hidden");
	output_tab_button_target.removeClass("is-hidden");

	input_tab_button.removeClass("is-active");
	code_tab_button.removeClass("is-active");
	output_tab_button.addClass("is-active");
}
function switch_code_tab(){
	input_tab_button_target.addClass("is-hidden");
	code_tab_button_target.removeClass("is-hidden");
	output_tab_button_target.addClass("is-hidden");

	input_tab_button.removeClass("is-active");
	code_tab_button.addClass("is-active");
	output_tab_button.removeClass("is-active");
}

function stop_current_run(){
	$.get("helper/task_kill.php",function(rt){
		json=JSON.parse(rt);
		if(json['success']){
			run_button.prop('disabled', false);/* @@@@*/
			run_button.removeClass('is-loading');
			stop_button.prop('disabled',true);
		}else{
			console.log(json['error']);
		}
	});
}

function resize(){
	var size = $(document).height();
	//var top_space=$("#code-tabs-level").outerHeight(true);
	//var size=doc_size-top_space;
	//console.log(size+" "+$("#code-tabs-level").height());
	code_tab_button_target.height(size);
	input_tab_button_target.height(size);
	output_tab_button_target.height(size);
}

function save(e){
	var dfn="sdk9_save_file"+"."+$("#lang-select").data('ext');
	var cfn=prompt('What will be your file name?', dfn);
	if(cfn==null) return 0;
	saveData($("#program").text(),dfn);
}

function saveData(data, fileName) {
    var a = document.createElement("a");
    document.body.appendChild(a);
    a.style = "display: none";

    var json = JSON.stringify(data),
        blob = new Blob([data], {type: "text/plain;charset=utf-8"}),
        url = window.URL.createObjectURL(blob);
    a.href = url;
    a.download = fileName;
    a.click();
    window.URL.revokeObjectURL(url);

}

function toggleFullScreen(elem) {

  if (!document.fullscreenElement &&    // alternative standard method
      !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
    if (elem.requestFullscreen) {
      elem.requestFullscreen();
    } else if (elem.msRequestFullscreen) {
      elem.msRequestFullscreen();
    } else if (elem.mozRequestFullScreen) {
      elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) {
      elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    }

  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
  }
  resize();
}

function set_active(btn){
	var icon=btn.first().children(":first").attr('src');
	$("#active-icon").attr('src',icon);
	$("#active-lang-name").text(btn.text());
  $("#lang-mode-in").val(btn.data('lang'));
	console.log(icon);
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}