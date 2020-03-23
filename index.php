<?php 
  session_start();
?> 


<html>
	<head>
		<title>Calculator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1"><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">

	<?php 
		$_SESSION["uname"] = "User";
		$_SESSION["uid"] = rand(1,10);
		echo  $_SESSION["uid"];
		
		
	?>

	</head>
		
	<body>
		<div id="container" class="container">
		<div>
			<h1>Calculator</h1>
		</div>
		<div id="expression">
      
		</div>
		<div id="standard-buttons" class="container-fluid">
		
			<div class="row button-row">
				<div class="col-xs-1">
					<button id="num-7" class="btn num" title="7">7</button>
				</div>
				<div class="col-xs-1">
					<button id="num-8"  class="btn num" title="8">8</button>
				</div>
				<div class="col-xs-1">
					<button id="num-9"  class="btn num" title="9">9</button>
				</div>
				<div class="col-xs-1">
					<button id="op-divide" class="btn" title="Divide">/</button>
				</div>
				<div class="col-xs-1">
					<button id="clear" class="btn" title="Clear all">C</button>
				</div>
			</div>
			
			<div class="row button-row">
				<div class="col-xs-1">
					<button id="num-4"  class="btn num" title="4">4</button>
				</div>
				<div class="col-xs-1">
					<button id="num-5"  class="btn num" title="5">5</button>
				</div>
				<div class="col-xs-1">
					<button id="num-6"  class="btn num" title="6">6</button>
				</div>
				<div class="col-xs-1">
					<button id="op-multiply" class="btn" title="Multiply">x</button>
				</div>
				<div class="col-xs-1">
					<button id="delete" class="btn" title="Delete">DEL</button>
				</div>
			</div>
			
			<div class="row button-row">
				<div class="col-xs-1">
					<button id="num-1"  class="btn num" title="1">1</button>
				</div>
				<div class="col-xs-1">
					<button id="num-2"  class="btn num" title="2">2</button>
				</div>
				<div class="col-xs-1">
					<button id="num-3"  class="btn num" title="3">3</button>
				</div>
				<div class="col-xs-1">
					<button id="op-subtract" class="btn" title="Subtract">-</button>
				</div>
				<div class="col-xs-1">
					<button id="equals" class="btn" title="Equals">=</button>
				</div>
			</div>
			
			<div class="row button-row">
				<div class="col-xs-1">
					<button id="period" class="btn" title="Decimal point">.</button>
				</div>
				<div class="col-xs-1">
					<button id="num-0" class="btn num" title="0">0</button>
				</div>
				<div class="col-xs-1">
					<button id="op-negate" class="btn" title="Negate">(-)</button>
				</div>
				<div class="col-xs-1">
					<button id="op-add" class="btn" title="Add">+</button>
				</div>
				<div class="col-xs-1">
					<button id="free space" class="btn" title="Free Button"></button>
				</div>
			</div>
		</div>
		
		<div id="calc-history">
			<span>Calculation history</span>
				<hr>
			<div id="calc-history-box">
			</div>
			
 		</div>
    
	</div>
	
	
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script><script  src="./script.js"></script>
		<script type="text/javascript" src ="jquery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				setInterval(function(){
					$('#calc-history-box').load('db.php')
				}, 3000);
			});
		</script>

</body>
</html>
