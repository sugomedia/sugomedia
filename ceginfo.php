<h3>Céginformáció</h3>
<hr>
<?php 
	if (isset($_SESSION['uid']))
	{
		echo '<a href="index.php?pg=cegadatok" class="btn btn-primary">Módosítás</a>';
	}
	$db->query("SELECT 
		cegnev AS 'Cégnév:',
		rovidnev AS 'Rövidített név:',
		szekhely AS 'Székhely:',
		email AS 'E-mail cím:',
		tel AS 'Telefonszám:',
		adoszam AS 'Adószám:',
		eu_adoszam AS 'Közösségi adószám:',
		bankszla AS 'Bankszámlaszám:',
		cegjegyzekszam AS 'Cégjegyzékszám:'
	FROM cegadatok WHERE ID=1");
	$db->showRekord();
?>

