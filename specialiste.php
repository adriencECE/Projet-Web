<?php
//Connection
//echo "Connecting to DB <br>";

$db = "omnessante"; //Name of DB
$site = "localhost"; //Name of the Website
$db_id = "root"; //DB login ID
$db_mdp = ""; //DB login PW
$var;
$sql = "";
if(isset($_POST["spe"])){
    $spe=$_POST["spe"];
}
else{
    $spe = "";
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
    if($spe!=""){
        $sql = "SELECT * FROM medecins WHERE Spe = '$spe'";
    }
    else{
        $sql = "SELECT * FROM medecins WHERE Spe != 'Generaliste'";
    }
        
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
            <form method="post" action="specialiste.php">
            Choisissez une Sp&eacute;cialit&eacute;:<br>
            <input type="radio" name="spe" value="Addictologie" onclick="<?php $spe="Addictologie"?>">
            <label>Addictologie</label>
            <input type="radio" name="spe" value="Andrologie" onclick="<?php $spe="Andrologie"?>">
            <label>Andrologie</label>
            <input type="radio" name="spe" value="Cardiologie" onclick="<?php $spe="Cardiologie"?>">
            <label>Cardiologie</label>
            <input type="radio" name="spe" value="Dermatologie" onclick="<?php $spe="Dermatologie"?>">
            <label> Dermatologie</label>
            <input type="radio" name="spe" value="Gastro-H&eacute;pato-Ent&eacute;rologie " onclick="<?php $spe="GHE"?>">
            <label> Gastro-H&eacute;pato-Ent&eacute;rologie</label>
            <input type="radio" name="spe" value="Gynecologie" onclick="<?php $spe="Gynecologie"?>">
            <label> Gyn&eacute;cologie</label>
            <input type="radio" name="spe" value="IST" onclick="<?php $spe="IST"?>">
            <label> IST</label>
            <input type="radio" name="spe" value="Osth&eacute;opathie" onclick="<?php $spe="Ostheopathie"?>"> 
            <label> Ostheopathie</label>
            <input type="radio" name="spe" value="" onclick="<?php $spe=""?>">
            <label> Tous</label><br>
            <input type="submit" value="Valider">
            </form>
            <?php if(isset($listeSpecialistes)):?>
            <form method="post" action="InfosMedecin.php">
            Liste M&eacute;decins Sp&eacute;cialistes <br>
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
            
            <?php else :?>
                    <p>Il n'y a pas de m&eacute;decin de cette sp&eacute;cialite<br></p>
            <?php endif?>
        </div>
        <div id="footer">Copyright &copy; 2022, OMNES Sant&eacute;<br>
            <a href="mailto:OMNES.sante@gmail.com">OMNES.sante@gmail.com</a>
        </div>
    </div>
</body>

</html>