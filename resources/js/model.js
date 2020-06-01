var editor = ace.edit("code-editor");
var codeBuffer=$("#program");
var lastMode='cpp';

ace.require("ace/ext/language_tools");

editor.setTheme("ace/theme/monokai");

editor.setShowPrintMargin(false);
editor.setOptions({
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: true
    });

editor.getSession().on("change", function () {
	var text = (editor.getSession().getValue());
	codeBuffer.text(text);
});


editor_init();

function editor_init(){
  $.get("helper/getLast.php",function(res){
    var json=JSON.parse(res);
    if(json['status']==false){
      json["mode"]='cpp';
      json["code"]=getSnipts('cpp');
    }
    set_editor(json['code']);
    var allbtns=$(".lang-select");
    for(i=0;i<allbtns.length;i++){
      var lang=$(allbtns[i]);
      if(json['mode']==lang.data('lang')){
        set_active(lang);
        set_editor_mode(lang.data("ckmode"));
        break;
      }
    }
    });
}

$(".lang-select").click(function(e){
  lng=$(e.currentTarget).data('lang');
  set_editor_mode($(e.currentTarget).data('ckmode'));
  set_editor(getSnipts(lng));
  set_active($(e.currentTarget));
  console.log($(e.currentTarget));
});


function set_editor(s){
  editor.setValue(s);
  codeBuffer.text(s);
}
function set_editor_mode(mode){
  editor.session.setMode("ace/mode/"+mode);
}
function getSnipts(last){
	return $("#"+last).text();
}
