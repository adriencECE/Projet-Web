<?php session_start();
$vars = array($_SESSION["connecte"], $_SESSION["login"], $_SESSION["MDP"]);
$jsvars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
 ?>
<html>
<head>
    <title>OMNES Sant&eacute;-Paiement</title>
    <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon"
        href="https://www.omneseducation.com/app/themes/inseec-group/favicon.ico">
        <script src="script.js">  
        </script>
</head>

<body>
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
        <div id="section">
            <form method="post" action="TraitementPaiement.php">
                <label>Type de Carte:</label>
                <input type="radio" name="TypeCarte" value="Visa" checked>
                <label>Visa</label>
                <input type="radio" name="TypeCarte" value="MasterCard">
                <label>MasterCard</label>
                <input type="radio" name="TypeCarte" value="American Express">
                <label>American Express</label>
                <input type="radio" name="TypeCarte" value="Paypal">
                <label>Paypal</label><br>
                <label>Num&eacute;ro de Carte:</label>
                <input type="text" name="NumeroCarte"><br>
                <label>Nom:</label>
                <input type="text" name="Nom"><br>
                <label>Prenom:</label>
                <input type="text" name="Prenom"><br>
                <label>Date d'Expiration:</label>
                <input type="text" name="DateExpiration" value="yyyy-mm-dd" onclick="value=''"><br>
                <label>Code:</label>
                <input type="number" name="CodeCarte"><br>
                <input type="submit" value="Soumettre">
            </form>
        </div>
        <div id="footer">Copyright &copy; 2022, OMNES Sant&eacute;<br>
            <a href="mailto:OMNES.sante@gmail.com">OMNES.sante@gmail.com</a>
        </div>
    </div>
</body>

</html>