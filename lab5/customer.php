<!DOCTYPE html>
<html>
	<head>
		<title>Fruit Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/pResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		if (!isset($_POST["name"])
				||!isset($_POST["memnum"])
				||!isset($_POST["cscheck"])
				||!isset($_POST["fruits"])
				||!isset($_POST["quantity"])
				||!isset($_POST["cardnum"])
				||!isset($_POST["cc"])
				||$_POST["name"] == ""
				||$_POST["memnum"] == ""
				||$_POST["cscheck"] == ""
				||$_POST["fruits"] == ""
				||$_POST["quantity"] == ""
				||$_POST["cardnum"] == ""
				||$_POST["cc"] == ""
			)
		{
		?>
			<!-- Ex 4 : --> 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. Try again?</p>
		
		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		} 
		elseif (!preg_match("/^[a-z]{1}([a-z]|[-]{1}[a-z]+){0,}[ ]?[a-z]{1}([a-z]|[-]{1}[a-z]+){0,}$/i", $_POST["name"])) 
		{ 
		?>
			<!-- Ex 5 : --> 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. Try again?</p>
		

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		} 
		elseif (!(preg_match("/^\d{16}/", $_POST["cardnum"]))) 
		{
		?>
			<!-- Ex 5 : --> 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. Try again?</p>
		
		<?php 
		} 
		elseif(!(preg_match("/4\d{15}/", $_POST["cardnum"]))&&$_POST["cc"] == "visa")
		{ 
		?>
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="fruitstore.html">Try again?</a></p>
			<?$_POST["cc"]?>
		<?php 
		} 
		elseif(!(preg_match("/5\d{15}/", $_POST["cardnum"]))&&$_POST["cc"] == "master")
		{ 
		?>
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="fruitstore.html">Try again?</a></p>
			<?$_POST["cc"]?>	
		<?php
		#if all the validation and check are passed 
		# 
		}
		else 
		{
		?>
			<h1>Thanks!</h1>
			<p>Your information has been recorded.</p>
		
			<?php
			function showstr($names) 
			{ 
				$s_str;
				
						for ($i=0; $i<count($names); $i++)
						{
							if(isset($names[$i]))
							{
								$s_str .= $names[$i]; 
						
								if ($i!=count($names)-1)
								{
									$s_str .= ", ";
								}
							}
						}
						
				return $s_str;
			}
			
			$name = $_POST["name"];
			$memnum = $_POST["memnum"];
			$mltstr = showstr($_POST["cscheck"]);
			$fruits = $_POST["fruits"];
			$quantity = $_POST["quantity"];
			$cardnum = $_POST["cardnum"];
			$cc = $_POST["cc"];
		?>
		
			<!-- Ex 2: display submitted data -->
			<ul> 
				<li>Name: <?=$name;?></li>
				<li>Membership Number: <?=$memnum;?></li>
				<li>Options: <?=$mltstr;?></li>
				<li>Fruits: <?=$fruits;?>-<?=$quantity;?></li>
				<li>Credit: <?=$cardnum;?>(<?=$cc;?>)</li>
			</ul>
		
		<!-- Ex 3 : -->
			<p>This is the sold fruits count list:</p> 
		<?php
			/* Ex 3: 
			 * Save the submitted data to the file 'customers.txt' in the format of : "name;membershipnumber;fruit;number".
			 * For example, "Scott Lee;20110115238;apple;3"
			 */
			$filename = "customers.txt";
			$append_text = $name . ";" . $memnum . ";" . $fruits . ";" . $quantity . "\n";
			file_put_contents($filename, $append_text, FILE_APPEND);
		?>
		
		<!-- Ex 3: list the number of fruit sold in a file "customers.txt".
			Create unordered list to show the number of fruit sold -->
		
		<?php
			function soldFruitCount($filename) 
			{ 
				$ini_ary = array(0, 0, 0, 0);
				
				foreach (file("$filename") as $name)
				{
						$ary = explode(";", $name);
						
						if ($ary[2] == "Apple")
						{
							$ini_ary[0] = $ini_ary[0] + $ary[3];  
						}
						else if ($ary[2] == "Melon")
						{
							$ini_ary[1] = $ini_ary[1] + $ary[3];  
						}
						else if ($ary[2] == "Strawberry")
						{
							$ini_ary[2] = $ini_ary[2] + $ary[3];  
						}
						else if ($ary[2] == "Orange")
						{
							$ini_ary[3] = $ini_ary[3] + $ary[3];  
						} 
				}

				return $ini_ary;
			}
		?>
		
		<ul> 
		<?php 
			$fruitcounts = soldFruitCount($filename);
			$frt_name = array("Apple", "Melon", "Strawberry", "Orange");
			
			for($i=0; $i<count($fruitcounts); $i++) 
			{
		?>
			<li><?=$frt_name[$i]?>-<?=$fruitcounts[$i]?></li>
		<?php
			}
		?>
		</ul>
	
		<?php
		}
		?>
	</body>
</html>
