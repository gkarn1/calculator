<?php
$conn =new mysqli('localhost','root','','calculator');
if($conn->connect_error){
	die("Connection error: " . $conn->connect_error);
	
}
$result = $conn->query("SELECT message FROM calculationlogs ORDER BY id DESC");
if ($result->num_rows > 0){
	while ($row = $result->fetch_assoc()){
		
		echo $row['message']. '<br>';
	}
}
	

?>