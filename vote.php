<?php
require_once('inc/config.php');
$quoteId = mysql_real_escape_string($_GET['id']);
$ident = md5($_SERVER['REMOTE_ADDR']);

vote($quoteId, $ident);
?>