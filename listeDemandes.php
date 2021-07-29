<?php
session_start();?>
<html>
<head>
	<title>Liste des demandes</title>
	<link href="css/styleLD.css" rel="stylesheet">


</head>
<body>
<div class="container">

<?php
include_once('config.php');

verifySession(); 
if(verifyAdmin()==false){
header('Location:MesDemandes.php');
}
if(isset($_POST['accepter'])){
EtatDemande($_POST['accepter'],1);
$cin1=CinFromID($_POST['accepter']);
$emailPer=InfosPersonnel($cin1);
$subject="Etat de la demande de congé ";
$message="Votre demande est acceptée \n Consulter : http://localhost:1234/Myapp/MesDemandes.php  ";

}   
if(isset($_POST['refuser'])){
EtatDemande($_POST['refuser'],-1);
$cin1=CinFromID($_POST['refuser']);
$emailPer=InfosPersonnel($cin1);
$subject="Etat de la demande de congé ";
$message="Votre demande est refusée \n Consulter : http://localhost:1234/Myapp/MesDemandes.php  ";

}
if(isset($_POST['pasEncore'])){
EtatDemande($_POST['pasEncore'],0);
$cin1=CinFromID($_POST['pasEncore']);
$emailPer=InfosPersonnel($cin1);
$subject="Etat de la demande de congé ";
$message="Votre demande est en cours de traitement \n Consulter : http://localhost:1234/Myapp/MesDemandes.php  ";

}
if(isset($_GET['all'])){
$reponse=LesDemandes();
}

if(isset($_GET['enAttente'])){
$reponse=DemandesEnAttente();
}

elseif(isset($_GET['acceptee'])){
$reponse=DemandesAcceptee();
}

elseif(isset($_GET['refusee'])){
$reponse=DemandesRefusee();
}
else{
$reponse=LesDemandes();
}
include_once('header.php');
?>
<br>
<br>
<div class="choix">
<form action="listeDemandes.php" method="get">
	<input type="hidden" name="all" value="1"> 
    <input type="submit" value ="Toutes les demandes" > 
</form>
<form action="listeDemandes.php" method="get">
	<input type="hidden" name="enAttente" value="1"> 
    <input type="submit" value ="Demandes En attente" > 
</form>
<form action="listeDemandes.php" method="get">
	<input type="hidden" name="acceptee" value="1"> 
    <input type="submit" value ="Demandes Acceptées" > 
</form>
<form action="listeDemandes.php" method="get">
	<input type="hidden" name="refusee" value="1"> 
    <input type="submit" value ="Demandes Refusées" > 
</form>

</div>
<fieldset><legend><img src="images/tt2.png"></legend>
<table border="2" style="text-align:center">
<tr><th>Personnel</th><th>ID demande</th><th>Date demande</th><th>Date départ</th><th>Date retour</th><th>Nbr jours </th><th class="etat">Etat</th></tr>

<?php
while($donnees=$reponse->fetch())
{
	$infos=InfosPersonnel($donnees['CIN']);
	$choixE=true;$choixA=true;$choixR=true;
	$Etat=$donnees['Etat'];
switch ($Etat) {
	
		case '-1':
			$Etat='Refusée';$choixR=false;break;
	    case '0':
			$Etat='En cours de traitement';$choixE=false;
			break;		
		case '1':
			$Etat='Acceptée';$choixA=false;
			break;
			default : break;

	}

$days=dateDiff($donnees['DateRetour'],$donnees['DateDepart'])+1;

	echo "<tr><td>".$infos['nom']." ".$infos['prenom']."</td><td>".$donnees['ID']."</td><td>".$donnees['DateDemande']."</td><td>".$donnees['DateDepart']."</td><td>".$donnees['DateRetour']."</td><td>".$days."</td><td>".$Etat."<br>";
    $id=$donnees['ID'];

$path=$_SERVER['REQUEST_URI'];
$query=parse_url($path, PHP_URL_QUERY);
$path="";
switch ($query) {
		case 'enAttente=1':
$path="enAttente=1";
			break;
	    case 'acceptee=1':
$path="acceptee=1";
			break;		
		case 'refusee=1':
$path="refusee=1";
			break;
		case 'all=1':
$path="all=1";
			break;
	
}
$lien="listeDemandes.php?".$path;
    echo "
        
              <form method=\"post\" action=\"$lien\">";
                  if($choixE){echo "<input type=\"checkbox\" name=\"pasEncore\" value=\"$id\" id=\"ch3\"/> <label for=\"ch3\">En cour  de traitement </label>";}

              if($choixA){ echo "<input type=\"checkbox\" name=\"accepter\" value=\"$id\" id=\"ch1\"/> <label for=\"ch1\">Accepter</label> ";}

    if($choixR){echo "<input type=\"checkbox\" name=\"refuser\" value=\"$id\" id=\"ch2\"/> <label for=\"ch2\">Refuser</label>";}
    echo "<input type=\"submit\" value =\"Confirmer\" > 
    </form>       
     ";
}
echo "</td></th></table>";	
?>
</fieldset>

<br>
<br>
</div>
</body>
</html>
<?php $reponse->closeCursor();?>



