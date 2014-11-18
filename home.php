<?php 
require_once 'head.php';
require_once 'function/business/PostOperation.php';
if(session_status() !== FALSE)	session_start();
$op = new PostOperation();
$posts = $op->getAllPosts();
?>

<!DOCTYPE html>

<html>
	<head>
		<?php include 'header.php';?>
		<link rel="stylesheet" type="text/css" href= "style/logged.css">
	</head>
	<body>
		<section id="googleMaps"></section>
		<nav class="mainNav">
			<ul>
				<li id="banner"><img src="style/img/banner.jpeg" alt="Bannner" /></li>
				<li>
					<form id="searchForm" method="get">
						<input type="text" name="search" placeholder="Busca" /> 
						<input type="submit" value="" />
					</form>
				</li>
				<li id="configBtn"><a href="admin.html">
					<img src="style/img/icons/config.jpg" alt="Configuração" />
				</a></li>
				<li id="avatar"><a href="index.html">
					<img src="style/img/avatar.gif" alt="Avatar" />
				</a></li>
				<li id="logout"><a href="doLogout.php">
					<img src="style/img/icons/logout.jpg" alt="Logout" />
				</a></li>
				<li id="home"><a href="index.php">
					<img src="style/img/icons/home.png" alt="Home" />
				</a></li>
			</ul>
		</nav>
		<section class="contentBody">
			<section class="content">
				<form id="newPost" method="post" action="doNewPost.php">
					<h2>Novo Post</h2>
					<textarea rows="3" cols="100" name="content"></textarea><br/>
					<input type="submit" value="POSTAR!"/>
				</form>
			</section>
			<section class="posts">
			<?php if($posts){
				foreach($posts as $post){
			?>
				<section class="content">
					<header class="contentTitle">
						<section class="meta">
							<h2><?php echo "<img src='$post->user_avatar' alt='avatar'/>"?> <a href="#"><?php echo "$post->user_name $post->user_surname" ?></a>&nbsp;<h2>em <?php echo "$post->date"?>
						</section>
						<?php 
						if($post->user_id == $_SESSION['id']){
							echo "
								<form action='doPostDelete.php' method='post'>
									<input type='hidden' name='postId' value='$post->id'/>
									<input type='submit' value='deletar post'/>
								</form>
							";
						}?>
					</header>
					<article class="contentText">
						<p><?php echo $post->content?></p>
					</article>
					<content class="comments">
						<h3>Comentários</h3>
						<form id = "confComentario">
							<input type = "text" size = "100" maxlength = "200"/>
							<input type = "submit" value = "Comentar"/>
						</form>
						<div class="commentBlock"/>
							
						</div>
					</content>
				</section>
			<?php }
			}
			else{ ?>
				
			<?php }?>
			</section>
		</section>
		<?php include 'footer.php';?>
	</body>

</html>

