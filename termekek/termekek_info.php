<h3>Árukészlet kezelése</h3>
<hr>
<?php
	$id = $_GET['id'];

	$db->query("SELECT 
		termekek.ID AS 'Cikkszám:',
		termekek.gy_cikkszam AS 'Gyártói cikkszám:',
		kategoriak.kategoria AS 'Kategória:',
		gyartok.nev AS 'Gyártó:',
		termekek.nev AS 'Terméknév:',
		termekek.tipus AS 'Típus:',
		termekek.leiras1 AS 'Rövid leírás:',
		termekek.leiras2 AS 'Bővebb leírás:',
		termekek.link AS 'Link:',
		termekek.ar AS 'Nettó beszerzési ár:',
		termekek.garido AS 'Garanciaidő:',
		termekek.keszlet AS 'Készletinformáció:',
		termekek.menny AS 'Mennyiség:',
		termekek.minmenny AS 'Minimális mennyiség:',
		termekek.vkod AS 'Vonalkód:',
		termekek.suly AS 'Súly:',
		termekek.beerkezes AS 'Utolsó beérkezés dátuma:',
		termekek.vtsz AS 'VTSZ:',
		termekek.specifikacio AS 'Specifikáció'
	 FROM termekek 
	 INNER JOIN kategoriak ON kategoriak.ID = termekek.katID
	 INNER JOIN gyartok ON gyartok.ID = termekek.gyartoID
	WHERE termekek.ID=".$id);
	
	$db->showRekord();

	$db->query("SELECT szeriaszam AS 'Szériaszámok', bev_biz_szam AS 'Bevételi bizonylat száma' FROM szeriaszamok WHERE cikkszam=".$id);
	if ($db->numRows()>0)
	{
		$db->toTable('');
	}
	
	include('argrafikon.php');
	
	echo '<br><a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához...</a>';
?>

