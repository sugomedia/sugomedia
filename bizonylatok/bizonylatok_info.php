<h3>Bizonylatok kezelése</h3>
<hr>
<?php
	$id = $_GET['id'];
	echo '<h4>Bizonylatszám: '.$id.'</h4>';
	$db->query("SELECT 
		bizonylatszam AS '@Bizonylatszam',
		tetel AS 'Tétel',
		mennyiseg AS 'Menny.',
		menny_egys AS 'Egys.',
		netto_egys AS 'Nettó',
		netto_egys*mennyiseg AS 'N.össz.',
		netto_egys*mennyiseg*afakulcs AS 'Br.össz.'
	FROM bizonylattetelek 
	WHERE bizonylatszam='".$id."'");
	
	$db->toTable('');

	echo '<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához...</a>';
?>

