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


$Type=$_POST["TypeCarte"];
$Nom=$_POST["Nom"];
$Prenom=$_POST["Prenom"];
$Numero=$_POST["NumeroCarte"];
$Date=$_POST["DateExpiration"];
$bon=true;

//Connect
$db_handle = mysqli_connect($site, $db_id, $db_mdp);

//Access DB
$db_found = mysqli_select_db($db_handle,$db);

if($db_found){
    //echo "Connected to DB <br>";
        $sql = "SELECT * FROM cb WHERE Nom='$Nom' AND Prenom='$Prenom'";
        $res = mysqli_query($db_handle, $sql);
        while($data = mysqli_fetch_assoc($res))
        {
            //$data = une ligne de la table
            //On crée un tableau avec toutes ces lignes
            $CB=$data;
        }  
        if($CB["Type"]!=$Type){
            echo "Mauvais type ";
            $bon=false;
        }
        if($CB["Numero"]!=$Numero){
            echo "Mauvais numero ";
            $bon=false;
        }
        if($CB["Date"]!=$Date){
            echo "Mauvaise date ";
            $bon=false;
        }
        if($bon==true){
            echo "Paiement accepte";
        }
        
}
else{
    echo "Unable to connect <br>";
}
?>

