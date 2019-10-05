<?php include("time.php"); ?>
<!doctype html>
<html>

<head>
	<title>SDK-9 | Open source web ide for c/c++</title>
	<!-- Adding Javascript files -->
	<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
	<script src="assets/js/ACE/src/ace.js" type="text/javascript" charset="utf-8"></script>
	<script src="assets/js/ACE/src/ext-language_tools.js"></script>

	<!-- Adding stylesheet -->

	<link rel="stylesheet" href="assets/style/style.main.css">

</head>

<body>

	<form id="code" action="process.php" method="post" onsubmit="return submitF()">
		<?php include('toolbox.php') ?>
		<div class="container" style="overflow: normal;height: 610px;">
			<div class="left" style="width:50%;">
				<textarea name="source" placeholder="Code" id="sourceCode" style="display: none;"></textarea>
				<pre id="source" style="width: 100%;height: 620px;"></pre>


			</div>
			<div class="right">
				<textarea name="input" placeholder="input" id="input" spellcheck="false" autocorrect="off"></textarea>
				<br>
				<div id="oc" style="position: relative;">
					<span style="position: absolute;left: 37%;top: 30%;display: none;color: white;" id="loader"><img style="height: 160px;" src="assets/img/loader.gif" alt="Loading"></span>
					<div id="output">

					</div>
				</div>
			</div>
		</div>
	</form>

	<script type="text/javascript" src="assets/js/functions.php"></script>
</body>

</html>