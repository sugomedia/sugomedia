<?php
	$id = $_GET['id'];
	if ($id != $_SESSION['uid'])
	{
		$db->query("UPDATE felhasznalok SET status = not status WHERE ID=".$id);
	}
	header("location: index.php?pg=".$dir);
?>