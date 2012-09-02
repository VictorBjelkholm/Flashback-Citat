<?php
require_once('inc/config.php');
require_once(header);
?>
<div id="quotes" class="grid_12">
	<?php
	if(isset($_GET['id'])) {
		$quotes = getSingleQuote($_GET['id']);
		while($row = mysql_fetch_array($quotes)){
			echo "<div class='quote'>";
			echo nl2br(htmlspecialchars($row['quote']));
			echo "<div class='meta'>[".$row['upvotes']."] <a href='vote.php?id=".$row['id']."'>Uppröst</a></div>";
			?>
        <!--<div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'flashbackcitat'; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>-->
			<?php
			echo "</div>";
		}
	} else {
		?>
		<h3>Bästa citaten:</h3>
		<?php
		$quotes = getTopQuotes();
		while($row = mysql_fetch_array($quotes)){
			echo "<div class='quote'>";
			echo "<a href='index.php?id=".$row['id']."'>#".$row['id']."</a><br/>";
			echo nl2br(htmlspecialchars($row['quote']));
			echo "<div class='meta'>[".$row['upvotes']."] <a href='vote.php?id=".$row['id']."'>Uppröst</a></div>";
			echo "</div>";
		}
	}
	?>
</div>
<?php
require_once(footer);
?>