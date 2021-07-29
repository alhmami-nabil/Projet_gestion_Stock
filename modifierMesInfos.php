<?php session_start();
include_once('config.php');
verifySession();
if (isset($_POST['newValue'])) {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=projet_fil_rouge', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    if (isset($_POST['pass']) & isset($_POST['pass2']) & isset($_POST['login']) & isset($_POST['tel']) & isset($_POST['adresse']) & isset($_POST['email'])) {
        if ($_POST['pass'] == $_POST['pass2']) {
            $pass_hache = crypt($_POST['pass'], "x5ncisx5");
            $req = $bdd->prepare('UPDATE  personnel set tel=:ptel,adresse=:padresse,login=:plogin,pass=:ppass,email=:pemail WHERE cin=\'' . $_SESSION['cin'] . '\'');
            $req->execute(array(
                ':ptel' => htmlspecialchars($_POST['tel']),
                ':padresse' => ucfirst(strtolower(htmlspecialchars(trim($_POST['adresse'])))),
                ':plogin' => htmlspecialchars(trim($_POST['login'])),
                ':ppass' => $pass_hache,
                ':pemail' => htmlspecialchars(trim($_POST['email']))
            ));
            $message = "Modification réussie !";
        } else {
            echo " <script language=\"JavaScript\"> alert(\"les Mots de passe ne sont pas identiques ...\") </script>";
        }
    } else {
        echo " <script language=\"JavaScript\"> alert(\"Veuillez remplir tous les champs ...\") </script>";
    }
}
if (isset($_SESSION['cin'])) {
    $reponse = InfosPersonnel($_SESSION['cin']);
}


?>
<html>
<html>

<head>
    <title> Modifier mes infos </title>
    <link href="css/styleMOinfo.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <?php include_once('header.php'); ?>
        <form method="post" action="modifierMesInfos.php">
            <fieldset>
                <legend><img src="images/pers.png"></legend>
                <?php if (isset($message)) { ?><p class="confirm"><em> <?php echo $message;
                                                                } ?></em></p>

                    <table border="0" cellspacing="5">

                        <tr>
                            <td><label>Login :</label></td>
                            <td><input type="text" name="login" size="30" required value="<?php echo $reponse['login']; ?>" /></td>
                        </tr>
                        <tr>
                            <td> <label>Mot de passe :</label></td>
                            <td><input type="password" name="pass" size="30" required /></td>
                        </tr>
                        <tr>
                            <td> <label>Confirmer votre Mot de passe :</label></td>
                            <td><input type="password" name="pass2" required size="30" /></td>
                        </tr>
                        <tr>
                            <td> <label>Tél :</label></td>
                            <td><input type="tel" name="tel" size="30" required value="<?php echo $reponse['tel']; ?>" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" /></td>
                        </tr>
                        <tr>
                            <td> <label>Adresse :</label></td>
                            <td><input type="text" name="adresse" size="30" required value="<?php echo $reponse['adresse']; ?>" /></td>
                        </tr>
                        <tr>
                            <td> <label>Email</label></td>
                            <td><input type="email" name="email" size="30" required value="<?php echo $reponse['email']; ?>" /></td>
                        </tr>
                        <input type="hidden" name="newValue" value="1">
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>

                        <tr class="submit">
                            <td colspan="2"><input type="submit" Value="Valider les Modifications" />
                        </tr>
                        </td>

                    </table>
        </form>
        </fieldset>
        <br>
    </div>
</body>

</html>