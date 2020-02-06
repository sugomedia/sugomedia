<h3>Áktuális híreink</h3>
<hr>
<?php
	if (isset($_SESSION['uid']))
	{
		echo '<a href="index.php?pg=hirek_felv" class="btn btn-primary">Új rekord</a>';
	}
	$db->query("SELECT * FROM hirek ORDER BY datum DESC");
	foreach ($db->queryresult as $value) 
	{
		echo '<h4><strong>'.$value['cim'].'</strong></h4>
		<p>'.nl2br($value['hir']).'</p>
		<h5>'.$value['datum'].'</h5>
		<hr>';
	}
?>

