<?php
session_start();
require('config.php');
verifySession();
if (verifyAdmin() == false) {
    header('Location:accueil.php');
}

?>
<html>

<head>
    <title> Ajouter un personnel</title>
    <link href="css/styleinscription.css" rel="stylesheet">



</head>


<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet_fil_rouge', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<?php
if (isset($_POST['pass']) & isset($_POST['cin']) &  isset($_POST['nom']) & isset($_POST['pass2'])  & isset($_POST['prenom']) & isset($_POST['grade']) & isset($_POST['division']) & isset($_POST['login']) & isset($_POST['tel']) & isset($_POST['adresse']) & isset($_POST['email']) & isset($_POST['jtot']) & isset($_POST['jrest']) & isset($_POST['admin'])) {
    if ($_POST['pass'] == $_POST['pass2']) {
        $pass_hache = crypt($_POST['pass'], "x5ncisx5");

        $req = $bdd->prepare('INSERT INTO personnel(cin,nom,prenom,grade,division,tel,adresse,jourstot,joursrest,login,pass,admin,email) VALUES(:cin,:nom,:prenom,:grade,:division,:tel,:adresse,:jourstot,:joursrest,:login,:pass,:admin,:email)');
        $req->execute(array(
            ':cin' => strtoupper(htmlspecialchars(trim($_POST['cin']))), ':nom' => ucfirst(strtolower(htmlspecialchars(trim($_POST['nom'])))), ':prenom' => htmlspecialchars($_POST['prenom']),
            ':grade' => ucfirst(strtolower(htmlspecialchars(trim($_POST['grade'])))),
            ':division' => ucfirst(strtolower(htmlspecialchars(trim($_POST['division'])))),
            ':tel' => htmlspecialchars($_POST['tel']),
            ':adresse' => ucfirst(strtolower(htmlspecialchars(trim($_POST['adresse'])))),
            ':jourstot' => htmlspecialchars($_POST['jtot']),
            ':joursrest' => htmlspecialchars($_POST['jrest']),
            ':login' => htmlspecialchars($_POST['login']),
            ':pass' => $pass_hache,
            ':admin' => $_POST['admin'],
            ':email' => $_POST['email']
        ));
        $message = " Le personnel a bien été ajouté !";
    } else {
        $message = " les Mots de passe ne sont pas identiques ...";
    }
}

?>

<body>
    <div class="container">
        <?php include_once('header.php'); ?>
        <fieldset>
            <legend><img src="images/pers.png"></legend>
            <?php if (isset($message)) { ?><p class="confirm"><em> <?php echo $message;
                                                            } ?></em></p>
                <form method="post" action="Inscription.php">
                    <table border="0" cellspacing="5">

                        <tr>
                            <td><label>Nom : </label></td>
                            <td><input type="text" name="nom" required size="30" /></td>
                        </tr>
                        <tr>
                            <td><label>Prénom :</label>
                            <td><input type="text" name="prenom" required size="30" /></td>
                        </tr>
                        <tr>
                            <td> <label>CIN :</label></td>
                            <td><input type="text" name="cin" size="30" required /></td>
                        </tr>
                        <tr>
                            <td> <label>Grade :</label></td>
                            <td><input type="text" name="grade" size="30" required /></td>
                        </tr>
                        <tr>
                            <td> <label>Division :</label></td>
                            <td><input type="text" name="division" size="30" required /></td>
                        </tr>
                        <tr>
                            <td> <label>Login :</label></td>
                            <td><input type="text" name="login" size="30" required /></td>
                        </tr>
                        <tr>
                            <td> <label>Mot de passe :</label></td>
                            <td><input type="password" name="pass2" required size="30" /></td>
                        </tr>
                        <tr>
                            <td> <label>Confirmer votre mot de passe :</label></td>
                            <td><input type="password" required name="pass" size="30" /></td>
                        </tr>
                        <tr>
                            <td> <label>Tél :</label></td>
                            <td><input type="tel" name="tel" required size="30" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" /></td>
                        </tr>
                        <tr>
                            <td> <label>Adresse :</label></td>
                            <td><input type="text" required name="adresse" size="30" /></td>
                        </tr>
                        <tr>
                            <td> <label>Email</label></td>
                            <td><input type="email" name="email" required size="30" /><br>
                        <tr>
                            <td> <label>Nbr Jours Total</label></td>
                            <td><input type="number" name="jtot" required size="30" min="0" max="30" /></td>
                        </tr>
                        <tr>
                            <td> <label>Nbr Jours Restant</label></td>
                            <td><input type="number" name="jrest" size="30" required min="0" max="30" /></td>
                        </tr>
                        <tr>
                            <td><label> Admin ? </label>
                            </td>
                            <td><input type="radio" name="admin" value="1" id="ch1" required /> <label for="ch1">Oui</label>
                                <input type="radio" name="admin" value="0" id="ch2" required /> <label for="ch2">Non</label>
                        </tr>
                        </td>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>

                        <tr class="submit">
                            <td colspan="2"><input type="submit" Value="Ajouter le personnel" />
                        </tr>
                        </td>
                    </table>
                </form>
        </fieldset>
        <br>
    </div>
</body>

</html>