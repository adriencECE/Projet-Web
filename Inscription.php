<?php
session_start();

$vars = array($_SESSION["connecte"], $_SESSION["login"], $_SESSION["MDP"]);
$jsvars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
?>


<html>

<head>
    <title>OMNES Sant&eacute;-Inscription</title>
    <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon" href="https://www.omneseducation.com/app/themes/inseec-group/favicon.ico">
    <script src="script.js">

    </script>
</head>

<body>

    <section class="presentation">
        <div id="wrapper">
            <div id="header">
                <div id="nav">
                    <img src="omnessante.png" class="logo">
                    <div class="header-right">

                        <a href="Accueil.php" data-after="Accueil">Accueil </a>
                        <!--<input type="button" name="Accueil" value="Accueil">
                    </a>-->
                        <a href="ToutParcourir.php" data-after="ToutParcourir">Parcourir </a>
                        <!--<input type="button" name="Parcourir" value="Tout Parcourir">
                    </a>-->
                        <a href="Accueil.php" data-after="Acc" id="btn1">Modif </a>
                        <!--<input type="button" name="Modifier" value="Modifier" id="btn1">
                    </a>-->
                        <a href="Compte.php" data-after="Compte" id="btn2">Compte </a>
                        <!--<input type="button" name="Compte" value="Compte" id="btn2">
                    </a>-->
                        <!--Modification boutons en fonction du compte connecte-->
                        <?php echo "<script type='text/javascript'>testConnexion1Acc($jsvars)</script>";
                        echo "<script type='text/javascript'>testConnexion2Acc($jsvars)</script>" ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inscriptionClient">
        <div id="section">
            <form method="post" action="InscriptionTraitement.php">
                <label>Nom:</label>
                <input type="text" name="Nom" />
                <label>Prenom:</label>
                <input type="text" name="Prenom" />
                <label>Login:</label>
                <input type="text" name="Login" />
                <label>Mot de Passe:</label>
                <input type="text" name="MDP" />
                <label>Mail:</label>
                <input type="text" name="Mail" />
                <label>Tel:</label>
                <input type="number" name="Tel" />
                <label>Adresse:</label>
                <input type="text" name="Adresse" />
                <label>Num&eacute;ro Carte Vitale:</label>
                <input type="number" name="NumCarteVitale" />
                <label>Type de Carte de Paiement:</label><br>
                <input type="radio" name="TypeCarte" value="Visa" />
                <label>Visa</label>
                <input type="radio" name="TypeCarte" value="MasterCard" />
                <label>MasterCard</label>
                <input type="radio" name="TypeCarte" value="American Express" />
                <label>American Express</label>
                <input type="radio" name="TypeCarte" value="Paypal" />
                <label>Paypal</label><br>
                <label>Numero de Carte:</label>
                <input type="number" name="NumeroCarte" /><br>
                <label>Date d'Expiration:</label>
                <input type="text" name="DateExpiration" value="yyyy-mm-dd" onclick="value=''" />
                <label>Code:</label>
                <input type="number" name="CodeCarte" /><br>
                <input type="submit" value="Soumettre" />
            </form>
        </div>
    </section>
    <section class="footerAcceuil">
        <a id="footer"></a>
        <div class="footer container">
            <div id="footer">
                <a>Copyright &copy; 2022, OMNES Sant&eacute;<br></a>
                <a href="mailto:OMNES.sante@gmail.com">OMNES.sante@gmail.com</a>
            </div>
        </div>
    </section>

</body>

</html>