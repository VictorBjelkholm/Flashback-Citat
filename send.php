<?php
require_once('inc/config.php');
require_once(header);

?>
<div id="send" class="grid_12">
	<?php if(!isset($_GET['skicka'])) { ?>
	<form action="send.php">
		<textarea name="quote" id="quoteText" cols="60" rows="10">
Här ska ditt citat vara och det ska följa denna mall:

<Mr_Dee__> Jag bötjar äntligen bli trött
<Mr_Dee__> Hej Klos_ 
<Klos_> Tjosan!
<Mr_Dee__> Jag ska jobba idag :(
<bambicliff> När börjar du d
</textarea><br/><br/>
	Vem är du?<br/>
	<input type="textbox" value="Anonym" name="username"/><br/><br/>
	<input type="submit" value="Skicka" name="skicka"/>
	</form>

<?php
} else {
	if(sendQuote($_GET['quote'], $_GET['username'])) {
		echo "Ditt citat är nu inskickat!";
	}
}
?>
</div>	
<?php
require_once(footer);
?>