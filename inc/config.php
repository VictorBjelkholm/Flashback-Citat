<?php
require_once("database.php");

mysql_connect($config['dbhost'], $config['dbuser'], $config['dbpass']) or die(mysql_error());
mysql_select_db($config['dbname']) or die(mysql_error());

function getTopQuotes() {
	$query = "SELECT * FROM citat ORDER BY upvotes DESC LIMIT 0,30"; 
	$result = mysql_query($query) or die(mysql_error());
	return $result;
}

$quotes = getTopQuotes();
while($row = mysql_fetch_array($quotes)){
		echo nl2br(htmlentities($row['quote']));

	}
?>