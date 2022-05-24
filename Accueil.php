<?php
session_start();
//Initialisation si les variables de la session n'existent pas
//Uniquement lors de la premiere ouverture de Accueil.php
if (!isset($_SESSION["connecte"])) {
    $_SESSION["connecte"] = "false";
}
if (!isset($_SESSION["login"])) {
    $_SESSION["login"] = "";
}
if (!isset($_SESSION["MDP"])) {
    $_SESSION["MDP"] = "";
}
if (isset($_POST["DeconnexionBtn"])) {
    $_SESSION["connecte"] = "false";
    $_SESSION["login"] = "";
    $_SESSION["MDP"] = "";
}
//Affichage Session pour test
//echo $_SESSION["connecte"]." ".$_SESSION["login"]." ".$_SESSION["MDP"];

$vars = array($_SESSION["connecte"], $_SESSION["login"], $_SESSION["MDP"]);
$jsvars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
//echo "<script>alert($jsvars)</script>";
?>


<html>

<head>
    <title>OMNES Sant&eacute;-Accueil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon" href="https://www.omneseducation.com/app/themes/inseec-group/favicon.ico">
    <script type="text/javascript" src="script.js"></script>
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
            Bienvenue sur OMNES Sant&eacute; <?php echo $_SESSION["login"] ?><br>
            Actualit&eacute;s <br>
            Ev&eacute;nements <br>
        </div>
        <div id="footer">Copyright &copy; 2022, OMNES Sant&eacute;<br>
            <a href="mailto:OMNES.sante@gmail.com">OMNES.sante@gmail.com</a>
        </div>
    </div>
</body>

</html>