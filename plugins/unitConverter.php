<style>
.unt button
{
font-size: 10px;

font-weight: bold;

height: 100%;
width:100%;
}
.unt
{
height: 18px;
position : relative;
width: 210px;
}
.unt #result
{
text-transform: uppercase;
box-shadow: 0 0 3px rebeccapurple;
padding-left: 6px;
width:97%;
display: block;
font-family: sans-serif;
color: blue;
}
.hide_l
{
display:none;

}
.unt:hover
{

}
.unt:hover .hide_l,#numToConvert:focus~.hide_l
{
display: block;

position: absolute;

z-index: 35;

background: white;

padding: 10px;

width: 86%;
}
</style>
<div class="unt">
<input type="number" id="numToConvert" class="tool" style="cursor: unset;width:100%;"/>
<div class="hide_l">
<label for="numToConvert">
<button type="button" onclick="toBin()">Binary</button><br><button type="button" onclick="toHex()">Hexadecimal</button><br><button type="button" onclick="toOct()">Octal</button><br>
<p id="num" class="result" style="display:none;"></p>
<p id="base" class="result" style="display:none;"></p>
<span id="result" class="result"></span>
</label>
</div>

<script>
document.getElementById("result").innerHTML = 0;
document.getElementById("base").innerHTML = "Convert to base 10 (decimal)";
document.getElementById("num").innerHTML = "Number Entered: " + 0;
function toBin() {
  var num = parseInt(document.getElementById("numToConvert").value)
  var bin = num.toString(2);
  document.getElementById("num").innerHTML = "Number Entered: " + num;
  document.getElementById("base").innerHTML = "Convert to base 2 (binary)";
  document.getElementById("result").innerHTML = bin;
  document.getElementById("numToConvert").focus();
}
function toHex() {
  var num = parseInt(document.getElementById("numToConvert").value)
  var hex = num.toString(16);
  document.getElementById("num").innerHTML = "Number Entered: " + num;
  document.getElementById("base").innerHTML = "Convert to base 16 (hexadecimal)";
  document.getElementById("result").innerHTML = hex;
  document.getElementById("numToConvert").focus();
}
function toOct() {
  var num = parseInt(document.getElementById("numToConvert").value)
  var oct = num.toString(8);
  document.getElementById("num").innerHTML = "Number Entered: " + num;
  document.getElementById("base").innerHTML = "Convert to base 8 (octal)";
  document.getElementById("result").innerHTML = oct;
  document.getElementById("numToConvert").focus();
}
</script>
</div>