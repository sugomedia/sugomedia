<h3>Árukészlet kezelése</h3>
<hr>
<?php
	echo '<a href="index.php?pg=termekek_felv" class="btn btn-primary">Új rekord</a>
		  <a href="index.php?pg=termekek_compmarket_xml_import" class="btn btn-primary">Compmarket XML import</a>
		  <a href="index.php?pg=termekek_fotocopy_xml_import" class="btn btn-primary">Fotocopy XML import</a>
		  <a href="index.php?pg=kategoriak" class="btn btn-primary">Kategóriák</a>
		  <a href="index.php?pg=gyartok" class="btn btn-primary">Gyártók</a>
		  <br><br>
		 
		  <form method="POST" action="index.php?pg='.$page.'">
		  <div class="form-group col-xs-6">
		  <label>Kategóriak:</label>'; 

		  $db->query("SELECT * FROM kategoriak ORDER BY kategoria");
		  $db->toSelect('ID', 'kategoria', 'onchange:submit');
		  echo '</div>
		  <div class="form-group col-xs-6">
		  <label>Gyátók:</label>';
	  	  $db->query("SELECT * FROM gyartok ORDER BY nev");
		  $db->toSelect('ID', 'nev', 'onchange:submit');
		  echo '</div></form>';
		
		$felt = '';
	  	if (isset($_POST['kategoriak']))
	  	{
		  	if (!empty($_POST['kategoriak']))
		  	{
		  	 	$felt = ' WHERE termekek.katID='.$_POST['kategoriak'];
		  	}	  	
		}
	  	if (isset($_POST['gyartok']))
	  	{
		  	if (!empty($_POST['gyartok']))
		  	{
		  		if (empty($felt))
		  		{
					$felt = ' WHERE termekek.gyartoID='.$_POST['gyartok'];
		  		}
		  		else
		  		{
		  			$felt .= ' AND termekek.gyartoID='.$_POST['gyartok'];
		  		}
		  	}	  	
		}		
	$db->query("SELECT 
			termekek.ID AS '@ID',
			termekek.katID AS '@katID',
			kategoriak.kategoria AS 'Kategória',
			termekek.nev AS 'Terméknév',
			termekek.garido AS 'Garancia',
			termekek.menny AS 'Menny.',
			termekek.ar AS 'Besz.nettó'
		FROM termekek
	 	INNER JOIN kategoriak ON kategoriak.ID = termekek.katID ".$felt);

	$db->toTable("i|u|d");
?>