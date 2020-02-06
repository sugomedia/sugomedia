<h3>Kategóriák kezelése</h3>
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
			$db->query("SELECT * FROM kategoriak WHERE kategoria='$nev'");
			if ($db->numRows() != 0)
			{
				showError('Hiba! Ez a kategória már regisztrálva van!');
			}
			else
			{
				
				$db->query("INSERT INTO kategoriak VALUES(null, '$nev', 1)");
				header("location: index.php?pg=".$dir);
			}
		}
	}

	echo'
	<form method="POST" action="index.php?pg=kategoriak_felv">
		<div class="form-group">
			<label>Kategória neve:</label><em>*</em>
			<input type="text" name="nev" class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" name="felvesz" value="Rekord felvétele" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához</a>
		</div>	
	</form>';
?>