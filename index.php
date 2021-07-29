<?php
session_start();
?>
<html>

<head>
	<title> Accueil </title>
	<link href="css/styleindex.css" rel="stylesheet">
</head>

<body>
	<div class="container">
		<?php include_once('header.php'); ?>
		<?php
		if (isset($_SESSION['cin']) & isset($_SESSION['login'])) {
			$infos = InfosPersonnel($_SESSION['cin']);
			echo "
<fieldset><legend><img src=\"images/dd3.png\"></legend>
<table border=\"5\" cellspacing=\"2\" style=\"text-align:left\" >
<caption> Mes Coordonnées  </caption>
<tr><th>CIN</th><td>" . $_SESSION['cin'] . "</td></tr>
<tr><th>Nom</th><td>" . $_SESSION['nom'] . "</td></tr>
<tr><th>Prénom</th><td>" . $infos['prenom'] . "</td></tr>
<tr><th>Login</th><td>" . $infos['login'] . "</td></tr>
<tr><th>Grade</th><td>" . $infos['grade'] . "</td></tr>
<tr><th>Division</th><td>" . $infos['division'] . "</td></tr>
<tr><th>Tél</th><td>" . $infos['tel'] . "</td></tr>
<tr><th>Adresse</th><td>" . $infos['adresse'] . "</td></tr>
<tr><th>Email</th><td>" . $infos['email'] . "</td></tr>
<tr><th>JrsTotal</th><td>" . $infos['jourstot'] . "</td></tr>
<tr><th>JrsRestants </th><td>" . $infos['joursrest'] . "</td></tr>
</table>
<form action=\"modifierMesInfos.php\" method=\"post\">
<br>
    <input type=\"submit\" value=\"Modifier les infos \" > 
</form>
</fieldset>
</body>
";
		} else {
			header('Location: Connection.php');
		}

		?><br>
	</div>
</body>

</html>