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
$Bouton=""; 
if (isset($_POST["Login"])) {
    $login = $_POST["Login"];
} else {

    $login = "";
}

if (isset($_POST["Id"])) {
    $Id = $_POST["Id"];
    $_SESSION["Id"] = $_POST["Id"];
 
   
} else {
    $Id = $_SESSION["Id"];
}

if (isset($_GET["Bouton"])) {
    $Bouton = $_GET["Bouton"];
} else {

    $Bouton = "";
}

$NomM;
$PrenomM;
$NomP=$_SESSION["name"];
$PrenomP=$_SESSION["prenom"];

$Bouton=$_GET["Bouton"];

$rest = substr($Bouton, -2); 
if(is_numeric($rest))
{
    $Heure=$rest;
    $Date=substr($Bouton,0,-2);
}
else{
$Heure=substr($Bouton, -1);
$Date=substr($Bouton,0, -1);
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
     
    $sql = "SELECT Nom,Prenom FROM medecins WHERE Id=$Id";
        $res = mysqli_query($db_handle, $sql);
        //var_dump($res);
 
        while($data = mysqli_fetch_assoc($res))
        {
            //var_dump($data);
            //$data = une ligne de la table
            //On crée un tableau avec toutes ces lignes
           // $med=$data;
           
            $NomM=$data["Nom"];
            $PrenomM=$data["Prenom"];
            
        }  

        
    $sql = "INSERT INTO rdv (Id, NomM, PrenomM, NomP, PrenomP, Date, Heure) VALUES (NULL,'$NomM', '$PrenomM','$NomP', '$PrenomP', '$Date', '$Heure')";
    $res = mysqli_query($db_handle, $sql);
  
}
else {
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

<script type="text/javascript">
    
                window.location = "Accueil.php";
            </script>
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
</head>