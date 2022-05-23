<?php
//Connection
//echo "Connecting to DB <br>";

$db = "omnessante"; //Name of DB
$site = "localhost"; //Name of the Website
$db_id = "root"; //DB login ID
$db_mdp = ""; //DB login PW
$var;
$sql = "";
$test="";
//Connect
//$db_handle = mysqli_connect($site, $db_id, $db_mdp, $db, $port);
$db_handle = mysqli_connect($site, $db_id, $db_mdp);

//var_dump($db_handle);

//Access DB
$db_found = mysqli_select_db($db_handle,$db);

//var_dump($db_found);

if($db_found){
    //echo "Connected to DB <br>";
        $sql = "SELECT * FROM medecins WHERE Spe != 'Generaliste'";
        $res = mysqli_query($db_handle, $sql);
        //var_dump($res);
        $listeSpecialistes;
        while($data = mysqli_fetch_assoc($res))
        {
            //$data = une ligne de la table
            //On crée un tableau avec toutes ces lignes
            $listeSpecialistes[]=$data;
        }
   
        
}
else{
    echo "Unable to connect <br>";
}
?>

<html>

<head>
    <title>OMNES Sant&eacute;-Sp&eacute;cialistes</title>
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
            Liste M&eacute;decins G&eacute;n&eacute;ralistes <br>
            <form method="post" action="InfosMedecin.php">
            <ul>
                <!-- Pour chaque médecin Généraliste dans la table-->
                <?php foreach($listeSpecialistes as $Specialiste) :?>
                    <li>
                        <input type="radio" name="Id" value="<?= $Specialiste["Id"]?>" checked>
                        <?php echo $Specialiste["Id"]." ".$Specialiste['Nom']." ".$Specialiste['Prenom']." ".$Specialiste['Spe']?>

                    </li>
                <?php endforeach?>
            </ul>
            <label>Voir les informations du m&eacute;decin s&eacute;lectionn&eacute;:</label>
            <input type="submit" value="Soumettre">
            </form>
        </div>
        <div id="footer">Copyright &copy; 2022, OMNES Sant&eacute;<br>
            <a href="mailto:OMNES.sante@gmail.com">OMNES.sante@gmail.com</a>
        </div>
    </div>
</body>

</html>