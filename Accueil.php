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
                    1. Un nouveau brancard pour la p??diatrie
                    Depuis novembre 2021, un nouveau brancard d???urgence n??onatale et p??diatrique a ??t?? acquis par le CHRU. Il va permettre de transporter jusqu????? 300 enfants n??s pr??matur??s par an. Notre unit?? est le p??le de r??f??rence de la Bretagne pour la prise en charge des grands pr??matur??s et des jeunes enfants.
                    D???un montant de 80 000 ???, il a ??t?? financ?? par des dons : La Littorale pour 40 000 ???, puis Innov??o en partenariat avec le centre Leclerc de Gouesnou, et l???Open de Tennis.


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
                <p style="color:black">Notre valeur premi??re et la plus fondamentale est la qualit?? des soins. 
                    Nous nous effor??ons d'offrir ?? tous les patients la meilleure qualit?? de soins gr??ce 
                    ?? une formation approfondie et continue de notre personnel, des ??quipements performants, 
                    une approche multidisciplinaire et une priorit?? absolue pour la s??curit?? des patients.
                </p>
            </div>
            <div class="offer-bottom">
                <div class="offer-item">
                    <div class="icon"><img src="https://img.icons8.com/color/48/000000/medical-doctor.png" /></div>
                    <h2>Actualit&eacute;s</h2>
                    <p>Notre h??pital lance une nouvelle action contre la faim dans notre r??gion. 
                        Nous allons en effet tenter de subvenir aux besoins des plus pauvres et 
                        ainsi avec votre aide cr??er des subventions ces subvention que vous nous verserez 
                        sur notre site permettront ?? nos 
                        ??quipes d'aller au plus pr??s des pauvres pour apporter les premiers soins.</p>
                </div>
                <div class="offer-item">
                    <div class="icon"><img src="https://img.icons8.com/ios/50/000000/hospital-3.png" /></div>
                    <h2>Ev&eacute;nements</h2>
                    <p>Nous sommes ravis de vous inviter ?? la 7e Conf??rence internationale sur la maladie aortique. 
                        Cette ann??e sera particuli??re ?? plusieurs ??gards.</p>
                </div>
                <div class="offer-item">
                    <div class="icon"><img src="https://img.icons8.com/fluency-systems-filled/48/000000/fetus.png" /></div>
                    <h2>Maternit??</h2>
                    <p>Notre ??quipe vous informera et vous accompagnera tout au long de votre voyage.
                        Nous accompagnons vos choix, qu'il s'agisse de pr??paration ?? l'accouchement,
                        Approche de gestion de la douleur ou niveau d'intervention m??dicale.
                         Laissez votre naissance correspondre ?? vos r??ves.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Offer Section -->

    <section class="footerAcceuil">
        <a id="footer"></a>
        <div class="footer container">
            <div id="footer">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.337709887612!2d2.2842932154568762!3d48.851770309127225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b4f58251b%3A0x167f5a60fb94aa76!2sECE%20Paris%20Lyon!5e0!3m2!1sfr!2sfr!4v1653329170449!5m2!1sfr!2sfr" width="200" height="100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <a><br>Copyright &copy; 2022, OMNES Sant&eacute;<br></a>
                <a href="mailto:OMNES.sante@gmail.com">OMNES.sante@gmail.com</a>
            </div>
        </div>
    </section>



</body>

</html>