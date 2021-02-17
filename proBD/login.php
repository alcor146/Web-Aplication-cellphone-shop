<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['Nume']) && isset($_POST['Parola'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['Nume']);
	$pass = validate($_POST['Parola']);

	if (empty($uname)) {
		header("Location: index.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM client WHERE Nume='$uname' AND Parola='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            			if ($row['Nume'] === $uname && $row['Parola'] === $pass) {
							$_SESSION['ID_client'] = $row['ID_client'];
							$_SESSION['Nume'] = $row['Nume'];
	    	
            				header("Location: home.php");
		        		exit();
            	}else{
			header("Location: index.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: index.php");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}
