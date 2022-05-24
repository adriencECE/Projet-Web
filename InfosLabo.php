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
$Id = $_POST["Id"];
$sql = "";
$test="";

//Connect
$db_handle = mysqli_connect($site, $db_id, $db_mdp);

//Access DB
$db_found = mysqli_select_db($db_handle,$db);

if($db_found){
    //echo "Connected to DB <br>";
        $sql = "SELECT * FROM labo WHERE Id=$Id";
        $res = mysqli_query($db_handle, $sql);
        while($data = mysqli_fetch_assoc($res))
        {
            //$data = une ligne de la table
            //On crée un tableau avec toutes ces lignes
            $Labo = $data;
        }  
}
else{
    echo "Unable to connect <br>";
}
?>


<html>

<head>
    <title>OMNES Sant&eacute;-Informations Laboratoires</title>
    <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon"
        href="https://www.omneseducation.com/app/themes/inseec-group/favicon.ico">
        <script src="script.js">  
        </script>
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <div id="logo">
            <img src="omnessante.png"
                    class="custom-logo" height="90" width="1255">
            </div>
        </div>
        <div id="nav">
            <a href="Accueil.php">
                <input type="button" name="Accueil" value="Accueil">
            </a>
            <a href="ToutParcourir.php">
                <input type="button" name="Parcourir" value="Tout Parcourir">
            </a>
            <a href="Accueil.php">
                <input type="button" name="Modifier" value="Modifier" id="btn1">
                
            </a>
            <a href="Compte.php" id="lienCompte">
                <input type="button" name="Compte" value="Compte" id="btn2">
            </a>
            <!--Modification boutons en fonction du compte connecte-->
            
            <?php echo"<script type='text/javascript'>testConnexion1($jsvars)</script>";
            echo"<script type='text/javascript'>testConnexion2($jsvars)</script>"?>
        </div>
        <div id="section">
            Infos Labo <?php echo  $Id?><br>
            <?php echo "Nom: ".$Labo["Nom"]."  ";
            echo "Salle :".$Labo["Salle"]."  ";
            echo "Telephone :".$Labo["Tel"]."  ";
            echo "Mail :".$Labo["Mail"]."<br>  "; ?>
            <a href="Services.php">
                <input type="button" name="Services" value="Nos Services">
            </a>
        </div>
        <div id="footer">Copyright &copy; 2022, OMNES Sant&eacute;<br>
            <a href="mailto:OMNES.sante@gmail.com">OMNES.sante@gmail.com</a>
        </div>
    </div>
</body>

</html>