<?php header("refresh:10; location:index.php");?>
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
		<section id="floatingBox">
			<p>Usuário criado com sucesso!</p>
			<p>Você será redirecionado para o início em 10 segundos.</p>
		</section>
		
		<?php include 'footer.php';?>
	
	</body>
</html>