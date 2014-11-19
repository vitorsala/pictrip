<?php 
require_once 'head.php';
if(session_status() !== FALSE)	session_start();

?>

<!DOCTYPE html>

<html>
	<head>
		<?php include 'header.php';?>
	</head>
	<body>
		<h1>Página temporária (User)</h1>
		<a href="home.php">Voltar para HOME</a>
		
		<?php 
		foreach($_SESSION as $key => $val){
			echo "<p>$key => $val</p>";
		}
		
		?>
		<form action="doUserUpdate.php" method="post" enctype="multipart/form-data">
			<p>
				Nome: <input name="nome" placeholder="Nome" type="text"  />
			</p>
			<p>
				Sobrenome: <input name="sobrenome" placeholder="Sobrenome" type="text"  />
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
				<input type="radio" name="sexo" value="M" >Masculino</input>
				<input type="radio" name="sexo" value="F" >Feminino</input>
			</p>
			<p>Email: 
				<input name="email" placeholder="Email" type="email"  />
			</p>
			<p>Senha: 
				<input name="senha" placeholder="Senha" type="password"  />
			</p>
			
			<p>Avatar: <input type="file" name="avatar"/></p>
			<input type="hidden" name="MAX_SIZE_FILE" value="100000">
			
			<input type="submit" />
		</form>
	</body>

</html>

