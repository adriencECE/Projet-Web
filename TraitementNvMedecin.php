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

if(isset($_POST["medecin"])){



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
            $Login = $_POST["Mail"];
        }else{
            $toutRempli = false;
            $Mail = "";
        }    
    } else {
        $toutRempli = false;
        $Mail = "";
    }
    if (isset($_POST["Cv"])) {
        if($_POST["Cv"] != ""){
            $Cv = $_POST["Cv"];
        }else{
            $toutRempli = false;
            $Cv = "";
        }    
    } else {
        $toutRempli = false;
        $Cv = "";
    }
    if (isset($_POST["Image"])) {
        if($_POST["Image"] != ""){
            $Image = $_POST["Image"];
        }else{
            $toutRempli = false;
            $Image = "";
        }    
    } else {
        $toutRempli = false;
        $Image = "";
    }
    if (isset($_POST["Repos"])) {
        if($_POST["Repos"] != ""){
            $Repos = $_POST["Repos"];
        }else{
            $toutRempli = false;
            $Repos = "";
        }    
    } else {
        $toutRempli = false;
        $Repos = "";
    }
    if (isset($_POST["Specialite"])) {
        if($_POST["Specialite"] != ""){
            $Specialite = $_POST["Specialite"];
        }else{
            $toutRempli = false;
            $Specialite = "";
        }    
    } else {
        $toutRempli = false;
        $Specialite = "";
    }
    if (isset($_POST["Salle"])) {
        if($_POST["Salle"] != ""){
            $Salle = $_POST["Salle"];
        }else{
            $toutRempli = false;
            $Salle = "";
        }    
    } else {
        $toutRempli = false;
        $Salle = "";
    }
}


elseif(isset($_POST["labo"])){
   
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
    if (isset($_POST["Service"])) {
        if($_POST["Service"] != ""){
            $Login = $_POST["Service"];
        }else{
            $toutRempli = false;
            $Service = "";
        }    
    } else {
        $toutRempli = false;
        $Service = "";
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
            $Login = $_POST["Mail"];
        }else{
            $toutRempli = false;
            $Mail = "";
        }    
    } else {
        $toutRempli = false;
        $Mail = "";
    }
    if (isset($_POST["Salle"])) {
        if($_POST["Salle"] != ""){
            $Salle = $_POST["Salle"];
        }else{
            $toutRempli = false;
            $Salle = "";
        }    
    } else {
        $toutRempli = false;
        $Salle = "";
    }
    
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
        if(isset($_POST["medecin"]) && $Nom!="" && $Prenom!="" && $Login!="" && $MDP!=""){
        $sql = "SELECT * FROM comptes WHERE Login='$Login' AND MDP='$MDP' AND Nom='$Nom' AND Prenom='$Prenom'";
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
        } elseif($Nom!="" && $Prenom!="" && $Login!="" && $MDP!="") {
            $sql = "INSERT INTO comptes (Nom, Prenom, Type, Login, MDP) VALUES ('$Nom', '$Prenom', '2', '$Login', '$MDP')";
            $res = mysqli_query($db_handle, $sql);
           // return mysqli_query($db_handle, $sql)or die(mysqli_error($db_handle));
            $sql3  = "INSERT INTO medecins (Id,Nom, Prenom, Spe,Salle,Tel, Mail, Image, Repos, CV) 
            VALUES (NULL,'$Nom', '$Prenom','$Specialite','$Salle', '$Tel', '$Mail', '$Image', '$Repos', '$Cv')";
           
            //var_dump($res);
            return mysqli_query($db_handle, $sql3)or die(mysqli_error($db_handle));
            //$res3 = mysqli_query($db_handle, $sql3);
            //var_dump($res);
            $inscrit=true;
        }
        else{
            header("Location: Ajouter.php");
        }
    }
    elseif(isset($_POST["labo"])){
        $sql4  = "INSERT INTO labo (Nom, Service,Salle,Tel, Mail) 
        VALUES ('$Nom', '$Service','$Salle', '$Tel', '$Mail')";      
       $res4=mysqli_query($db_handle, $sql4);	
$inscrit=true;
    }


    }else{
        header("Location: Ajouter.php?Rempli=false");
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
           window.location = "Ajouter.php";
        </script>

    <?php else : ?>
        <?php if ($existant == false && $inscrit == true) : ?>
            <script type="text/javascript">
                alert("Inscription reussie \nBienvenue");
               window.location = "Modifier.php";
            </script>
        <?php endif ?>
    <?php endif ?>
</body>