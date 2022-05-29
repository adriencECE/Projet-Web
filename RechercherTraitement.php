<?php
session_start();

//Initialisation si les variables de la session n'existent pas
//Uniquement lors de la premiere ouverture de Accueil.php

$db = "omnessante"; //Name of DB
$site = "localhost"; //Name of the Website
$db_id = "root"; //DB login ID
$db_mdp = ""; //DB login PW

$sql = "";
$trouve=false;
$Recherche=$_GET["Recherche"];

//Affichage Session pour test
//echo $_SESSION["connecte"]." ".$_SESSION["login"]." ".$_SESSION["MDP"];
$db_handle = mysqli_connect($site, $db_id, $db_mdp);

//var_dump($db_handle);

//Access DB
$db_found = mysqli_select_db($db_handle, $db);

//var_dump($db_found);

if ($db_found) {

   
        $sql = "SELECT * FROM labo ";
        $sql2 = "SELECT * FROM medecins ";
        
    

    $res = mysqli_query($db_handle, $sql);
    $res2 = mysqli_query($db_handle, $sql2);
    //var_dump($res);
    $listeLabo;
    while ($data = mysqli_fetch_assoc($res)) {
        //$data = une ligne de la table
        //On crée un tableau avec toutes ces lignes
        $listeLabo[] = $data;
    }
    $listeMedecin;
    while ($data = mysqli_fetch_assoc($res2)) {
        //$data = une ligne de la table
        //On crée un tableau avec toutes ces lignes
        $listeMedecin[] = $data;
    }
foreach($listeLabo as $var){
    if($var["Nom"]==$Recherche){
        $trouve=true;
        header("Location:InfosLabo.php?Id=".$var["Id"]);
    }
    if($var["Service"]==$Recherche){
        $trouve=true;
        header("Location:laboratoire.php?Service=".$var["Service"]."&Id=".$var["Id"]);
    }

}

foreach($listeMedecin as $var){
    
    if($var["Nom"]==$Recherche)
    {$trouve=true;
        header("Location:InfosMedecin.php?Id=".$var["Id"]);
    }
    if($var["Spe"]==$Recherche)
    {$trouve=true;
        if($Recherche=="Generaliste"){
            $trouve=true;
            header("Location:generaliste.php");}
        else{

        header("Location:specialiste.php?Spe=".$var["Spe"]);}
    }
  
}
if($trouve==false)
{
    header("Location:Accueil.php?trouve=false");
}


}

//echo "<script>alert($jsvars)</script>";
?>