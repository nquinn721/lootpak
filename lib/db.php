<?php
$url = "localhost";
$db = "lootpak";
$un = "root";
$pw = "";


mysql_connect($url, $un, $pw) or die("Can't connect to host");

mysql_select_db($db) or die("Can't connect to db");


function sql_query(array $sql, $not_single = false){
	$q = '';
	
	if(isset($sql['select']))
		$q .= select($sql['select']);
	else $q .= 'SELECT *';
	if(isset($sql['from']))
		$q .= from($sql['from']);
	if(isset($sql['where']))
		$q .= where($sql['where']);
	if(isset($sql['order']))
		$q .= order($sql['order']);
	if(isset($sql['limit']))
		$q .= limit($sql['limit']);
	
	// Send query
	return query($q, $not_single);
}


function select($str){
	return 'SELECT ' . $str;
}

function from($str){
	return ' FROM ' . $str;
}

function where($str){
	return ' WHERE ' . $str;
}

function order($str){
	return " ORDER BY $str";
}

function limit($str){
	return ' LIMIT ' . $str;
}

function query($str, $not_single){
	$s = mysql_query($str);
	$arr = array();
	
	// Get db rows
	while($row = mysql_fetch_assoc($s))
		$arr[] = $row;
	
	
	// If only one record
	if(count($arr) === 1 && $not_single)
		return $arr[0];
		
	return $arr;
}
?>