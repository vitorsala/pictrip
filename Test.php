<html>
	<head>
		<meta charset="utf-8"/>
	</head>
	<body>
		<?php
			require_once 'header.php';
			require_once 'function/persistence/connection/DataBase.php';
			require_once 'function/persistence/entity/Entity.php';
			require_once 'function/persistence/dao/UserDAO.php';
			require_once 'function/business/Auth.php';
			
			$dao = UserDAO::getInstance();
			
			$r = $dao->registerNewUser("Nome", "Sobrenome", "lalala@mail.com", date("Y/m/d", mktime(0,0,0,4,3,1990)), "lalala", "M", "http://www.seletafrutas.com.br/wp-content/uploads/2011/07/melancia.jpg");
			echo "<hr/>";
			if($r)	echo "YAY!";
			else	echo "NAY!";
			
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
			$r = $auth->login("lalala@mail.com", "lalala"); 
			if($r)	echo "YAY!<br/>";
			else	echo "NAY!<br/>";

		?>
	</body>
</html>