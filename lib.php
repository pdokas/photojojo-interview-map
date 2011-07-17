<?php

	function getOrderData() {
		global $orders;
		
		if (isset($_GET['order'])) {
			$order_id = $_GET['order'];
		}
		else {
			// Pick a random order
			$order_id = rand(0, count($orders) - 1);
		}

		return $orders[$order_id];
	}
	
	function getMonster() {
		global $view_data;
		
		if (isset($_GET['monster'])) {
			$monster_id = $_GET['monster'];
		}
		else {
			// Generate random monster, hashing based on order number
			$num_monsters = count(glob('img/monsters/*.png'));

			$monster_id = base_convert($view_data['order_data']['id'], 32, 10) % $num_monsters;
		}

		return "img/monsters/monster{$monster_id}.png";
	}

	function getMonsterPos() {
		global $view_data;

		if (isset($_GET['monsterPos'])) {
			$pos_id = $_GET['monsterPos'];
		}
		else {
			// Select random position
			$pos_id = rand(0, 3);
		}

		return "monsterPosition{$pos_id}";
	}

	function getPath() {
		global $view_data;

		if (isset($_GET['path'])) {
			$path_id = $_GET['path'];
		}
		else {
			// Generate random path, hashing based on order customer's name
			$num_paths = count(glob('img/paths/*.png'));

			$path_id = base_convert($view_data['order_data']['name'], 32, 10) % $num_paths;
		}

		return "img/paths/path{$path_id}.png";
	}

?>