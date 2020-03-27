<?php

	include 'db.php';
	$textview=$_POST['textview'];
	$res=$_POST['res'];
	$message = $textview." = ".$res;
	$sql=" INSERT INTO calculationlogs VALUES ('NULL','$message')";
	if ($conn->query($sql) === TRUE) {
		header("Location:http://localhost/Project_Calculator/");
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>
		