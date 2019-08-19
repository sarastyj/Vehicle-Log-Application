<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["access_granted"] = "";
//echo "Initial Access: " .$_SESSION["access_granted"];
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
// echo "username: ".$username;
// echo "password: ".$password;

	require ('config.php');

	try{
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $result = $conn->prepare("SELECT * FROM users WHERE username ='$username' AND password ='$password'");
	       $result->execute();
	       $results = $result->fetchAll();
				 foreach ($results as $result) :
					 $user_id = $result['user_id'];
					 $user_level = $result['user_level'];
			 endforeach;
			 //echo count($results);
			 //echo $results;
			 //echo "After Loop: " .$_SESSION['access_granted'];
				 if (count($results) === 1) {
				 	$_SESSION["username"] = $username;
					$_SESSION["password"] = $password;
					$_SESSION["user_level"] = $user_level;
					$_SESSION["user_id"] = $user_id;
					$_SESSION["access_granted"] = "True";
				//echo "User Level: " .$_SESSION["user_level"];
				// 	echo count($results);
				// 	echo $results;
					header('Location: vehicles.php');
					die();
				 }
				 if(count($results) === 0) {
					 $_SESSION["access_granted"] = "False";
				    // echo "Count: ". count($results). " and Access: ". $_SESSION["access_granted"];
					 //header('Location: index.php');
				 }
				 if($_SESSION["access_granted"]==="False" || $_SESSION["access_granted"]===""){
				     header('Location: index.php');
						 die();
				     //echo "Access Granted: " .$_SESSION["access_granted"];
				 }
	      }
	     catch(PDOException $e)
	     {
	     echo "Error: " . $e->getMessage();
	     }
//echo "Login Error: " .$_SESSION["access_granted"];

//}
// else {
// 	echo '<script>
// 		alert("Username or Password Is Incorrect");
// 		window.history.back();
// 	</script>';
// }
?>
