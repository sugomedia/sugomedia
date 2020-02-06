<h3>Kategóriák kezelése</h3>
<hr>
<?php
	$id = $_GET['id'];

	if (isset($_POST['modosit']))
	{
		$nev = escapeshellcmd($_POST['nev']);
		

		if (empty($nev))
		{
			showError('Hiba! Nem adtál meg minden adatot!');
		}
		else
		{
			$db->query("SELECT * FROM kategoriak WHERE kategoria='$nev' AND ID<>".$id);
			if ($db->numRows() != 0)
			{
				showError('Hiba! Ez a kategória már regisztrálva van!');
			}
			else
			{
				$db->query("UPDATE kategoriak SET 
					kategoria='$nev'
					WHERE ID=".$id);
				header("location: index.php?pg=".$dir);
			}
		}
	}

	$db->query("SELECT * FROM kategoriak WHERE ID=".$id);
	$res = $db->fetchAll();

	echo'
	<form method="POST" action="index.php?pg='.$page.'&id='.$id.'">
		<div class="form-group">
			<label>Kategória neve:</label><em>*</em>
			<input type="text" name="nev" class="form-control" value="'.$res[0]['kategoria'].'">
		</div>	
		<div class="form-group">
			<input type="submit" name="modosit" value="Rekord módosítása" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához</a>
		</div>	
	</form>';
?>