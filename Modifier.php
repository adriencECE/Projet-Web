<?php session_start();
$vars = array($_SESSION["connecte"], $_SESSION["login"], $_SESSION["MDP"]);
$jsvars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);

$db = "omnessante"; //Name of DB
$site = "localhost"; //Name of the Website
$db_id = "root"; //DB login ID
$db_mdp = ""; //DB login PW
$var;
$sql = "";
$test = "";

if (isset($_POST["service"])) {
    $service = $_POST["service"];
} else {
    $service = "";
}
//Connect
$db_handle = mysqli_connect($site, $db_id, $db_mdp);

//Access DB
$db_found = mysqli_select_db($db_handle, $db);

if ($db_found) {
    //echo "Connected to DB <br>";
    $sql = "SELECT * FROM medecins ";
    $res = mysqli_query($db_handle, $sql);
    $listeGeneralistes;
    while ($data = mysqli_fetch_assoc($res)) {
        //$data = une ligne de la table
        //On crée un tableau avec toutes ces lignes
        $listeGeneralistes[] = $data;
    }

    if ($service == "") {
        $sql = "SELECT * FROM labo ";
   

    $res = mysqli_query($db_handle, $sql);
    //var_dump($res);
    $listeLabo;
    while ($data = mysqli_fetch_assoc($res)) {
        //$data = une ligne de la table
        //On crée un tableau avec toutes ces lignes
        $listeLabo[] = $data;
    }
}
} else {
    echo "Unable to connect <br>";
}
?>

<html>

<head>
    <title>OMNES Sant&eacute;-Modifier</title>
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
        <div id="section">
            Liste M&eacute;decins G&eacute;n&eacute;ralistes <br>
            <form method="post" action="Supprimer.php" style="color:black">
                <ul>
                    <!-- Pour chaque médecin Généraliste dans la table-->
                    <?php foreach ($listeGeneralistes as $Generaliste) : ?>
                        <li>
                            <input type="radio" name="Id" value="<?= $Generaliste["Id"] ?>" checked>
                            <?php echo $Generaliste["Id"] . " " . $Generaliste['Nom'] . " " . $Generaliste['Prenom'] . " " . $Generaliste['Spe'] ?>
                        </li>
                    <?php endforeach ?>
                </ul>
                <label>Que faire avec le m&eacute;decin s&eacute;lectionn&eacute;:</label>
                <input type="submit" name="SupprimerMedecin" value="Supprimer">
                <input type="submit" name="ModifierMedecin" value="Modifier">
            </form>
        </div>
    </section>
    <section class="lesLabos">
    <form method="post" action="Supprimer.php?Suppr=Labo" style="color:black">
                <ul>
                    <!-- Pour chaque médecin Généraliste dans la table-->
                    <?php foreach ($listeLabo as $Labo) : ?>
                        <li>
                            <input type="radio" name="Id" value="<?= $Labo["Id"] ?>" checked>
                            <?php echo $Labo["Id"] . " " . $Labo['Nom'] . " " . $Labo['Service'] ?>
                        </li>
                    <?php endforeach ?>
                </ul>
                <label>Que faire avec le laboratoire s&eacute;lectionn&eacute; ?:</label>
                <input type="submit" name="SupprimerLabo" value="Supprimer">
                <input type="submit" name="ModifierLabo" value="Modifier">
            </form>
    </section>

    <section class="listesMedecins">
        <div id="section">
        <form method="post" action="Ajouter.php" style="color:black">
            <input type="submit" name="Ajouter" value="Ajouter un M&eacute;decin ou un Laboratoire">
            </form>
            <input type="button" name="Modifier" value="Modifier un M&eacute;decin">
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