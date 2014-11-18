<!DOCTYPE html>

<html>
	<head>
		<?php include 'header.php';?>
	</head>
	<body>
		<h1>Página temporária (Home)</h1>
		<?php
			if(session_status() !== FALSE)	session_start();
			$nome = $_SESSION['name']." ".$_SESSION['surname'];
			echo "login feito com sucesso!<br/>";
			echo "Bem vindo(a) $nome.<br/>";
			echo "Avatar: <img src='".$_SESSION['avatar']."' alt='Avatar'/><br/><br/>";
		?>
		<p><a href="user.php">Configurações do usuário</a>
		<form action="doLogout.php" method="get">
			<input type="submit" value="logout"/>
		</form>
		<hr/>
		<h2>Posts:</h2>
		<form method="post" action="doNewPost.php">
			<fieldset>
				<legend>Novo Post</legend>
				<textarea rows="3" cols="100" name="content"></textarea><br/>
				<input type="submit" value="POSTAR!"/>
			</fieldset>
		</form>
		<?php 
			require_once 'function/business/PostOperation.php';
			$op = new PostOperation();
			$posts = $op->getAllPosts();
			if(!$posts)	die("Nenhum post encontrado");
			foreach ($posts as $post){
				echo "<article style='border:1px solid black;'>";
				echo "$post->user_name $post->user_surname<br/><img src='$post->user_avatar' alt='avatar'/>";
				if($post->user_id == $_SESSION['id']){
					echo "
						<form action='doPostDelete.php' method='post'>
							<input type='hidden' name='postId' value='$post->id'/>
							<input type='submit' value='deletar post'/>
						</form>
					";
				}
				echo "<br/>Data: $post->date<br/><p>$post->content</p>";
				echo "</article>";
			}
		?>
		
	</body>

</html>

