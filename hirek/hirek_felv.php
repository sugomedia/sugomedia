<h3>Hírek kezelése</h3>
<hr>
<?php
	if (isset($_POST['felvesz']))
	{
		$cim = escapeshellcmd($_POST['cim']);
		$leiras	=escapeshellcmd($_POST['leiras']);
		if (empty($cim) || empty($leiras))
		{
			showError("Nem adtál meg minden adatot!");
		}
		else
		{
			$uid = $_SESSION['uid'];
			$db->query("INSERT INTO hirek VALUES(null,CURRENT_TIMESTAMP, '$cim','$leiras', $uid)");
			header("location: index.php?pg=".$dir);
		}
	}

	echo '<form method="POST" action="index.php?pg='.$page.'">
		<div class="form-group">
			<label>Cím:</label>
			<input type="text" name="cim" class="form-control">
		</div>
		<div class="form-group">
			<label>Leírás:</label>
			<textarea name="leiras" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<input type="submit" name="felvesz" value="Rekord felvétele" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához</a>
		</div>
	</form>';
?>