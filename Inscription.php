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

    <section class="ajouterMedecin">
        <div id="section">
            <div class="carreca">
                <u>
                    <h2>Vos informations:</h2><br><br>
                </u>
                <form method="post" action="InscriptionTraitement.php">

                    <div class="input_field">
                        <input type="text" placeholder="Nom" name="Nom" /><br>
                    </div>

                    <div class="input_field">
                        <input type="text" placeholder="Prenom" name="Prenom" /><br>
                    </div>

                    <div class="input_field">
                        <input type="text" placeholder="Login" name="Login" /><br>
                    </div>

                    <div class="input_field">
                        <input type="text" placeholder="MDP" name="MDP" /><br>
                    </div>

                    <div class="input_field">
                        <input type="text" placeholder="Mail" name="Mail" /><br>
                    </div>

                    <div class="input_field">
                        <input type="text" placeholder="Téléphone" name="Tel" /><br>
                    </div>

                    <div class="input_field">
                        <input type="text" placeholder="Adresse" name="Adresse" /><br>
                    </div>

                    <div class="input_field">
                        <input type="text" placeholder="NumCarteVitale" name="NumCarteVitale" /><br>
                    </div>
                    <div class="tbeau">
                        <input type="submit" value="Soumettre">
                    </div>
                    
                </form>
            </div>
        </div>
    </section>


    <section class="ajouterLabo">
        <div id="section"><br><br><br><br><br><br>
            <div class="carreca">
                <u>
                    <h2>Votre moyen de payment:</h2>
                </u>
                <form method="post" action="InscriptionTraitement.php">

                <label>Type de Carte:</label>
                    <input type="radio" name="TypeCarte" value="Visa" checked>
                    <label>Visa</label>
                    <input type="radio" name="TypeCarte" value="MasterCard">
                    <label>MasterCard</label>
                    <input type="radio" name="TypeCarte" value="American Express">
                    <label>American Express</label>
                    <input type="radio" name="TypeCarte" value="Paypal">
                    <label>Paypal</label><br>


                    <div class="input_field">
                        <input type="text" placeholder="NumeroCarte" name="NumeroCarte"><br>
                    </div>

                    <div class="input_field">
                        <input type="text" placeholder="Nom" name="Nom"><br>
                    </div>

                    <div class="input_field">
                        <input type="text" placeholder="Prenom" name="Prenom"><br>
                    </div>

                    <div class="input_field">
                        <input type="text" placeholder="DateExpiration" name="DateExpiration" value="yyyy-mm-dd" onclick="value=''"><br>
                    </div>

                    <div class="input_field">
                        <textarea type="number" placeholder="CodeCarte" name="CodeCarte"></textarea>
                    </div>

                    <div class="tbeau">
                        <input type="submit" value="Soumettre">
                    </div>

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