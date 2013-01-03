<?php
	//header('Content-type: text/html; charset=utf-8');
	@$qid = $_GET['id'];
	@$not = $_GET['not'];
	include('../db.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quotastic - A Quote Library</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css">
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
</head>

<body>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "https://connect.facebook.net/en_US/all.js#xfbml=1&appId=215538798508618";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

<?php
	
	$noQuote = 0;

	if(!isset($qid))
	{
		/* Load a Random Quote */
		if(isset($not))
		{
			$load = $DBH->prepare("SELECT * FROM quotes WHERE id!=? ORDER BY RAND() LIMIT 1");
			$load->execute(array($not));
		}
		else
		{
			$load = $DBH->prepare("SELECT * FROM quotes ORDER BY RAND() LIMIT 1");
			$load->execute();
		}
		if($load->rowCount() == 0)
		{
			$noQuote = 1;
		}
		else
		{
			while($row = $load->fetch())
			{
				$qid = $row['id'];
				$quote = $row['quote'];
				$by = $row['by'];
				//$extra = $row['extra'];
			}
		}
	}
	else
	{
		/* Load the quote with qid */
		$load = $DBH->prepare("SELECT * FROM quotes WHERE id=?");
		$load->execute(array($qid));
		if($load->rowCount() == 0)
		{
			$noQuote = 1;
		}
		else
		{
			while($row = $load->fetch())
			{
				$qid = $row['id'];
				$quote = $row['quote'];
				$by = $row['by'];
				//$extra = $row['extra'];
			}
		}
	}

?>

	<div class="head"></div>

	<div class="quote">
		<?php
			if($noQuote == 0)
			{
		?>
			<h1 class="q-body"><?php echo $quote; ?></h1>
			<h2 class="q-by">- <?php echo $by; ?></h2>
			<!-- <h3 class="q-extra"><p><?php echo $extra; ?></p></h3> -->
		<?php
			}
			else
			{
		?>
			<h1 class="no-quote">No Quote Found. Please check the URL.</h1>
		<?php
			}
		?>
	</div>

	<div class="controls">
		<center><a href="/quotastic/?not=<?php echo $qid; ?>" class="random"></a></center>
	</div>

	<?php
		if($noQuote == 0)
		{
	?>
		<div class="share">
		<center>
			<div class="fb-like" data-href="http://www.abhishekbiswal.com/quotastic/?id=<?php echo $qid; ?>" data-send="false" data-width="30" data-show-faces="false" data-font="lucida grande"></div>
			<a href="https://twitter.com/share" data-url="http://www.abhishekbiswal.com/quotastic/?id=<?php echo $qid; ?>" class="twitter-share-button" data-via="Abhishek_Biswal" data-lang="en">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</center>
		</div>
	<?php		
		}
	?>

	<div class="footer">
		<div>By <a href="/">Abhishek Biswal</a></div>
		<div>
			<a href="https://twitter.com/Abhishek_Biswal" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @Abhishek_Biswal</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</div>

	<!-- Start of StatCounter Code for Default Guide -->
	<script type="text/javascript">
	var sc_project=8588436; 
	var sc_invisible=1; 
	var sc_security="742393c9"; 
	var scJsHost = (("https:" == document.location.protocol) ?
	"https://secure." : "http://www.");
	document.write("<sc"+"ript type='text/javascript' src='" +
	scJsHost+
	"statcounter.com/counter/counter.js'></"+"script>");
	</script>
	<noscript><div class="statcounter"><a title="hits counter"
	href="http://statcounter.com/" target="_blank"><img
	class="statcounter"
	src="http://c.statcounter.com/8588436/0/742393c9/1/"
	alt="hits counter"></a></div></noscript>
	<!-- End of StatCounter Code for Default Guide -->

</body>
</html>