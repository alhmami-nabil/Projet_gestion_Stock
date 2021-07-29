<?php
session_start();
include_once('config.php');
verifySession(); 
$message=false;
if (isset($_POST['datedepart']) & isset($_POST['dateretour']))
{
$message=demander($_SESSION['cin'],$_POST['dateretour'],$_POST['datedepart']);
}

?>

<html>
<head>
	<title> Demander un congé</title>
    <link href="css/styleDemande.css" rel="stylesheet">
</head>	
<body>
	<div class="container">

<?php include_once('header.php');?>

<fieldset><legend><img src="images/demande.png"></legend>
<form method="post" action="demander.php">
	<p class="confirm"><em> <?php echo $message;?></em></p>
<label>Date Départ: </label> <input type="date" name="datedepart" required>
<label style="margin-left:1em;">Date Retour : </label><input type="date" name="dateretour" required><br><br>
<input type="submit" value="Envoyer la demande" > 
</form>
</fieldset>
<br>
</div>
</body>
</html>

