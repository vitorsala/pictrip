<?php
	require_once 'function/persistence/entity/Entity.php';
	class Post extends Entity{
		public $user_id;
		public $user_name;
		public $user_surname;
		public $user_avatar;
		public $content;
		public $likecount;
		public $date;

		public function __construct(){}
	}

?>b