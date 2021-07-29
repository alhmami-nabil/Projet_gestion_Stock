<?php
if (isset($_POST['pass']) & isset($_POST['login'])) {
	$pass_hache = crypt($_POST['pass'], "x5ncisx5");
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=projet_fil_rouge', 'root', '');
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	$req = $bdd->prepare('SELECT cin ,nom,prenom,admin FROM personnel WHERE login = :login AND pass = :pass');
	$req->execute(array(':login' => $_POST['login'], ':pass' => $pass_hache));
	$resultat = $req->fetch();
	if (!$resultat) {
?>
		<html>

		<head>
		</head>

		<body>
			<fieldset>
				<legend><img src="images/lock3.png"></legend>
				<h3>Login ou mot de passe incorrecte ! </h3>
				<a href="Connection.php">Réessayer ... </a>
			</fieldset>
		</body>

		</html>
<?php
		exit();
	} else {
		session_start();
		$_SESSION['cin'] = $resultat['cin'];
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['nom'] = $resultat['nom'];
		$_SESSION['prenom'] = $resultat['prenom'];
		$_SESSION['admin'] = $resultat['admin'];
		header('Location: index.php');
	}
}
?>
<html>

<head>
	<title> Identifiez-vous</title>
	<link href="css/styleconection.css" rel="stylesheet">
</head>

<body>
	<div class="container">
		<div class="header">
			<img src="images/logo/pg111.png" style="width:100%;">
		</div>
		<hr>
		<fieldset>
			<legend><img src="images/lock3.png"></legend>
			<form method="post" action="Connection.php">
				<input type="text" name="login" placeholder="Nom d'utilisateur" required /><br><br>
				<input type="password" name="pass" placeholder="Mot de passe " required /><br><br>
				<input type="submit" Value="Connexion" />
			</form>
		</fieldset>
		<?php include_once("footer.html"); ?>
		<br>
	</div>

</body>

</html>