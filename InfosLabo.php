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
if (isset($_POST["Id"])) {
    $Id = $_POST["Id"];
    $_SESSION["Id"] = $_POST["Id"];
} elseif (isset($_GET["Id"])) {
    $Id = $_GET["Id"];
} else {
    $Id = $_SESSION["Id"];
}
$sql = "";
$test = "";

//Connect
$db_handle = mysqli_connect($site, $db_id, $db_mdp);

//Access DB
$db_found = mysqli_select_db($db_handle, $db);

if ($db_found) {
    //echo "Connected to DB <br>";
    $sql = "SELECT * FROM labo WHERE Id=$Id";
    $res = mysqli_query($db_handle, $sql);
    while ($data = mysqli_fetch_assoc($res)) {
        //$data = une ligne de la table
        //On crée un tableau avec toutes ces lignes
        $Labo = $data;
    }
} else {
    echo "Unable to connect <br>";
}

?>


<html>

<head>
    <title>OMNES Sant&eacute;-Informations Laboratoires</title>
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


    <section class="lesMedecins">
    <div id="photoB"></div>
        <div id="section">
            <h2>Infos Laboratoire <br></h2>
            <p>
                <?php echo "Nom: " . $Labo["Nom"] . " <br> ";
                echo "Salle: " . $Labo["Salle"] . " <br> ";
                echo "Telephone: " . $Labo["Tel"] . " <br> ";
                echo "Mail: " . $Labo["Mail"] . " <br> "; ?>
            <form method="post" action="Services.php">
                <input type="text" name="NomLabo" value='<?php echo $Labo["Nom"] ?>' hidden />
                <input type="submit" name="Services" value="Nos Services" />

            </form>
            </p>
        </div>
    </section>





</body>

</html>