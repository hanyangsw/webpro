<?php
    # Ex 4 : Write a tweet
    try 
	{   
		$i_type = $_GET["i_type"];
		$i_text = $_GET["i_text"];
		
		if (empty($i_type) == false && empty($i_text) == false)
		{
			$remove_tag = strip_tags($i_text);
			$reg_ex = "/^(([a-zA-Z][\\-|\\s]?){1,20}([a-zA-Z]))$/"; 
			
			if (preg_match($reg_ex, $i_type)) #validate author & content
			{ 
				#call add function
				require_once('timeline.php');
				$i_class = new TimeLine();
						
				$i_class->add($i_type."|".$remove_tag);
						
				#redirect (don't modify)
				header("Location:index.php"); 
			} 
			else 
			{
				#redirect (don't modify)
				header("Loaction:error.php");
			}
		}
    } 
	catch(Exception $e) 
	{
		#redirect (don't modify)
        header("Loaction:error.php");
    }
?>
