<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Flashback Citat version 0.2</title>
<link rel="stylesheet" href="styles/style.css" />
<link href='http://fonts.googleapis.com/css?family=Ubuntu|Open+Sans' rel='stylesheet' type='text/css'>
<script>
var comments;

function load() { 
	var el = document.getElementById("comments");
	if(comments === "true") {
		el.innerHTML = "Stäng av kommentarer";
	} else {
		el.innerHTML = "Sätt på kommentarer";
	} 

	el.addEventListener("click", function(){
		comments = localStorage.getItem('comments');
		if(comments === null) {
			localStorage.setItem('comments', 'true');
		}
		if(comments === "true") {
			localStorage.setItem('comments', 'false');
			location.reload();
			el.innerHTML = "Stäng av kommentarer";
		} else {
			localStorage.setItem('comments', 'true');
			location.reload();
			el.innerHTML = "Sätt på kommentarer";
		}
	}, false); 
} 

document.addEventListener("DOMContentLoaded", load, false);
</script>
</head>
<body>
<div id="wrapper" class="container_12">
	<div id="header" class="grid_12">
		<div id="logo" class="grid_6 left"><a href="index.php">Flashback Citat version 0.2</a></div>
		<div id="menu" class="grid_6 right">
			<a href="index.php">Hem</a>
			<a href="send.php">Skicka</a>
			<a href="about.php">Om</a>
		</div>
	</div>
	<div id="content" class="grid_12">