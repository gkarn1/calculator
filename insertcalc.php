<?php
	include 'db.php';
	$message=$_POST['message'];
	$sql=" INSERT INTO calcualtionlogs (id,message) VALUES (NULL,'$message')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	?>
