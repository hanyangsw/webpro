<?php
# Ex 5 : Delete a tweet
try 
{
	require_once('timeline.php');
	$d_class = new TimeLine();
	
	$d_num = $_GET["twnum"];
	$d_class->delete($d_num);
	
	header("Location:index.php");   
} 
catch(Exception $e) 
{
    header("Loaction:error.php");
}
?>
