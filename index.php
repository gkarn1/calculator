<!DOCTYPE HTML>
<html>
	<head>
		<script type="text/javascript" src ="jquery.js"></script>
		<!--Functions-->
		<script>
			var message="";
			function insert(num){
				document.form.textview.value = document.form.textview.value + num
			}
			
			function equal(){
				var eq = document.form.textview.value;
				var result="";
				if(eq){
					result = eval(eq);
					document.form.res.value=result;	
				}
			}
			
					
				
			function clean(){
				document.form.textview.value = "";
			}
			function back(){
				var bck = document.form.textview.value;
				document.form.textview.value = bck.substring(0, bck.length - 1);
			}
			$(document).ready(function(){
				setInterval(function(){
					
					$('#calc-history-box').load('db.php')
				}, 1000);
			});
			
			
				
		</script>
		<!--Styling Calculator-->
		<style>
		*{
			margin: 0;
			padding:0;
		}
		.main{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translateX(-50%) translateY(-50%);
		}
		.bg{
			background: linear-gradient(to right, red, blue);
			height: 100%;
		}
		.textview1{
			width: 203;
			height: 50;
			margin: 5;
			padding: 10;
			border: none;
			color: red;
		}
		.textview2{
			width: 78;
			height: 50;
			margin: 5;
			padding: 10;
			border: none;
			color: red;
		}
		.button{
			width: 50;
			height: 50;
			font-size: 20;
			margin: 3;
			cursor: pointer;
			background: red;
			border: none;
			color: white;
		}
		.button:hover{
			background-color: black;
			color: white;
		}
		#calc-history {
			float: right;
			width: 200px;
			height: 205px;
			background-color: #636363;
			border-radius: 5px;
			margin-top: 6px;
			padding: 10px;
			box-shadow: 0px 5px 10px #444444 inset;
		}

		#calc-history-box {
			width: 180px;
			height: 185px;
			resize: none;
			overflow: hidden;
		}

		#calc-history hr {
			margin-top: 5px;
			margin-bottom: 5px;
		}
		</style>
	</head>
	<body>
	<!--Body of Calculator-->
		<div class = "bg">
			<h1 align = "center">CALCULATOR</h2>
		</div>
		
		<div class = "main">
			<form name = "form" action="insertcalc.php" method="post">
				
			
			<table>
				<tr>
				<input class = "textview1" name = "textview" readonly>
				</tr>
				<tr>
				
				<input class = "textview2" name = "res" readonly>
				</tr>
				<tr>
					<td><input class = "button" type = "button" value = "7" onclick = "insert('7')"></td>
					<td><input class = "button" type = "button" value = "8" onclick = "insert('8')"></td>
					<td><input class = "button" type = "button" value = "9" onclick = "insert('9')"></td>
					<td><input class = "button" type = "button" value = "/" onclick = "insert('/')"></td>
					<td><input class = "button" type = "button" value = "C" onclick = "clean()"></td>
				</tr>
				<tr>
					<td><input class = "button" type = "button" value = "4" onclick = "insert('4')"></td>
					<td><input class = "button" type = "button" value = "5" onclick = "insert('5')"></td>
					<td><input class = "button" type = "button" value = "6" onclick = "insert('6')"></td>
					<td><input class = "button" type = "button" value = "x" onclick = "insert('*')"></td>
					<td><input class = "button" type = "button" value = "DEL" onclick = "back()"></td>
				</tr>
				<tr>
					<td><input class = "button" type = "button" value = "1" onclick = "insert('1')"></td>
					<td><input class = "button" type = "button" value = "2" onclick = "insert('2')"></td>
					<td><input class = "button" type = "button" value = "3" onclick = "insert('3')"></td>
					<td><input class = "button" type = "button" value = "-" onclick = "insert('-')"></td>
					<td rowspan=2><input id="sub" class = "button" type = "submit" value = "=" onclick="equal()" style="height:109px"></td>
				</tr>
				<tr>
					<td><input class = "button" type = "button" value = "." onclick = "insert('.')"></td>
					<td colspan = 2><input class = "button"  style = "width: 109" type = "button" value = "0" onclick = "insert('0')"></td>
					<td><input class = "button" type = "button" value = "+" onclick = "insert('+')"></td>
				</tr>
				</form>
		</div>
	
		<div id="calc-history">
      <span>Calculation history</span>
      <hr>
      <div id="calc-history-box" >
        
      </div>
    </div>

  
	
</body>
</html>	


	
	
