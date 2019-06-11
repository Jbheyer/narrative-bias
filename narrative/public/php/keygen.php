<?php

include 'connect.php';

session_start();

$keyid = isset($_SESSION['key']) ? $_SESSION['key'] : keygen();

function keygen($length=10)
{
	$key = '';
	list($usec, $sec) = explode(' ', microtime());
	mt_srand((float) $sec + ((float) $usec * 100000));

   	$inputs = array_merge(range('z','a'),range(0,9),range('A','Z'));

   	for($i=0; $i<$length; $i++)
	{
   	    $key .= $inputs{mt_rand(0,61)};
	}
	return 'Approv_' . $key;
}

$byPass = false;
if($_SESSION['status'] == 'success')
{
	$userid = $_SESSION['user'];
	$time = time() - $_SESSION['time'];
	$sql = "UPDATE user SET keyid='".$keyid."', totaltime=$time WHERE userid=$userid";

	if ($byPass)
	{
		$_SESSION['status']='success';
		$_SESSION['key'] = $keyid;
		header('Location: exit.php');
	}
	else 
	{
		if (mysqli_query($conn, $sql))
		{
			$_SESSION['key'] = $keyid;
		}
		else
		{
			$_SESSION['key'] = 'E_' . $keyid;
		}
  		header('Location: exit.php');

		/*
		if (mysqli_query($conn, $sql)) {

			echo '<script>console.log("key")</script>';
	 		$_SESSION['key'] = $keyid;
	 		header( 'Location: exit.php' ) ;
		} else {

  			echo mysqli_error($conn);

  			$_SESSION['key'] = 'error';

  			header( 'Location: exit.php' ) ;

		}
		*/
	}
}
else
{
	$_SESSION['key'] = 'fail';
	header( 'Location: exit.php' ) ;
}
mysqli_close($conn);
?>
