<!DOCTYPE html>
<html>
	<head>
		<?php include 'header.php';?>
		<link rel="stylesheet" type="text/css" href= "style/login.css">
	</head>
	<body>
		<section id="googleMaps"></section>
		<header id="banner">
			<figure>
				<img src="style/img/banner.png" alt="pictrip"/>
			</figure>
		</header>
		<section id="formulario">
			<form action="doLogin.php" method="POST">
				<p>
					Email: <input name="mail" placeholder="Email" type="mail" required />
				</p>
				<p>
					Senha: <input name="pass" placeholder="Senha" type="password" required />
				</p>
				<p>
					<input type="submit" value="Login">
				</p>
			</form>
			<p><a href="cadastro.php">Registrar-se</a></p>
		</section>
		
		<?php include 'footer.php';?>
	
	</body>
</html>