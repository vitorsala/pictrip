<!DOCTYPE html>


<html>
	<head>
		<?php include 'header.php';?>
	</head>
	<body>
		
		<?php
			if(session_status() !== FALSE)	session_start();
			$nome = $_SESSION['name']." ".$_SESSION['surname'];
			echo "login feito com sucesso!<br/>";
			echo "Bem vindo(a) $nome.<br/>";
			echo "<img src='".$_SESSION['avatar']."' alt='Avatar'/><br/><br/>";
		?>
		<form action="doLogout.php" method="get">
			<input type="submit" value="logout"/>
		</form>
	
	</body>

</html>

