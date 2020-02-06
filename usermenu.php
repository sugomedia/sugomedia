<?php
	echo '
	<div>
		<ul class="menu">
			<li>
				<a href="index.php?pg=termekek">
					<span class="glyphicon glyphicon-option-vertical"></span>
					Árukészlet
					<span class="badge catbadge">';
					$db->query("SELECT ID FROM termekek");
					echo $db->numRows();
					echo '</span>
				</a>
			</li>
			<li>
				<a href="index.php?pg=bizonylatok">
					<span class="glyphicon glyphicon-option-vertical"></span>
					Bizonylatok
					<span class="badge catbadge">';
					$db->query("SELECT ID FROM bizonylatok");
					echo $db->numRows();
					echo '</span>
				</a>
			</li>
			<li><a href="index.php">
				<span class="glyphicon glyphicon-option-vertical"></span>
				Árajánlatok</a>
			</li>
			<li><a href="index.php">
				<span class="glyphicon glyphicon-option-vertical"></span>
				Foglalások</a>
			</li>
			<li><a href="index.php">
				<span class="glyphicon glyphicon-option-vertical"></span>
				Munkalapok</a>
			</li>
			<li><a href="index.php">
				<span class="glyphicon glyphicon-option-vertical"></span>
				Garancia</a>
			</li>
			<li><a href="index.php?pg=vasarlok">
				<span class="glyphicon glyphicon-option-vertical"></span>
				Vásárlók
				<span class="badge catbadge">';
					$db->query("SELECT ID FROM vasarlok");
					echo $db->numRows();
					echo '</span>
				</a>
			</li>
			<li>
				<a href="index.php?pg=beszallitok">
					<span class="glyphicon glyphicon-option-vertical"></span>
					Beszállítók
					<span class="badge catbadge">';
					$db->query("SELECT ID FROM beszallitok");
					echo $db->numRows();
					echo '</span>
				</a>
			</li>
			<li>
				<a href="index.php?pg=felhasznalok">
					<span class="glyphicon glyphicon-option-vertical"></span>
					Felhasználók
					<span class="badge catbadge">';
					$db->query("SELECT ID FROM felhasznalok");
					echo $db->numRows();
					echo '</span>
				</a>
			</li>
			<li>
				<a href="index.php?pg=cegadatok">
					<span class="glyphicon glyphicon-option-vertical"></span>
					Cégadatok
				</a>
			</li>
			<li><a href="index.php">
				<span class="glyphicon glyphicon-option-vertical"></span>
				Statisztika</a>
			</li>
		</ul>
	</div>';
?>