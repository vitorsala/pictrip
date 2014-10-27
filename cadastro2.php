<?php
	if( !isset($_POST['nome']) || 
		!isset($_POST['sobrenome']) ||
		!isset($_POST['sexo']) ||
		!isset($_POST['ano']) ||
		!isset($_POST['mes']) ||
		!isset($_POST['dia']) ||
		!isset($_POST['email']) || 
		!isset($_POST['email2']) ||
		!isset($_POST['senha']) ||
		!isset($_POST['senha2']) ||
		!isset($_POST['cidade'])){
			header('location: cadastro.php');
	}
	
	if($_POST['email'] != $_POST['email2']){
			header('location: cadastro1.php?err=1');
	}
	if($_POST['senha'] != $_POST['senha2']){
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
			<form action="resultado.php" method="POST">
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
				
				
				<?php
					foreach($_POST as $key => $value){
						echo "<input type=\"hidden\" name=\"$key\" value=\"".$_POST[$key]."\"/>";  
					}
				?>

				<p> <input type="submit" value="Concluir cadastro!"> </p> 
			</form>
		</section>
		<?php include 'footer.php';?>
	</body>
</html>