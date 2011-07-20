<?php

	/**
	 * Returns an order based on GET 'order' param if available
	 * 
	 * @return an item from the global $orders object
	 */
	function getOrderData() {
		global $orders;
		
		// Pick the order requested by the GET 'order' param if it's valid
		if (isset($_GET['order']) AND $_GET['order'] < count($orders)) {
			$order_id = $_GET['order'];
		}
		// Otherwise pick a random order
		else {
			$order_id = rand(0, count($orders) - 1);
		}
		
		return $orders[$order_id];
	}
	
	/**
	 * Returns a monster image path based on GET 'monster' param if available
	 * 
	 * @return string, path to a valid monster image
	 */
	function getMonster() {
		global $view_data;
		
		$num_monsters = count(glob('img/monsters/*.png'));
		
		// Pick the monster requested by the GET 'monster' param if it's valid
		if (isset($_GET['monster']) AND $_GET['monster'] < $num_monsters) {
			$monster_id = $_GET['monster'];
		}
		// Otherwise pick random monster, hashing based on order number
		else {
			$monster_id = base_convert($view_data['order']['id'], 32, 10) % $num_monsters;
		}

		return "img/monsters/monster{$monster_id}.png";
	}

	/**
	 * Returns a monster position ID based on GET 'monsterPos' param if available
	 * 
	 * @return string, monster position class (further definition in CSS)
	 */
	function getMonsterPos() {
		global $view_data;
		
		$num_positions = 3;

		// Pick the monster position requested by the GET 'monsterPos' param if
		// it's valid
		if (isset($_GET['monsterPos']) AND $_GET['monsterPos'] < $num_positions) {
			$pos_id = $_GET['monsterPos'];
		}
		// Otherwise select random position
		else {
			$pos_id = rand(0, $num_positions);
		}

		return "monsterPosition{$pos_id}";
	}

	/**
	 * Returns a path image path based on GET 'path' param if available
	 * 
	 * @return string, path to a valid path image
	 */
	function getPath() {
		global $view_data;
		
		$num_paths = count(glob('img/paths/*.png'));

		// Pick the path requested by the GET 'path' param if it's valid
		if (isset($_GET['path']) AND $_GET['path'] < $num_paths) {
			$path_id = $_GET['path'];
		}
		// Otherwise pick random path, hashing based on order customer's name
		else {
			$path_id = base_convert($view_data['order']['name'], 32, 10) % $num_paths;
		}

		return "img/paths/path{$path_id}.png";
	}

?>
