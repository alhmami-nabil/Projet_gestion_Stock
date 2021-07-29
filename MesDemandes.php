<?php
session_start();
?>
<html>
<head>
<title> Mes Demandes</title>
<link href="css/styleMedemande.css" rel="stylesheet">


</head>
<body>
<div class="container">	
<?php
include_once('header.php');
include_once('config.php');
verifySession(); 
if(isset($_POST['supprimer'])){
SupprimerDemande($_POST['supprimer']);
}
$reponse=MesDemandes($_SESSION['cin']);
?>
<fieldset><legend><img src="images/demande.png"></legend>
<table border="2" style="text-align:center">
<tr><th>ID demande</th><th>Date demande</th><th>Date départ</th><th>Date retour</th><th>Nbr jours </th><th>Etat</th></tr>
<?php
while($donnees=$reponse->fetch())
{
	$Etat=$donnees['Etat'];
switch ($Etat) {
	
		case '-1':
			$Etat='Refusée';
			break;
	    case '0':
			$Etat='En cours de traitement';
			break;		
		case '1':
			$Etat='Acceptée';
			break;
			default : break;
	}
?>

<?php
$days=dateDiff($donnees['DateRetour'],$donnees['DateDepart'])+1;
	echo "<tr><td>".$donnees['ID']."</td><td>".$donnees['DateDemande']."</td><td>".$donnees['DateDepart']."</td><td>".$donnees['DateRetour']."</td><td>".$days."</td><td>".$Etat;
    $id=$donnees['ID'];
    if($Etat=="En cours de traitement"){
    
    echo "
        
              <form method=\"post\" action=\"MesDemandes.php\">
    <input type=\"checkbox\" name=\"supprimer\" value=\"$id\" id=\"ch4\"/> <label for=\"ch4\">Annuler la demande</label><br>
    <input type=\"submit\" value =\"Confirmer\" > 
    </form>       
        
</td></tr>";

}

echo "<br>";	
}
?>
</table>
<br>
</fieldset>
<?php
$reponse->closeCursor();
?>
<br>
</div>
</boyd>
</html>