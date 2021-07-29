<header>
	<div class="header">

		<div class="heade">
			<img src="images/logo/pg111.png" style="width:90%;">
			<link href="css/styleHeader.css" rel="stylesheet">
		</div>


		<br>
		<nav>
			<a href="index.php"><button style=" border:none; background-color: cornflowerblue; width:85px; background-image: url('images/dd0.png');">Accueil</button></a>
			<a href="demander.php"><button style="  border:none;width: 170px;background-color: cornflowerblue; background-image: url('images/dd.png');"> Demander un congé</button></a>
			<a href="MesDemandes.php"><button style=" border:none;width: 140px;background-color: cornflowerblue; background-image: url('images/dd2.png');"> Mes demandes</button></a>

			<?php
			include_once('config.php');
			if (verifyAdmin() == true) {
			?>
				<a href="listeDemandes.php"><button style=" border:none;background-color: cornflowerblue;	background-image: url('images/dd6.png');"> Liste des demandes </button></a>
				<a href="listePersonnels.php"><button style=" border:none;background-color: cornflowerblue;	background-image: url('images/dd4.png');"> Liste des personnels</button></a>
				<a href="Inscription.php"><button style=" border:none;background-color: cornflowerblue; background-image: url('images/dd5.png');"> Ajouter un personnel </button></a>

			<?php
			}
			echo "
              <a href=\"deconnexion.php\"><button style=\"width:40px;background-color: cornflowerblue; border:none; background-image: url('images/deconect.png');\">.</button></a>";
			?>
		</nav>

		<?php
		if (verifyAdmin() == true) {
			$val = notifications();
			echo " <div class=\"notifdiv\"> <img src=\"images/notif.png\"/><p>Bonjour <i><b>" . $_SESSION['nom'] . " " . $_SESSION['prenom'] . "</i></b> , Vous avez <span><b>" . $val . " </span></b><a class=\"notif\" href=\"listeDemandes.php?enAttente=1\">  Demande(s) en attente</a></p></div>";
		}
		?>

		
	</div>
</header>