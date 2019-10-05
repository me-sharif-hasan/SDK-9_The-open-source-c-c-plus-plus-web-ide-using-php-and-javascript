<?php
header("content-type:text/javascript");
?>


var editor = ace.edit('source');
var textarea = $("#sourceCode")[0];

textarea.innerHTML = "";
var code = `<?php echo addslashes(file_get_contents(__DIR__.'/../../sources/last')); ?>`;

		
var init_c = '#include <stdio.h>\n#define read_int(a) scanf("%d",&a)\n#define read_float(a) scanf("%f",&a)\n#define read_long(a) scanf("%I64d",&a)\n\n#define print_int(a) printf("%d",a)\n#define print_float(a) printf("%f",a)\n#define print_long(a) printf("%I64d",&a)\n\n#define min(a,b) a>b?b:a\n#define max(a,b) a>b?a:b\n\n#define FOR(i,n) for(i=0;i<n;i++)\n\n#define endl printf("\\n")\n\nint main() {\n    \n\n\n\n\n    return 0;\n}\n';
		
var init_cpp = '/*\nSharif Hasan - CSE, PUST\n<?php echo date('M d, Y h: i A ',time()) ?>\n*/\n#include<bits\/stdc++.h>\r\n#define br cout<<\"\\n\"\r\n#define FOR(i,n) for(i=0;i<n;i++)\n#define FROM(a,i,n) for(i=a;i<n;i++)\n#define IOS ios_base::sync_with_stdio(0);cin.tie(0);cout.tie(0);\r\n\nusing namespace std;\n\n\/*Main function*\/\r\nint main()\r\n{\r\n\r\n\nreturn 0;\n}';






function submitF() {

	var form = $("#code");
	var url = form.attr('action');
	var out = $("#output");
	$("#loader")[0].style.display = "block";
	$.ajax({
		type: "POST",
		url: "process.php",
		data: form.serialize(), // serializes the form's elements.
		success: function (data) {
			$("#loader")[0].style.display = "none";
			out.html(data);
		}
	});

	return false;
}




editor.setTheme("ace/theme/textmate");
editor.setShowPrintMargin(false);
editor.session.setMode("ace/mode/c_cpp");



editor.setValue(code);
textarea.innerHTML = code;

editor.getSession().on("change", function () {
	var text = (editor.getSession().getValue());
	textarea.innerHTML = text;
	editor.setOptions({
		enableBasicAutocompletion: true,
		enableSnippets: true,
		enableLiveAutocompletion: true
	});


});





/**
#Tool box javascript
**/




	function stop( rec ) {
		jQuery.get( "taskkill.php?kill=" + rec, function ( data ) {
			console.log( data );
		} );
	}



	document.body.onload = function () {


		var mode_c = $( ".c_style_filler" );
		var mode_cpp = $( ".Cpp_style_filler" );
		if ( $( "#mode" )[ 0 ].value == "C" ) {
			mode_c[ 0 ].style.background = "blue";
			mode_cpp[ 0 ].style.background = "#eee";
		}

		function fill( what ) {
			textarea.innerHTML = init_c;
			$( "#mode" )[ 0 ].value = what;

			if ( $( "#mode" )[ 0 ].value == "C" ) {
				editor.setValue( init_c );
				mode_c[ 0 ].style.background = "red";
				mode_cpp[ 0 ].style.background = "#eee";
			} else {
				editor.setValue( init_cpp );
				mode_c[ 0 ].style.background = "#eee";
				mode_cpp[ 0 ].style.background = "red";
			}

		}

		$( ".c_style_filler" ).click( function () {
			fill( "C" );
		} );

		$( ".Cpp_style_filler" ).click( function () {
			fill( "Cpp" );
		} );





	}


	function star() {
		var edtr = ace.edit( 'source' );
		var d = new Date();
		var doc = window.prompt( "File name?", "File " + d + ".cpp" );
		if ( doc != null ) {
			var text = ( editor.getSession().getValue() );
			$.post( "save.php", {
				code: text,
				name: doc
			}, function ( r ) {
				if ( r == "Faild" ) alert( "Error in saving the file!" );
				else alert("File saved in Favourits folder");
			} );

		}
	}