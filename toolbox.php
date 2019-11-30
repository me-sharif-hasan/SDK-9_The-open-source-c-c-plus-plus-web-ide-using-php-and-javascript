<div class="toolbox">
	<div class="sec c1">
		<button class="c_style_filler tool" type="button">C</button>
		<button class="Cpp_style_filler tool" type="button">C++</button>
	</div>
	<div class="sec c2">
		<button class="run tool" type="submit">Run</button>
		<button class="stop tool" id="stopBTN" type="button" onclick="stop('run')" disable="true">Stop</button>
		<button class="stop_build tool" id="stopBuild" type="button" onclick="stop('build')" disable="true">StopBuild</button>
	</div>

	<?php include("plugins/unitConverter.php"); ?>

	<div class="sec c3">
		<button type="button" onclick="star()">SAVE</button>
	</div>
	<div class="sec c4">
		<button type="button" onClick="toggleFullScreen()">FullScreen</button>
	</div>
	<div class="sec c5">
		<button type="button" onClick="copyOut()">CopyOutput</button>
	</div>

</div>
<input type="hidden" name="mode" value="cpp" id="mode">
<div id="copyContext"></div>
