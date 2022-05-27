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
                        <a href="RDV.php" data-after="Acc" id="btn1">Modif </a>
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


    <section class="infos">
        <div id="section">
            <a id="infos"></a>
            <h1><span>Bienvenue sur OMNES Sant&eacute; <?php echo $_SESSION["login"] ?><br></span></h1>
            <div class="info">
                <div>
                    <!--
                    Actualit&eacute;s <br>
                    1. Un nouveau brancard pour la pédiatrie
                    Depuis novembre 2021, un nouveau brancard d’urgence néonatale et pédiatrique a été acquis par le CHRU. Il va permettre de transporter jusqu’à 300 enfants nés prématurés par an. Notre unité est le pôle de référence de la Bretagne pour la prise en charge des grands prématurés et des jeunes enfants.
                    D’un montant de 80 000 €, il a été financé par des dons : La Littorale pour 40 000 €, puis Innovéo en partenariat avec le centre Leclerc de Gouesnou, et l’Open de Tennis.


                </div>
                <div>Ev&eacute;nements <br></div>-->
                </div>
            </div>
    </section>





    <!-- Offer Section -->
    <section class="offers">
        <a id="offers"></a>
        <div class="offers container">
            <div class="offer-top">
                <h1 class="section-title">Offers</h1>
                <p>We offer you the possibility of receiving specific assistance for your expeditions.
                    With our teams, we have the experience and the ability to provide you with high-quality,
                    long-term shipments. Our profession, our know-how are at your service to allow you to evolve in the high mountains
                    between safety and to be able to improve yourself every day.
                </p>
            </div>
            <div class="offer-bottom">
                <div class="offer-item">
                    <div class="icon"><img src="https://img.icons8.com/color/48/000000/medical-doctor.png" /></div>
                    <h2>Blabla</h2>
                    <p>A two-day adventure to discover the Madriu Valley, which was declared a World Heritage Site by UNESCO.
                        For your convenience, horses will carry your equipment and we will organize an unforgettable bivouac in some remote cabins.</p>
                </div>
                <div class="offer-item">
                    <div class="icon"><img src="https://img.icons8.com/ios/50/000000/hospital-3.png" /></div>
                    <h2>Blabla</h2>
                    <p>The Himalayas stretches for more than 2,400 km, from Nanga Parbat in Pakistan in the west to Namche Barwa in the east.
                        It has three parallel chains arranged of altitude.</p>
                </div>
                <div class="offer-item">
                    <div class="icon"><img src="https://img.icons8.com/ios-glyphs/30/000000/implant.png" /></div>
                    <h2>Alps</h2>
                    <p>Mountain passes connecting valleys or countries often exceed 2,000 meters in altitude.
                        The Alps form a 1,200 kilometer barrier between the Mediterranean Sea and the Danube. The alps are beautiful and as big as huge.</p>
                </div>
                <div class="offer-item">
                    <div class="icon"><img src="https://img.icons8.com/fluency-systems-filled/48/000000/fetus.png" /></div>
                    <h2>The Andes Cordillera</h2>
                    <p>The Andes Cordillera is the longest continental mountain range in the world2,
                        trending north-south along the western coast of South America. It's so nice.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Offer Section -->

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