<?php
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
        $sql = "SELECT * FROM medecins WHERE Id=$Id";
        $res = mysqli_query($db_handle, $sql);
        while($data = mysqli_fetch_assoc($res))
        {
            //$data = une ligne de la table
            //On crée un tableau avec toutes ces lignes
            $Medecin = $data;
            echo $data["Nom"];
        }  
}
else{
    echo "Unable to connect <br>";
}
?>

<html>

<head>
    <title>OMNES Sant&eacute;-Informations M&eacute;decin</title>
    <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon"
        href="https://www.omneseducation.com/app/themes/inseec-group/favicon.ico">
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <div id="logo">
                <img src="https://master-7rqtwti-gxvbzt6usscty.fr-4.platformsh.site//app/uploads/2021/09/Logo-blanc-violet.png"
                    class="custom-logo">
            </div>
        </div>
        <div id="nav">
            <a href="Accueil.html">
                <input type="button" name="Accueil" value="Accueil">
            </a>
            <a href="ToutParcourir.html">
                <input type="button" name="Parcourir" value="Tout Parcourir">
            </a>
            <a href="Accueil.html">
                <input type="button" name="Modifier" value="Modifier">
            </a>
            <a href="Compte.html">
                <input type="button" name="Compte" value="Compte">
            </a>
        </div>
        <div id="section">
            Infos M&eacute;decin <?php echo  $Id?><br>
            <?php echo "Nom: ".$Medecin["Nom"]."  ";
            echo "Prenom :".$Medecin["Prenom"]."  ";
            echo "Specialite :".$Medecin["Spe"]."  ";
            echo "Telephone :".$Medecin["Tel"]."  ";
            echo "Mail :".$Medecin["Mail"]." <br> "; ?>
            <a href="RDV.html">
                <input type="button" name="RDV" value="Prendre un RDV">
            </a>
            <a href="Communiquer.html">
                <input type="button" name="Communiquer" value="Communiquer avec le m&eacute;decin">
            </a>
            <a href="CV.html">
                <input type="button" name="CV" value="Voir son CV">
            </a>
        </div>
        <div id="footer">Copyright &copy; 2022, OMNES Sant&eacute;<br>
            <a href="mailto:OMNES.sante@gmail.com">OMNES.sante@gmail.com</a>
        </div>
    </div>
</body>

</html>