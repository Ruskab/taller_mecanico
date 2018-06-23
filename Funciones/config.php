<?php

function conexion_mysqli($s1,$s2,$s3,$s4){
	$db_host = $s1;
	$db_user = $s2;
	$db_pass = $s3;
	$database =$s4;

	// Create connection
	$conexio = new mysqli($s1, $s2, $s3, $s4);
	// Check connection
	if (!$conexio) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	return $conexio;
}

function query($conn,$sql){

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0) {
	    echo "0 results";
	}
	return $result;
}
 
      //VALIDACION DE INPUTS
          function test_input($data) {
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }
?>