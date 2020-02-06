<h3>Gyártók kezelése</h3>
<hr>
<?php
	$id = $_GET['id'];
	if (isset($_POST['torol']))
	{
		$db->query("DELETE FROM gyartok WHERE ID=".$id);
		$db->query("UPDATE termekek SET gyartoID=0 WHERE gyartoID=".$id);
		header("location:index.php?pg=".$dir);
	}

	$db->query("SELECT 
		nev	AS 'Név:'
	 FROM gyartok 
	WHERE ID=".$id);

	echo 'Biztosan törli az alábbi rekordot?';
	$db->showRekord();
	echo '<form method="POST" action="index.php?pg='.$page.'&id='.$id.'">
		<div class="form-group">
			<input type="submit" name="torol" value="Rekord törlése" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához</a>
		</div>
	</form>';
?>
