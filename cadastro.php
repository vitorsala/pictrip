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
			<form action="cadastro1.php" method="POST">
				<p>
					Nome: <input name="nome" placeholder="Nome" type="text" required />
				</p>
				<p>
					Sobrenome: <input name="sobrenome" placeholder="Sobrenome" type="text" required />
				</p>
				<p>
					Ano de nascimento:&nbsp; <select name="dia">
						<?php
							for($i = 1; $i <= 31; $i ++) {
								echo "<option value=\"$i\">$i</option>";
							}
						?>
					</select>/ <select name="mes">
						<?php
							for($i = 1; $i <= 12; $i ++) {
								echo "<option value=\"$i\">$i</option>";
							}
						?>
					</select>/ <select name="ano">
						<?php
							for($i = date ( 'Y' ); $i >= date ( 'Y' ) - 150; $i --) {
								echo "<option value=\"$i\">$i</option>";
							}
						?>
					</select>
				</p>
				<p>Sexo: 
					<input type="radio" name="sexo" value="M" required>Masculino</input>
					<input type="radio" name="sexo" value="F" required>Feminino</input>
				</p>
				<p>
					<input type="submit" value="Próximo!">
				</p>
			</form>
		</section>
	
		<?php include 'footer.php';?>
	
	</body>
</html>