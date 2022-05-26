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
$var;
$sql = "";
if (isset($_POST["spe"])) {
    $spe = $_POST["spe"];
} else {
    $spe = "";
}

//Connect
//$db_handle = mysqli_connect($site, $db_id, $db_mdp, $db, $port);
$db_handle = mysqli_connect($site, $db_id, $db_mdp);

//var_dump($db_handle);

//Access DB
$db_found = mysqli_select_db($db_handle, $db);

//var_dump($db_found);

if ($db_found) {
    //echo "Connected to DB <br>";
    if ($spe != "") {
        $sql = "SELECT * FROM medecins WHERE Spe = '$spe'";
    } else {
        $sql = "SELECT * FROM medecins WHERE Spe != 'Generaliste'";
    }

    $res = mysqli_query($db_handle, $sql);
    //var_dump($res);
    $listeSpecialistes;
    while ($data = mysqli_fetch_assoc($res)) {
        //$data = une ligne de la table
        //On crée un tableau avec toutes ces lignes
        $listeSpecialistes[] = $data;
    }
} else {
    echo "Unable to connect <br>";
}
?>

<html>

<head>
    <title>OMNES Sant&eacute;-Sp&eacute;cialistes</title>
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

    <section class="specialiste">
        <div id="section">
            <form method="post" action="specialiste.php">
                Choisissez une Sp&eacute;cialit&eacute;:<br>
                <input type="radio" name="spe" value="Addictologie" onclick="<?php $spe = "Addictologie" ?>">
                <label>Addictologie</label>
                <input type="radio" name="spe" value="Andrologie" onclick="<?php $spe = "Andrologie" ?>">
                <label>Andrologie</label>
                <input type="radio" name="spe" value="Cardiologie" onclick="<?php $spe = "Cardiologie" ?>">
                <label>Cardiologie</label>
                <input type="radio" name="spe" value="Dermatologie" onclick="<?php $spe = "Dermatologie" ?>">
                <label> Dermatologie</label>
                <input type="radio" name="spe" value="Gastro-H&eacute;pato-Ent&eacute;rologie " onclick="<?php $spe = "GHE" ?>">
                <label> Gastro-H&eacute;pato-Ent&eacute;rologie</label>
                <input type="radio" name="spe" value="Gynecologie" onclick="<?php $spe = "Gynecologie" ?>">
                <label> Gyn&eacute;cologie</label>
                <input type="radio" name="spe" value="IST" onclick="<?php $spe = "IST" ?>">
                <label> IST</label>
                <input type="radio" name="spe" value="Osth&eacute;opathie" onclick="<?php $spe = "Ostheopathie" ?>">
                <label> Ostheopathie</label>
                <input type="radio" name="spe" value="" onclick="<?php $spe = "" ?>">
                <label> Tous</label><br>
                <input type="submit" value="Valider">
            </form>
            <?php if (isset($listeSpecialistes)) : ?>
                <form method="post" action="InfosMedecin.php">
                    Liste M&eacute;decins Sp&eacute;cialistes <br>
                    <ul>
                        <!-- Pour chaque médecin Généraliste dans la table-->
                        <?php foreach ($listeSpecialistes as $Specialiste) : ?>
                            <li>
                                <input type="radio" name="Id" value="<?= $Specialiste["Id"] ?>" checked>
                                <?php echo $Specialiste["Id"] . " " . $Specialiste['Nom'] . " " . $Specialiste['Prenom'] . " " . $Specialiste['Spe'] ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                    <label>Voir les informations du m&eacute;decin s&eacute;lectionn&eacute;:</label>
                    <input type="submit" value="Soumettre">
                </form>

            <?php else : ?>
                <p>Il n'y a pas de m&eacute;decin de cette sp&eacute;cialite<br></p>
            <?php endif ?>
        </div>
    </section>


    <section class="footer">
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