<?php
include 'db.php';

$list = sql_query(array(
	'select' => 'code'
	, 'from' => 'codes'
	, 'where' => 'blacklisted = 1'
));

echo json_encode($list);

?>