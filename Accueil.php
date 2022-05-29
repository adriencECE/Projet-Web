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
    $_SESSION["name"] = "";
    $_SESSION["prenom"] = "";
    $_SESSION["type"] = "";
}
//Affichage Session pour test
//echo $_SESSION["connecte"]." ".$_SESSION["login"]." ".$_SESSION["MDP"];

$vars = array($_SESSION["connecte"], $_SESSION["login"], $_SESSION["MDP"]);
$jsvars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
//echo "<script>alert($jsvars)</script>";
?>

alert("Rien n'a ete trouve pour cette recherche !");

<html>

<head>
    <title>OMNES Sant&eacute;-Accueil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon" href="https://www.omneseducation.com/app/themes/inseec-group/favicon.ico">
    <script type="text/javascript" src="script.js"></script>
    <script>
        function Rechercher(){
        var r=document.getElementById("recherche").value;
        window.location="RechercherTraitement.php?Recherche="+r;
        }
    </script>
</head>


<body>

    <section class="presentation">
        <div id="wrapper">
            <div id="header">
                <div id="nav">
                    <img src="omnessante.png" class="logo">
                    <input id="recherche" type="text" name="Rechercher" value=""/> 
                    <div class="header-right">
                    
                        <a id="Rechercher" onclick="Rechercher()">Rechercher</a>
                        
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
            <h1><span>Bienvenue sur OMNES Sant&eacute;<br></span></h1>
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
                <h1 class="section-title">Nos service et notre offre <br></h1>
                <p>Notre valeur première et la plus fondamentale est la qualité des soins. 
                    Nous nous efforçons d'offrir à tous les patients la meilleure qualité de soins grâce 
                    à une formation approfondie et continue de notre personnel, des équipements performants, 
                    une approche multidisciplinaire et une priorité absolue pour la sécurité des patients.
                </p>
            </div>
            <div class="offer-bottom">
                <div class="offer-item">
                    <div class="icon"><img src="https://img.icons8.com/color/48/000000/medical-doctor.png" /></div>
                    <h2>Actualit&eacute;s</h2>
                    <p>Notre hôpital lance une nouvelle action contre la faim dans notre région. 
                        Nous allons en effet tenter de subvenir aux besoins des plus pauvres et 
                        ainsi avec votre aide créer des subventions ces subvention que vous nous verserez 
                        sur notre site permettront à nos 
                        équipes d'aller au plus près des pauvres pour apporter les premiers soins.</p>
                </div>
                <div class="offer-item">
                    <div class="icon"><img src="https://img.icons8.com/ios/50/000000/hospital-3.png" /></div>
                    <h2>Ev&eacute;nements</h2>
                    <p>Nous sommes ravis de vous inviter à la 7e Conférence internationale sur la maladie aortique. 
                        Cette année sera particulière à plusieurs égards.</p>
                </div>
                <!--
                <div class="offer-item">
                    <div class="icon"><img src="https://img.icons8.com/ios-glyphs/30/000000/implant.png" /></div>
                    <h2>Soins</h2>
                    <p>Mountain passes connecting valleys or countries often exceed 2,000 meters in altitude.
                        The Alps form a 1,200 kilometer barrier between the Mediterranean Sea and the Danube. The alps are beautiful and as big as huge.</p>
                </div>-->
                <div class="offer-item">
                    <div class="icon"><img src="https://img.icons8.com/fluency-systems-filled/48/000000/fetus.png" /></div>
                    <h2>Maternité</h2>
                    <p>Notre équipe vous informera et vous accompagnera tout au long de votre voyage.
                        Nous accompagnons vos choix, qu'il s'agisse de préparation à l'accouchement,
                        Approche de gestion de la douleur ou niveau d'intervention médicale.
                         Laissez votre naissance correspondre à vos rêves.</p>
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