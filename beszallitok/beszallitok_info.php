<h3>Beszállítók kezelése</h3>
<hr>
<?php
	$id = $_GET['id'];

	$db->query("SELECT 
		ID AS 'Azonosító:',
		nev	AS 'Név:',
		cim AS 'Cím:',
		kapcsolattarto AS 'Kapcsolattartó:',
		email AS 'E-mail cím:',
		tel AS 'Telefonszám:',
		ado AS 'Adószám:',
		bank AS 'Bankszámlaszám:',
		megjegyzes AS 'Megjegyzés:'
	 FROM beszallitok 
	WHERE ID=".$id);
	
	$db->showRekord();

	echo '<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához...</a>';
?>

