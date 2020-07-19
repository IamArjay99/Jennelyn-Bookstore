<?php

	$conn = mysqli_connect("localhost", "root", "", "jennelyn_bookstore");

	if (!$conn) {
		die("Connection failed... " . mysqli_connect_error());
	}
	else {
		// echo "Connected successfully";
	}
