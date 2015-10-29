<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		$dbnm = $_GET["dbname"];
		$sqlqry = $_GET["sql"];
		
		$dbstr = "mysql:dbname=" . $dbnm . ";host=localhost;";
		
		print($dbstr);
		print("<br />");
		print($sqlqry);
		print("<br />");
		
		$db = new PDO($dbstr, "root", "apmsetup");
		$rows = $db->query($sqlqry);
		
		
		foreach ($rows as $row){
			?>
				<ul>
					<li> <?= $row["name"] ?></li>
				</ul>
			<?php
		}
	?>
</body>
</html>


