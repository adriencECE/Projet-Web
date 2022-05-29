<?php
session_start();
//Connection
//echo "Connecting to DB <br>";

$db = "omnessante"; //Name of DB
$site = "localhost"; //Name of the Website
$db_id = "root"; //DB login ID
$db_mdp = ""; //DB login PW
$var;
$sql = "";
$toutRempli = true;
$existant = false;
$inscrit = false;
if (isset($_POST["Login"])) {
    if($_POST["Login"] != ""){
        $Login = $_POST["Login"];
    }else{
        $toutRempli = false;
        $Login = "";
    }    
} else {
    $toutRempli = false;
    $Login = "";
}
if (isset($_POST["MDP"])) {
    if($_POST["MDP"] != ""){
        $MDP = $_POST["MDP"];
    }else{
        $toutRempli = false;
        $MDP = "";
    }    
} else {
    $toutRempli = false;
    $MDP = "";
}
if (isset($_POST["Nom"])) {
    if($_POST["Nom"] != ""){
        $Nom = $_POST["Nom"];
    }else{
        $toutRempli = false;
        $Nom = "";
    }    
} else {
    $toutRempli = false;
    $Nom = "";
}
if (isset($_POST["Prenom"])) {
    if($_POST["Prenom"] != ""){
        $Prenom = $_POST["Prenom"];
    }else{
        $toutRempli = false;
        $Prenom = "";
    }    
} else {
    $toutRempli = false;
    $Prenom = "";
}
if (isset($_POST["Tel"])) {
    if($_POST["Tel"] != ""){
        $Tel = $_POST["Tel"];
    }else{
        $toutRempli = false;
        $Tel = "";
    }    
} else {
    $toutRempli = false;
    $Tel = "";
}
if (isset($_POST["Mail"])) {
    if($_POST["Mail"] != ""){
        $Mail = $_POST["Mail"];
    }else{
        $toutRempli = false;
        $Mail = "";
    }    
} else {
    $toutRempli = false;
    $Mail = "";
}if (isset($_POST["Adresse"])) {
    if($_POST["Adresse"] != ""){
        $Adresse = $_POST["Adresse"];
    }else{
        $toutRempli = false;
        $Adresse = "";
    }    
} else {
    $toutRempli = false;
    $Adresse = "";
}if (isset($_POST["NumCarteVitale"])) {
    if($_POST["NumCarteVitale"] != ""){
        $NumCarteVitale = $_POST["NumCarteVitale"];
    }else{
        $toutRempli = false;
        $NumCarteVitale = "";
    }    
} else {
    $toutRempli = false;
    $NumCarteVitale = "";
}if (isset($_POST["NumeroCarte"])) {
    if($_POST["NumeroCarte"] != ""){
        $NumeroCarte = $_POST["NumeroCarte"];
    }else{
        $toutRempli = false;
        $NumeroCarte = "";
    }    
} else {
    $toutRempli = false;
    $NumeroCarte = "";
}if (isset($_POST["TypeCarte"])) {
    if($_POST["TypeCarte"] != ""){
        $TypeCarte = $_POST["TypeCarte"];
    }else{
        $toutRempli = false;
        $TypeCarte = "";
    }    
} else {
    $toutRempli = false;
    $TypeCarte = "";
}
if (isset($_POST["DateExpiration"])) {
    if($_POST["DateExpiration"] != ""){
        $DateExpiration = $_POST["DateExpiration"];
    }else{
        $toutRempli = false;
        $DateExpiration = "";
    }    
} else {
    $toutRempli = false;
    $DateExpiration = "";
}
if (isset($_POST["CodeCarte"])) {
    if($_POST["CodeCarte"] != ""){
        $CodeCarte = $_POST["CodeCarte"];
    }else{
        $toutRempli = false;
        $CodeCarte = "";
    }    
} else {
    $toutRempli = false;
    $CodeCarte = "";
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

    if ($toutRempli == true) {
        $sql = "SELECT * FROM comptes WHERE Login='$login' AND MDP='$MDP' AND Nom='$Nom' AND Prenom='$Prenom'";
        $res = mysqli_query($db_handle, $sql);
        //var_dump($res);

        while ($data = mysqli_fetch_assoc($res)) {
            //var_dump($data);
            //$data = une ligne de la table
            //On crée un tableau avec toutes ces lignes
            $Compte = $data;
        }
        if (isset($Compte)) {
            $existant = true;
        } else {
            $sql = "INSERT INTO comptes (Nom, Prenom, Type, Login, MDP) VALUES ('$Nom', '$Prenom', '1', '$login', '$MDP')";
            $sql2 = "INSERT INTO cb (Prenom, Numero, Type, Nom, Date, Code)
            VALUES ('$Prenom', '$NumeroCarte','$TypeCarte', '$Nom', '$DateExpiration', '$CodeCarte')";
            $sql3  = "INSERT INTO patient (Nom, Prenom, Tel, Mail, Adresse, CarteVitale, CB) 
            VALUES ('$Nom', '$Prenom', '$Tel', '$Mail', '$Adresse', '$NumCarteVitale', '$NumeroCarte')";
            $res = mysqli_query($db_handle, $sql);
            //var_dump($res);
            $res2 = mysqli_query($db_handle, $sql2);
            //var_dump($res);
            $res3 = mysqli_query($db_handle, $sql3);
            //var_dump($res);
            if ($res && $res2 && $res3) {
                $inscrit = true;
                $_SESSION["login"] = $login;
                $_SESSION["MDP"] = $MDP;
                $_SESSION["connecte"] = "true";
            }
        }
    }


    //var_dump($Compte);
} else {
    echo "Unable to connect <br>";
}
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
    <?php if ($toutRempli == false) : ?>
        <script type="text/javascript">
            alert("Veuillez remplir tous les champs");
            window.location = "Inscription.php";
        </script>

    <?php else : ?>
        <?php if ($existant == false && $inscrit == true) : ?>
            <script type="text/javascript">
                alert("Inscription reussie \nBienvenue");
                window.location = "Accueil.php";
            </script>
        <?php else : ?>
            <script type="text/javascript">
                alert("Ce compte existe deja");
                window.location = "Connexion.php";
            </script>
        <?php endif ?>
    <?php endif ?>
</body>

</html>