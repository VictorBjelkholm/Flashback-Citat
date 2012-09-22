<?php
require_once('inc/config.php');
require_once(header);
$sort = "top";
if(isset($_GET['sort']))
	$sort = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['sort']);

?>
<div id="quotes" class="grid_12">
	<div id="submenu">
		<?php
		$menuItem = array(
			"Topplista" => "top",
			"Nyaste" => "new",
			);

		foreach ($menuItem as $name => $link) {
			if($link == $sort)
				echo '<a href="?sort='.$link.'" class="active">'.$name.'</a>';
			else
				echo '<a href="?sort='.$link.'">'.$name.'</a>';
		}
		?>
	</div>
	<?php
	if(isset($_GET['id'])) {
		$quotes = getSingleQuote($_GET['id']);
		while($row = mysql_fetch_array($quotes)){
				echo "<div class='quote'>";
				echo "<a href='index.php?id=".$row['id']."'>#".$row['id']."</a><br/>";
				echo nl2br(htmlspecialchars($row['quote']));
				echo "<div class='meta'>[".$row['upvotes']."] <a href='vote.php?id=".$row['id']."'>Uppröst</a></div>";
				echo "</div>";
			?>
        <div id="disqus_thread"></div>
        <script type="text/javascript">
        	comments = localStorage.getItem('comments');
        	if(comments === "true") {
        		            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
	            var disqus_shortname = 'flashbackcitat'; // required: replace example with your forum shortname
	            /* * * DON'T EDIT BELOW THIS LINE * * */
	            (function() {
	                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
	                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
	                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	            })();
        	} else {
        		document.write('Kommentarer är avstängda');
        	}

        </script>
			<?php
			echo "</div>";
		}
	} else {
		if($sort == "top") {
			?>
			<h3>Topplista:</h3>
			<?php
			$quotes = getTopQuotes();
			while($row = mysql_fetch_array($quotes)){
				echo "<div class='quote'>";
				echo "<a href='index.php?id=".$row['id']."'>#".$row['id']."</a><br/>";
				echo nl2br(htmlspecialchars($row['quote']));
				echo "<div class='meta'>[".$row['upvotes']."] <a href='vote.php?id=".$row['id']."'>Uppröst</a> | <a href='index.php?id=".$row['id']."#disqus_thread' class='commentCount'>Laddar...</a></div>";
				echo "</div>";
			}
		}
		elseif($sort == "new") {
			?>
			<h3>Nyaste citaten:</h3>
			<?php
			$quotes = getNewQuotes();
			while($row = mysql_fetch_array($quotes)){
				echo "<div class='quote'>";
				echo "<a href='index.php?id=".$row['id']."'>#".$row['id']."</a><br/>";
				echo nl2br(htmlspecialchars($row['quote']));
				echo "<div class='meta'>[".$row['upvotes']."] <a href='vote.php?id=".$row['id']."'>Uppröst</a> | <a href='index.php?id=".$row['id']."#disqus_thread' class='commentCount'>Laddar...</a></div>";
				echo "</div>";
			}
		}
		?>
		 <script type="text/javascript">
		 comments = localStorage.getItem('comments');
        	if(comments === "true") {
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'flashbackcitat'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
            var s = document.createElement('script'); s.async = true;
            s.type = 'text/javascript';
            s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
            (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
    	} else {
    		var commentCounts = document.getElementsByClassName('commentCount');

    		for (var i = 0; (element = commentCounts[i]) != null; i++) {
				element.innerHTML = "";
			}
    	}
        </script>
		<?php
	}
	?>
</div>
<?php
require_once(footer);
?>