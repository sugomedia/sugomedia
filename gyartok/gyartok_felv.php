<h3>Gyártók kezelése</h3>
<hr>
<?php
	if (isset($_POST['felvesz']))
	{
		$nev = escapeshellcmd($_POST['nev']);
	
		if (empty($nev))
		{
			showError('Hiba! Nem adtál meg minden adatot!');
		}
		else
		{
			$db->query("SELECT * FROM gyartok WHERE nev='$nev'");
			if ($db->numRows() != 0)
			{
				showError('Hiba! Ez a gyártó már regisztrálva van!');
			}
			else
			{
				
				$db->query("INSERT INTO gyartok VALUES(null, '$nev')");
				header("location: index.php?pg=".$dir);
			}
		}
	}

	echo'
	<form method="POST" action="index.php?pg=gyartok_felv">
		<div class="form-group">
			<label>Gyártó neve:</label><em>*</em>
			<input type="text" name="nev" class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" name="felvesz" value="Rekord felvétele" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához</a>
		</div>	
	</form>';
?>