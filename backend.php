<?php
if (empty($_GET)) {
	if (!file_exists('./config.php')) {
		$ret = [];
		$ret['success'] = true;
		$ret['msg'] = 'intialize';
		echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		exit;
	} else  {
		$ret = [];
		$ret['success'] = true;
		$ret['msg'] = '';
		echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		exit;
	}
}

if (isset($_GET['intialize'])) {
	$post = $_POST;

	// try to connect to MySql
	mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL);
	try{
		$conn = new mysqli($post['host'] . ':' . $post['port'], $post['username'], $post['password'], $post['db']);
	} catch (mysqli_sql_exception $e) {
		$ret = [];
		$ret['success'] = false;
		$ret['msg'] = "Failed to connect to MySql: " . mysqli_connect_error();
		echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		exit;
	}

	$query = "DROP TABLE IF EXISTS `detail`";
	$result = $conn->query($query);
	if (!$result) {
		$ret = [];
		$ret['success'] = false;
		$ret['msg'] = $conn->error;
		echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		exit;
	}

	$query = "CREATE TABLE `detail`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `history_id` bigint(20) NOT NULL,
  `player` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `cards` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic";
	$result = $conn->query($query);
	if (!$result) {
		$ret = [];
		$ret['success'] = false;
		$ret['msg'] = $conn->error;
		echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		exit;
	}

	$query = "DROP TABLE IF EXISTS `history`";
	$result = $conn->query($query);
	if (!$result) {
		$ret = [];
		$ret['success'] = false;
		$ret['msg'] = $conn->error;
		echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		exit;
	}

	$query = "CREATE TABLE `history`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `people` smallint(6) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic";
	$result = $conn->query($query);
	if (!$result) {
		$ret = [];
		$ret['success'] = false;
		$ret['msg'] = $conn->error;
		echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		exit;
	}
	
	if (file_exists('./config.php')) {
		unlink('./config.php');
	}
	
	$config_file = '<?php
ini_set(\'display_errors\', 1);
ini_set(\'display_startup_errors\', 1);
error_reporting(E_ALL);

$db_host = \'' . $post["host"] . '\';
$db_port = \'' . $post["port"] . '\';
$db_name = \'' . $post["db"] . '\';
$db_username = \'' . $post["username"] . '\';
$db_password = \'' . $post["password"] . '\';

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
	$conn = new mysqli($db_host . \':\' . $db_port, $db_username, $db_password, $db_name);
} catch (mysqli_sql_exception $e) {
	$ret = [];
	$ret[\'success\'] = false;
	$ret[\'msg\'] = "Failed to connect to MySql: " . mysqli_connect_error();
	echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	exit;
}
?>';
	if (!file_put_contents('./config.php', $config_file)) {
		$ret = [];
		$ret['success'] = false;
		$ret['msg'] = "Cannot create file " . dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config.php';
		echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		exit;
	}
	
	$ret = [];
	$ret['success'] = true;
	echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	exit;
}

if (isset($_GET['play'])) {
	$post = $_POST;
	require_once('./config.php');
	
	$suits = ['S', 'H', 'D', 'C'];
	$ranks = ['A', 2, 3, 4, 5, 6, 7, 8, 9, 'X', 'J', 'Q', 'K'];
	$deck = [];
	foreach ($suits as $suit) {
		foreach ($ranks as $rank) {
			$deck[] = $suit . '-' . $rank;
		}
	}
	
	
	$people = $post['people'];
	
	if ($people == 0) {
		$ret = [];
		$ret['success'] = true;
		$ret['msg'] = 'Nobody is getting any card';
		echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		exit;
	}
	
	$players = [];
	
	while (!empty($deck)) {
		for ($i = 1; $i <= $people; $i++) {
			// Pick a random key
			$key = array_rand($deck);
			
			// Get the card
			$card = $deck[$key];
			
			// assign to players (1 by 1)
			if (!isset($players[$i])) {
				$players[$i] = [];
			}
			$players[$i][] = $card;

			// Remove the card from the deck
			unset($deck[$key]);
			
			if (empty($deck)) {
				break 2;
			}
		}
	}

	$conn->autocommit(FALSE);
	
	$query = "insert into history (`date`, `people`) values (now(), " .  (int) $people . ")";
	$result = $conn->query($query);
	if (!$result) {
		$conn->rollback();
		$ret = [];
		$ret['success'] = false;
		$ret['msg'] = $conn->error;
		echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		exit;
	}

	$last_id = $conn->insert_id;

	foreach ($players as $k => $player) {
		$cards = implode(", ", $player);
		$query = "insert into detail (`history_id`, `player`, `cards`) values (" . $last_id  . ", " .  (int) $k . ", '" . $cards . "')";
		$result = $conn->query($query);
		if (!$result) {
			$conn->rollback();
			$ret = [];
			$ret['success'] = false;
			$ret['msg'] = $conn->error;
			echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
			exit;
		}
	}

	$conn->commit();
	
	$ret = [];
	$ret['success'] = true;
	$ret['msg'] = $players;
	echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	exit;
}

if (isset($_GET['history'])) {
	require_once('./config.php');
	
	$query = "SELECT
       d.history_id,
       d.player,
			 d.cards,
       h.`date`, 
       h.people
FROM detail d
LEFT JOIN history h ON h.id = d.history_id
ORDER BY h.`date` DESC, d.player ASC;";
	$result = $conn->query($query);
	if (!$result) {
		$conn->rollback();
		$ret = [];
		$ret['success'] = false;
		$ret['msg'] = $conn->error;
		echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		exit;
	}

	$history = [];
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if (!isset($history[$row['history_id']])) {
				// $history[$row['history_id']] = [];
				$history[$row['history_id']]['id'] = $row['history_id'];
				$history[$row['history_id']]['people'] = $row['people'];
				$history[$row['history_id']]['date'] = $row['date'];
			}
			$history[$row['history_id']] ['player'][$row['player']]['player'] = $row['player'];
			$history[$row['history_id']] ['player'][$row['player']]['card'] = $row['cards'];
		}
	}

	$ret = [];
	$ret['success'] = true;
	$ret['msg'] = $history;
	echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	exit;
}

$ret = [];
$ret['success'] = true;
$ret['msg'] = '200 OK';
echo json_encode($ret, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
exit;