<?php session_start();
$vars = array($_SESSION["connecte"], $_SESSION["login"], $_SESSION["MDP"]);
$jsvars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
?>

<html>

<head>
    <title>OMNES Sant&eacute;-Parcourir</title>
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


    <section class="toutParcourir">
        <div id="section">
            <p>
            S&eacute;l&eacute;ctionnez ce que vous cherchez: <br><br></p>
            <form method="post" action="generaliste.php">
                    <!--<input type="submit" name="Generalistes" value="M&eacute;decins G&eacute;n&eacute;ralistes">-->
                    <a href="generaliste.php" data-after="M&eacute;decins G&eacute;n&eacute;ralistes"> M&eacute;decins G&eacute;n&eacute;ralistes</a>
            </form>

            <form method="post" action="specialiste.php">
                
                    <!--<input type="submit" name="Specialistes" value="M&eacute;decins Sp&eacute;cialistes">-->
                    <a href="specialiste.php" data-after="M&eacute;decins Sp&eacute;cialistes">M&eacute;decins Sp&eacute;cialistes</a>
                
            </form>

            <form method="post" action="laboratoire.php">
                
                    <!--<input type="submit" name="Laboratoires" value="Laboratoires">-->
                    <a href="laboratoire.php" data-after="Laboratoires">Laboratoires</a>
                
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