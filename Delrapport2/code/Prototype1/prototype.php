<!DOCTYPE html>
<html>
	<head>
		<title>Prototype1</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div>
		<?php
			mysql_connect('localhost', '90318_1.usr1', 'beetlepower15');
			mysql_select_db('90318_1');
		?>

			<h1> Project: Beetle </h1>
			<div id='cssmenu'>
			<form method="POST">
		<?php		
				echo '<input type="textfield" name="search" value="'.$_POST['search'].'"/>'
		?>		
				<input type="submit" value="Search"/>
			</form>
			<br>
				<ul>
				    <li class='has-sub'><a href="#"><span><p class="title">Advanced search</p></span></a>
				     	<ul>
				     		<form method="POST">
				     			<li><a href="#"><span>Order: <input type="textfield" name="searchOrder"></span></a></li>
				     			<li><a href='#'><span>Family: <input type="textfield" name="searchFamily"></span></a></li>
					         	<li><a href='#'><span>Genus: <input type="textfield" name="searchGenus"></span></a></li>
					         	<li><a href='#'><span>Species: <input type="textfield" name="searchSpecies"></span></a></li>
					         	<li class='last'><input type="submit" align="right" position="absolute"></li>
				         	</form>
				        </ul>
				   </li>
				</ul>
		<?php
			if (isset($_POST['search'])) {
				$getID = mysql_query("SELECT id FROM ProjectBeetle WHERE species ='".$_POST['search']."' OR genus='".$_POST['search']."' OR family='".$_POST['search']."' OR iorder='".$_POST['search']."'");

				if (mysql_num_rows($getID)==0) {
					echo '<br><p id="error"><font color="red"> No Entry </font><p>';
				} else {			
					while ($id = mysql_fetch_assoc($getID)) {
						foreach ($id as $idForeach) {
							$getSpecies = mysql_fetch_assoc(mysql_query("SELECT Species FROM ProjectBeetle WHERE id='".$idForeach."' AND (species ='".$_POST['search']."' OR genus='".$_POST['search']."' OR family='".$_POST['search']."' OR iorder='".$_POST['search']."')"));
							$getGenus = mysql_fetch_assoc(mysql_query("SELECT genus FROM ProjectBeetle WHERE id='".$idForeach."' AND (species ='".$_POST['search']."' OR genus='".$_POST['search']."' OR family='".$_POST['search']."' OR iorder='".$_POST['search']."')"));
							$getFamily = mysql_fetch_assoc(mysql_query("SELECT family FROM ProjectBeetle WHERE id='".$idForeach."' AND (species ='".$_POST['search']."' OR genus='".$_POST['search']."' OR family='".$_POST['search']."' OR iorder='".$_POST['search']."')"));
							$getImg = mysql_fetch_assoc(mysql_query("SELECT img FROM ProjectBeetle WHERE id='".$idForeach."' AND (species ='".$_POST['search']."' OR genus='".$_POST['search']."' OR family='".$_POST['search']."' OR iorder='".$_POST['search']."')"));
							$getOrder = mysql_fetch_assoc(mysql_query("SELECT iorder FROM ProjectBeetle WHERE id='".$idForeach."' AND (species ='".$_POST['search']."' OR genus='".$_POST['search']."' OR family='".$_POST['search']."' OR iorder='".$_POST['search']."')"));

							echo '<br><br><a href="image.php?img='.implode('', $getImg).'"><img id="zoomify" src="'.implode('', $getImg).'" title="'.implode('', $getImg).'" height="120"/></a>';
							echo '<p id="sidebar"><u>Order:</u> '.implode('', $getOrder).'<br><br>';
							echo '<u>Family:</u> '.implode('', $getFamily).'<br><br>';
							echo '<u>Genus:</u> '.implode('', $getGenus).'<br><br>';
							echo '<u>Species:</u> '.implode('', $getSpecies).'<br><br></p>';
						}
					}
				}
			}
		?>
		<br><br><br><a href="login.php">edit</a>
	</div>
	</body>
</html>