<html>
	<head>
		<?php require_once 'header.php';?>
	</head>
	<body>
		<?php
			require_once 'function/persistence/connection/DataBase.php';
			require_once 'function/persistence/entity/Entity.php';
			require_once 'function/persistence/dao/UserDAO.php';
			require_once 'function/persistence/dao/PostDAO.php';
			require_once 'function/business/Auth.php';
			
			$dao = UserDAO::getInstance();
			
// 			$r = $dao->registerNewUser("Nome", "Sobrenome", "lalala@mail.com", date("Y/m/d", mktime(0,0,0,4,3,1990)), "lalala", "M", "http://www.seletafrutas.com.br/wp-content/uploads/2011/07/melancia.jpg");
// 			echo "<hr/>";
// 			if($r)	echo "YAY!";
// 			else	echo "NAY!";
			
// 			$r = $dao->getUserByMail("lalala@mail.com");
// 			$r->name = "Nome";
// 			$dao->updateUser($r);
			
// 			$r = $dao->deleteUser("lalala@mail.com");

// 			if($r)	echo "YAY!";
// 			else	echo "NAY!";

			
// 			$u = $dao->getUserByMail("lalala@mail.com");
// 			echo "$u->name $u->surname : $u->mail : $u->password <hr/>";

// 			$r = $dao->getAllUsers();
// 			echo $r[0]->name." ".$r[0]->surname." : ".$r[0]->mail;

			//----------------------------------//
			echo "<br/><br/>";
			$auth = new Auth();
			$r = $auth->login("teste@teste.com", "teste"); 
			if($r){
				echo "YAY!<br/>";
				$postDAO = PostDAO::getInstance();
				//$postDAO->newPost(intval($_SESSION['id']), "Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.");
					
				$posts = $postDAO->getAllPosts();
					
				foreach($posts as $post){
					echo "<hr/>";
					foreach($post as $key => $value){
						echo "$key => $value<br/>";
					}
				}
			}
			else	echo "NAY!<br/>";

		?>
	</body>
</html>