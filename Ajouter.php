<?php
session_start();
$vars = array($_SESSION["connecte"], $_SESSION["login"], $_SESSION["MDP"]);
$jsvars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
//Connection
//echo "Connecting to DB <br>";


$db = "omnessante"; //Name of DB
$site = "localhost"; //Name of the Website
$db_id = "root"; //DB login ID
$db_mdp = ""; //DB login PW
if(isset($_GET["Rempli"])){
    $Rempli=$_GET["Rempli"];
}


if (isset($_POST["Id"])) {
    $Id = $_POST["Id"];
    $_SESSION["Id"] = $_POST["Id"];
} else {
    $Id = $_SESSION["Id"];
}
$sql = "";

//Connect
$db_handle = mysqli_connect($site, $db_id, $db_mdp);

//Access DB
$db_found = mysqli_select_db($db_handle, $db);

if ($db_found) {
}

?>
<html>

<head>
    <title>OMNES Sant&eacute;-Accueil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon" href="https://www.omneseducation.com/app/themes/inseec-group/favicon.ico">
    <script type="text/javascript" src="script.js"></script>
    <script>if(<?php echo $Rempli ?> == false){
            alert("Des informations sont manquantes");
        }</script>
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
                    <h2>Ajouter un medecin:</h2><br><br>
                </u>
                <form method="post" action="TraitementNvMedecin.php">
                    <div class="input_field">
                        <input type="text" placeholder="Login" name="Login" /><br>
                    </div>
                    <div class="input_field">
                        <input type="text" placeholder="MDP" name="MDP" /><br>
                    </div>
                    <div class="input_field">
                        <input type="text" placeholder="Nom" name="Nom" /><br>
                    </div>
                    <div class="input_field">
                        <input type="text" placeholder="Prenom" name="Prenom" /><br>
                    </div>
                    <div class="input_field">
                        <input type="text" placeholder="Specialité" name="Specialite" /><br>
                    </div>
                    <div class="input_field">
                        <input type="text" placeholder="Salle" name="Salle" /><br>
                    </div>
                    <div class="input_field">
                        <input type="text" placeholder="Téléphone" name="Tel" /><br>
                    </div>
                    <div class="input_field">
                        <input type="text" placeholder="Mail" name="Mail" /><br>
                    </div>
                    <div class="input_field">
                        <input type="text" placeholder="Image" name="Image" /><br>
                    </div>
                    <div class="input_field">
                        <input type="text" placeholder="Repos" name="Repos" /><br>
                    </div>
                    <div class="input_field">
                        <textarea type="text" placeholder="Cv" name="Cv"></textarea>
                    </div>

                    <div class="tbeau">
                        <input type="submit" value="Soumettre" name="medecin" />
                    </div>


                </form>
            </div>
        </div>
    </section>

    <section class="ajouterLabo">
        <div id="section">
            <div class="carreca">
                <u>
                    <h2>Ajouter un laboratoire:</h2><br><br>
                </u>
                <form method="post" action="TraitementNvMedecin.php">
                    <div class="input_field">
                        <input type="text" placeholder="Nom" name="Nom" />
                    </div>
                    <div class="input_field">
                        <input type="text" placeholder="Service" name="Service" />
                    </div>
                    <div class="input_field">
                        <input type="text" placeholder="Salle" name="Salle" />
                    </div>
                    <div class="input_field">
                        <input type="text" placeholder="Téléphone" name="Tel" />
                    </div>
                    <div class="input_field">
                        <input type="text" placeholder="Mail" name="Mail" />
                    </div>

                    <div class="tbeau">
                        <input type="submit" value="Soumettre" name="labo" />
                    </div>
                </form>
            </div>
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