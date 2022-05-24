<?php session_start();
$vars = array($_SESSION["connecte"], $_SESSION["login"], $_SESSION["MDP"]);
$jsvars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
?>

<html>

<head>
    <title>OMNES Sant&eacute;-Rendez-Vous</title>
    <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon"
        href="https://www.omneseducation.com/app/themes/inseec-group/favicon.ico">
        <script src="script.js">  
        </script>
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <div id="logo">
                <img src="omnessante.png"
                    class="custom-logo" height="90" width="1255">
            </div>
        </div>
        <div id="nav">
            <a href="Accueil.php">
                <input type="button" name="Accueil" value="Accueil">
            </a>
            <a href="ToutParcourir.php">
                <input type="button" name="Parcourir" value="Tout Parcourir">
            </a>
            <a href="Accueil.php">
                <input type="button" name="Modifier" value="Modifier" id="btn1">
                
            </a>
            <a href="Compte.php" id="lienCompte">
                <input type="button" name="Compte" value="Compte" id="btn2">
            </a>
            <!--Modification boutons en fonction du compte connecte-->
            
            <?php echo"<script type='text/javascript'>testConnexion1($jsvars)</script>";
            echo"<script type='text/javascript'>testConnexion2($jsvars)</script>"?>
        </div>
        <div id="section">
            Historique des Messages <br>
            <ul>
                <li>Message 1</li>
                <li>Message 2</li>
                <li>Message 3</li>
            </ul><br>

            Historique des RDV <br>
            <ul>
                <a href="InfosMedecin.php">
                    <li>RDV 1</li>
                </a>
                <li>RDV 2</li>
                <li>RDV 3</li>
            </ul>
        </div>
        <div id="footer">Copyright &copy; 2022, OMNES Sant&eacute;<br>
            <a href="mailto:OMNES.sante@gmail.com">OMNES.sante@gmail.com</a>
        </div>
    </div>
</body>

</html>