<?php
require_once("database.php");

define("header", "inc/header.php");
define("footer", "inc/footer.php");
$errorMsg = "Något gick fel, skicka ett mail till admin förfan.";
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

mysql_connect($config['dbhost'], $config['dbuser'], $config['dbpass']) or die(mysql_error());
mysql_select_db($config['dbname']) or die(mysql_error());
mysql_set_charset('utf8'); 

function getTopQuotes() {
	$query = "SELECT * FROM citat ORDER BY upvotes DESC LIMIT 0,30"; 
	$result = mysql_query($query) or die(mysql_error());
	return $result;
}

function getNewQuotes() {
	$query = "SELECT * FROM citat ORDER BY currentTimestamp DESC LIMIT 0,30"; 
	$result = mysql_query($query) or die(mysql_error());
	return $result;
}

function getSingleQuote($id) {
	$id = mysql_real_escape_string($id);
	$query = "SELECT * FROM citat WHERE id = '$id'"; 
	$result = mysql_query($query) or die(mysql_error());
	return $result;
}

function sendQuote($quote, $username) {
	$quote = mysql_real_escape_string($quote);
	$username = mysql_real_escape_string($username);
	mysql_query("INSERT INTO citat (id, quote, submitter, tags, currentTimestamp, upvotes) VALUES (NULL, '$quote', '$username', '', CURRENT_TIMESTAMP, 1) ") or die($errorMsg);
	return true;
}

function checkVoteIdent($id, $ident) {
	// Kolla om ident med samma id redan finns i databasen
	$result = mysql_query("SELECT * FROM votes WHERE ident = '".$ident."' AND quoteId = '".$id."'");
	$num_rows = mysql_num_rows($result);
	if($num_rows == 1) {
		return false;
	} else {
		return true;
	}
}

function vote($id, $ident) {
	// kolla ident+ip, om, säg till, om inte, lägg till0
	if(checkVoteIdent($id, $ident)) {
		mysql_query("INSERT INTO votes (id, ident, quoteId) VALUES (NULL, '$ident', '$id') ") or die($errorMsg);
		mysql_query("UPDATE citat SET upvotes = upvotes + 1 WHERE id = '".$id."'");
		header("Location: index.php?id=".$id);
	} else {
		//Du har redan röstat på detta alternativet fuckface
		echo "Inte fuska. Inte bra.<br/>Fuckface.<br/><br/><a href='index.php'>Tillbaka till framsidan</a>";
	}
}