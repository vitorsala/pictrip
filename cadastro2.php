<?php
	session_start();

	if(!empty($_POST)){
		foreach ($_POST as $key => $value){
			$_SESSION[$key] = $value;
		}
	}
	
	if( !isset($_SESSION['nome']) ||
		!isset($_SESSION['sobrenome']) ||
		!isset($_SESSION['sexo']) ||
		!isset($_SESSION['ano']) ||
		!isset($_SESSION['mes']) ||
		!isset($_SESSION['dia']) ||
		!isset($_SESSION['email']) ||
		!isset($_SESSION['email2']) ||
		!isset($_SESSION['senha']) ||
		!isset($_SESSION['senha2']) ||
		!isset($_SESSION['cidade'])){
			header('location: cadastro.php');
	}
	
	if($_SESSION['email'] != $_SESSION['email2']){
		header('location: cadastro1.php?err=1');
	}
	if($_SESSION['senha'] != $_SESSION['senha2']){
		header('location: cadastro1.php?err=2');
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
		<section id= formulario>
			<form action="doUserRegister.php" method="POST" enctype="multipart/form-data">
				
				<h1> Lista de Interesses </h1></br>
				<h2> Países </h2>
				 <input type="checkbox" name="paises[]"/> Alemanha 
				 <input type="checkbox" name="paises[]"/> Brasil 
				 <input type="checkbox" name="paises[]"/> Canadá </br> 
				 <input type="checkbox" name="paises[]"/> EUA 
				 <input type="checkbox" name="paises[]"/> França 
				 <input type="checkbox" name="paises[]"/> Holanda </br>
				 <input type="checkbox" name="paises[]"/> Japão 
				 <input type="checkbox" name="paises[]"/> Itália 
				 <input type="checkbox" name="paises[]"/> Portugal </br>
				 <input type="checkbox" name="paises[]"/> Suíça 
				 <input type="checkbox" name="paises[]"/> Rússia

				<h2> Lugares </h2>

				<input type="checkbox" name="interesses[]"/> Cinemas 
				<input type="checkbox" name="interesses[]"/> Restaurantes 
				<input type="checkbox" name="interesses[]"/> Teatros 
				<input type="checkbox" name="interesses[]"/> Shows </br>
				<input type="checkbox" name="interesses[]"/> Museus 
				<input type="checkbox" name="interesses[]"/> Parques 
				<input type="checkbox" name="interesses[]"/> Baladas
				
				 
				<p>Avatar: <input type="file" name="avatar"/></p>
				<input type="hidden" name="MAX_SIZE_FILE" value="100000">

				<p> <input type="submit" value="Concluir cadastro!"> </p> 
			</form>
		</section>
		<?php include 'footer.php';?>
	</body>
</html>