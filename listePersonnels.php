<?php
session_start();
include_once('config.php');
verifySession(); 
if(verifyAdmin()==false){
header('Location:accueil.php');
}
$divisions=GetDivision();
$grades=GetGrade();

if(isset($_POST['supprimer'])){
SupprimerPersonnel($_POST['supprimer']);
$message="Utilisateur supprimé !";
}

$reponse=TousPersonnels();

if(isset($_POST['admin'])){
  if ($_POST['admin']!="false") {
$reponse=InfosPersonnelFromAdmin($_POST['admin']);
  }
}

if(isset($_POST['scin'])){
 if(strtoupper(htmlspecialchars(trim($_POST['scin'])))!=""){
$reponse=InfosPersonnel2($_POST['scin']);
 }
}
if(isset($_POST['divisions'])){
  if ($_POST['divisions']!="false") {
$reponse=InfosPersonnelFromDiv($_POST['divisions']);
  }
}

if(isset($_POST['grades'])){
  if ($_POST['grades']!="false") {
$reponse=InfosPersonnelFromGrade($_POST['grades']);
  }
}


?>
<html>
<head>
<title> Liste des personnels </title>
<link href="css/styleListP.css" rel="stylesheet">
</head>
<body>
 <div class="container">
<?php include_once('header.php');
?>

<fieldset><legend><img src="images/pers.png"></legend>

<form method="post" action="listePersonnels.php">
    <label for="scin">CIN : </label>
    <input name="scin" type="txt" id="scin" size="8" >
    <label for="div">Division : </label>
    <select name="divisions" id="div">
         <option value="false"></option>
         <?php while($valueD=$divisions->fetch() ){ 
         echo "<option value=\"".current($valueD)."\"> ".current($valueD)." </option>";
          }$divisions->closeCursor();?> 
    </select>

    <label for="grades">Grade : </label>
    <select name="grades" id="grades">
       <option value="false"></option>
      <?php while($valueG=$grades->fetch() ){ 
      echo "<option value=\"".current($valueG)."\"> ".current($valueG)." </option>";
          } $grades->closeCursor();?> 
    </select>

    <label for="admin">Admin ?</label>
    <select name="admin" id="admin">
        <option value="false"></option>
        <option value="1">Oui</option>
        <option value="0">Non</option>
   </select>
   <input type="submit" value="Chercher" />
</form>
<!-- -->

<?php if(isset($message)){?><p class="confirm"><em> <?php echo $message;}?></em></p>
<?php
echo "
<table border=\"5\" cellspacing=\"1\" style=\"text-align:center\" >
<tr><th >CIN</th><th>Nom</th><th>Prénom</th><th>Grade</th><th>Division</th><th>Tél</th><th>Adresse</th><th>JrsTotal</th><th>JrsRest</th></th><th>Login</th><th>Email</th><th>Admin ? </th><th>Action ... </th> </tr>";
while($donnees=$reponse->fetch())
{
	$admin=$donnees['admin'];
switch ($admin) {
	
		case '0':
			$admin='Non';
			break;
	    case '1':
			$admin='OUI';
			break;		
			default : break;}
//echo " Personnel N° ".$nbr." ) CIN : ".$donnees['cin']." ,Nom : ".$donnees['nom']." ,Prénom : ".$donnees['prenom']." , : ".$donnees['nom']
     $idp=$donnees['cin'];

echo "
<tr><td>".$donnees['cin']."</td><td>".$donnees['nom']."</td><td>".$donnees['prenom']."</td><td>".$donnees['grade']."</td><td>".$donnees['division']."</td><td>".$donnees['tel']."</td><td>".$donnees['adresse']."</td><td>".$donnees['jourstot']."</td><td>".$donnees['joursrest']."</td></td><td>".$donnees['login']."</td><td>".$donnees['email']."</td><td>".$admin."</td>
<td align=\"center\">   
              <form method=\"post\" action=\"modifierPersonnel.php\">
    <input type=\"hidden\"  name=\"modifierPers\"  value=\"$idp\">
    <input type=\"submit\"  value=\"Modifier les Infos\" id=\"ch1\"/> 
    <br>
    </form>
                  <form method=\"post\" action=\"listePersonnels.php\">
    <input type=\"checkbox\" name=\"supprimer\" value=\"$idp\" id=\"ch2\"/> <label for=\"ch2\">Supprimer</label><br>
    <input type=\"submit\" value =\"Confirmer Supr\" > 
    </form>       
      </td>
</tr>	";

}
echo "</table>";
$reponse->closeCursor();?>

</fieldset>

 

<br>
<br>
</div> 
</body>
</html>