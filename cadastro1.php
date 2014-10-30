<?php
	session_start();
	
	if(!empty($_POST)){
		foreach ($_POST as $key => $value){
			$_SESSION[$key] = $value;
		}
	}
	
	if (	! isset ( $_SESSION ['nome'] ) ||
			! isset ( $_SESSION ['sobrenome'] ) ||
			! isset ( $_SESSION ['sexo'] ) ||
			! isset ( $_SESSION ['ano'] ) ||
			! isset ( $_SESSION ['mes'] ) ||
			! isset ( $_SESSION ['dia'] )) {
				header ( 'location: cadastro.php' );
	}

?>

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
		<section id=formulario>
			<form action="cadastro2.php" method="POST">
				<?php 
				if(isset($_GET['err'])){
					$err = $_GET['err'];
					if($err == 1)	echo "<p>Email não confere.</p>";
					elseif($err == 2)	echo "<p>Senha não confere.</p>";
				}?>
				<p>
					<input name="email" placeholder="Email" type="email" required />
				</p>
				<p>
					<input name="email2" placeholder="Insira o email novamente"
						type="email" required />
				</p>
				<p>
					<input name="senha" placeholder="Senha" type="password" required />
				</p>
				<p>
					<input name="senha2" placeholder="Insira a senha novamente"
						type="password" required />
				</p>
	
				<p>
					Cidade: <select name="cidade">
						<option value="São Paulo">São Paulo</option>
						<option value="Tokyo">Tokyo</option>
					</select>
				</p>
				<p>
					<input type="submit" value="Próximo!">
				</p>
			</form>
		</section>
		<?php include 'footer.php';?>
	</body>
</html>


