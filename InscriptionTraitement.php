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
    $login = $_POST["Login"];
} else {
    $toutRempli = false;
    $login = "";
}
if (isset($_POST["MDP"])) {
    $MDP = $_POST["MDP"];
} else {
    $toutRempli = false;
    $MDP = "";
}
if (isset($_POST["Nom"])) {
    $Nom = $_POST["Nom"];
} else {
    $toutRempli = false;
    $Nom = "";
}
if (isset($_POST["Prenom"])) {
    $Prenom = $_POST["Prenom"];
} else {
    $toutRempli = false;
    $Prenom = "";
}
if (!isset($_POST["Tel"])) {
    $toutRempli = false;
} else {
    $Tel = $_POST["Tel"];
}
if (!isset($_POST["Mail"])) {
    $toutRempli = false;
} else {
    $Mail = $_POST["Mail"];
}
if (!isset($_POST["Adresse"])) {
    $toutRempli = false;
} else {
    $Adresse = $_POST["Adresse"];
}
if (!isset($_POST["NumCarteVitale"])) {
    $toutRempli = false;
} else {
    $NumCarteVitale = $_POST["NumCarteVitale"];
}
if (!isset($_POST["NumeroCarte"])) {
    $toutRempli = false;
} else {
    $NumeroCarte = $_POST["NumeroCarte"];
}
if (!isset($_POST["TypeCarte"])) {
    $toutRempli = false;
} else {
    $TypeCarte = $_POST["TypeCarte"];
}
if (!isset($_POST["DateExpiration"])) {
    $toutRempli = false;
} else {
    $DateExpiration = $_POST["DateExpiration"];
}
if (!isset($_POST["CodeCarte"])) {
    $toutRempli = false;
} else {
    $CodeCarte = $_POST["CodeCarte"];
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