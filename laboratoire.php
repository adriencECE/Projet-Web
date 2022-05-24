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
$test="";
if(isset($_POST["service"])){
    $service=$_POST["service"];
}
else{
    $service = "";
}

//Connect
//$db_handle = mysqli_connect($site, $db_id, $db_mdp, $db, $port);
$db_handle = mysqli_connect($site, $db_id, $db_mdp);

//var_dump($db_handle);

//Access DB
$db_found = mysqli_select_db($db_handle,$db);

//var_dump($db_found);

if($db_found){
    //echo "Connected to DB <br>";
    if($service==""){
        $sql = "SELECT * FROM labo ";
    }
    else{
        $sql = "SELECT * FROM labo WHERE Service='$service'";
    }
        
        $res = mysqli_query($db_handle, $sql);
        //var_dump($res);
        $listeLabo;
        while($data = mysqli_fetch_assoc($res))
        {
            //$data = une ligne de la table
            //On crée un tableau avec toutes ces lignes
            $listeLabo[]=$data;
        }
   
        
}
else{
    echo "Unable to connect <br>";
}
?>

<html>

<head>
    <title>OMNES Sant&eacute;-Laboratoires</title>
    <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon"
        href="https://www.omneseducation.com/app/themes/inseec-group/favicon.ico">
        <script src="script.js">  
        </script>
</head>

<body>
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
        <div id="section">
        <form method="post" action="laboratoire.php">
            Choisissez un Service:<br>
            <input type="radio" name="service" value="depistage covid" onclick="<?php $service="depistage covid"?>">
            <label>Test COVID</label>
            <input type="radio" name="service" value="test sanguin" onclick="<?php $service="test sanguin"?>">
            <label>Test Sanguin</label>
            <input type="radio" name="service" value="cancerologie" onclick="<?php $service="cancerologie"?>">
            <label>Canc&eacute;rologie</label>
            <input type="radio" name="service" value="IST" onclick="<?php $service="IST"?>">
            <label> Depisatge IST</label>
            <input type="radio" name="service" value="BiologiePreventive" onclick="<?php $service="BiologiePreventive"?>">
            <label> Biologie Pr&eacute;ventive</label>
            <input type="radio" name="service" value="Gynecologie" onclick="<?php $service="Gynecologie"?>">
            <label> Gyn&eacute;cologie</label>
            <input type="radio" name="service" value="BioFemmeEnceinte" onclick="<?php $service="BioFemmeEnceinte"?>">
            <label> Biologie Femme Enceinte</label>
            <input type="radio" name="service" value="" onclick="<?php $service=""?>">
            <label> Tous</label><br>
            <input type="submit" value="Valider">
            </form>
            Liste Laboratoires contenant le service s&eacute;lectionn&eacute; <br>
            <form method="post" action="InfosLabo.php">
                <ul>
                    <!-- Pour chaque médecin Généraliste dans la table-->
                    <?php foreach($listeLabo as $Labo) :?>
                        <li>
                            <input type="radio" name="Id" value="<?= $Labo["Id"]?>" checked>
                            <?php echo $Labo["Id"]." ".$Labo['Nom']." ".$Labo['Service']?>
                        </li>
                    <?php endforeach?>
                </ul>
                <label>Voir les informations du m&eacute;decin s&eacute;lectionn&eacute;:</label>
                <input type="submit" value="Soumettre">
                </form>
        </div>
        <div id="footer">Copyright &copy; 2022, OMNES Sant&eacute;<br>
            <a href="mailto:OMNES.sante@gmail.com">OMNES.sante@gmail.com</a>
        </div>
    </div>
</body>

</html>