<html>
	<head>
		<meta charset="utf-8"/>
	</head>
	<body>
		<?php
			require_once 'function/Persistence/connection/DataBase.php';
			require_once 'function/Persistence/entity/Entity.php';
			
			$db = DataBase::getInstance();
			$r = $db->consult("SELECT * FROM test");
			
			while($row = $r->fetch_assoc()){
				echo $row['test_name']."<br/>";
			}
			
			
			echo <<<EOD
				<hr/>
		
EOD;
		?>
	</body>
</html>