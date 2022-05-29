<?php
$db = "omnessante"; //Name of DB
$site = "localhost"; //Name of the Website
$db_id = "root"; //DB login ID
$db_mdp = ""; //DB login PW
$sql = "";

//Connect
$db_handle = mysqli_connect($site, $db_id, $db_mdp);

//Access DB
$db_found = mysqli_select_db($db_handle, $db);

if ($db_found) {
    //echo "Connected to DB <br>";
    if(isset($_POST['SupprimerMedecin'])){
        $Id = $_POST["Id"];
    $sql = "SELECT * FROM medecins WHERE Id='$Id'";
    $res = mysqli_query($db_handle, $sql);
    var_dump($res);
    while ($data = mysqli_fetch_assoc($res)) {
        //$data = une ligne de la table
        //On crée un tableau avec toutes ces lignes
        $Nom = $data["Nom"];
        $Prenom = $data["Prenom"];
    }
        $sql2 = "DELETE FROM medecins WHERE Id='$Id'";
        $sql3 = "DELETE FROM comptes WHERE Nom='$Nom' AND Prenom='$Prenom'";
        $sql4 = "DELETE FROM rdv WHERE NomM='$Nom' AND PrenomM='$Prenom'";
        $sql5 = "DELETE FROM message WHERE NomM='$Nom' AND PrenomM='$Prenom'";
        $res = mysqli_query($db_handle, $sql2);
        $res = mysqli_query($db_handle, $sql3);
        $res = mysqli_query($db_handle, $sql4);
        $res = mysqli_query($db_handle, $sql5);

    }elseif(isset($_POST['SupprimerLabo'])){
        $Id = $_POST["Id"];
        $sql = "SELECT * FROM labo WHERE Id='$Id'";
    $res = mysqli_query($db_handle, $sql);
    var_dump($res);
    while ($data = mysqli_fetch_assoc($res)) {
        //$data = une ligne de la table
        //On crée un tableau avec toutes ces lignes
        $Nom = $data["Nom"];
    }
        $sql2 = "DELETE FROM labo WHERE Nom='$Nom'";
        $res = mysqli_query($db_handle, $sql2);
        var_dump($res);
    }
} else {
    echo "Unable to connect <br>";
}
//header("Location: Modifier.php");

?>