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

if(isset($_POST["login"])){
    $login=$_POST["login"];
}
else{
    $login = "";
}
if(isset($_POST["MDP"])){
    $MDP=$_POST["MDP"];
}
else{
    $MDP = "";
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

        $sql = "SELECT * FROM comptes WHERE Login='$login' AND MDP='$MDP'";
        $res = mysqli_query($db_handle, $sql);
        //var_dump($res);
 
        while($data = mysqli_fetch_assoc($res))
        {
            //var_dump($data);
            //$data = une ligne de la table
            //On crée un tableau avec toutes ces lignes
            $Compte=$data;
            $login = $data['Login'];
            $MDP = $data['MDP'];
        }        
        //var_dump($Compte);
}
else{
    echo "Unable to connect <br>";
}
?>

<html>
<head>
    <title>OMNES Sant&eacute;-Connexion</title>
    <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon"
        href="https://www.omneseducation.com/app/themes/inseec-group/favicon.ico">
        <script src="script.js">  
            
        </script>
</head>
<body>
    <?php 
    //var_dump($Compte);
    if(isset($Compte)):
        //var_dump($login);
        
        $_SESSION["login"]=$login;
        $_SESSION["MDP"]=$MDP;
        $_SESSION["connecte"]="true"; 
        //var_dump($_SESSION);
        ?>
        <script type="text/javascript">        
        alert("Connexion reussie");
        window.location = "Accueil.php";
        </script>
        
            <?php else: ?>
                <script type="text/javascript">
                alert("Probleme de connexion");
                window.location = "Connexion.php";
                </script>
            <?php endif ?>
</body>
</html>