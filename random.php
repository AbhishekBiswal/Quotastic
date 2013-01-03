<?php
	header('Content-type: text/html; charset=utf-8');
	include('../db.php');
	@$qid = $_GET['id'];
	if(!$qid)
	{
		$load = $DBH->prepare("SELECT * FROM quotes ORDER BY RAND() LIMIT 1");
		$load->execute(array());
	}
	else
	{
		$load = $DBH->prepare("SELECT * FROM quotes WHERE id=?");
		$load->execute(array($qid));
	}

		if($load->rowCount() == 0)
		{
			echo '<h1 class="no-quote">No Quote Found. Please check the URL.</h1>';
			exit();
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
?>

		<h1 class="q-body"><?php echo $quote; ?></h1>
		<h2 class="q-by">- <?php echo $by; ?></h2>
		<!-- <h3 class="q-extra"><p><?php echo $extra; ?></p></h3> -->