<?php
//Connection
//echo "Connecting to DB <br>";

$db = "omnessante"; //Name of DB
$site = "localhost"; //Name of the Website
$db_id = "root"; //DB login ID
$db_mdp = ""; //DB login PW
$var;
//Connect
//$db_handle = mysqli_connect($site, $db_id, $db_mdp, $db, $port);
$db_handle = mysqli_connect($site, $db_id, $db_mdp);

//var_dump($db_handle);

//Access DB
$db_found = mysqli_select_db($db_handle,$db);

//var_dump($db_found);

if($db_found){
    //echo "Connected to DB <br>";
        $sql = "SELECT * FROM medecins WHERE Spe='Generaliste'";
        $res = mysqli_query($db_handle, $sql);
        //var_dump($res);
      
        while($data = mysqli_fetch_assoc($res))
        {
            echo "Nom: ".$data["Nom"]."  ";
            echo "Prenom :".$data["Prenom"]."  ";
            echo "Specialite :".$data["Spe"]."  ";
            echo "Telephone :".$data["Tel"]."  ";
            echo "Mail :".$data["Mail"]."  ";
           
        }
    }
else{
    echo "Unable to connect <br>";
}


?>