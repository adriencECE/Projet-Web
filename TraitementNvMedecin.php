<?php
session_start();
//Connection
//echo "Connecting to DB <br>";

$db = "omnessante"; //Name of DB
$site = "localhost"; //Name of the Website
$db_id = "root"; //DB login ID
$db_mdp = ""; //DB login PW
$var;
$sql = "";
$toutRempli = true;
$existant = false;
$inscrit = false;

if(isset($_POST["medecin"])){

    if (isset($_POST["Login"])) {
        $Login = $_POST["Login"];
    } else {
        $toutRempli = false;
        $Login = "";
        echo "log";
    }
    if (isset($_POST["MDP"])) {
        $MDP = $_POST["MDP"];
    } else {
        $toutRempli = false;
        $MDP = "";
        echo "mdp";
    }
if (isset($_POST["Nom"])) {
    $Nom = $_POST["Nom"];
} else {
    $toutRempli = false;
    $Nom = "";
    echo "nom";
}
if (isset($_POST["Prenom"])) {
    $Prenom = $_POST["Prenom"];
} else {
    $toutRempli = false;
    $Prenom = "";
    echo "pre";
}
if (!isset($_POST["Tel"])) {
    $toutRempli = false;
    echo "tel";
} else {
    $Tel = $_POST["Tel"];
}
if (!isset($_POST["Mail"])) {
    $toutRempli = false;
    echo "mai";
} else {
    $Mail = $_POST["Mail"];
}
if (!isset($_POST["Cv"])) {
    $toutRempli = false;
    echo "cv";
} else {
    $Cv= $_POST["Cv"];
}
if (!isset($_POST["Image"])) {
    $toutRempli = false;
    echo "pho";
    
} else {
    $Image = $_POST["Image"];
}
if (!isset($_POST["Repos"])) {
    $toutRempli = false;
    echo "rep";
} else {
    $Repos = $_POST["Repos"];
}
if (!isset($_POST["Specialite"])) {
    $toutRempli = false;
    echo "spe";
} else {
    $Specialite = $_POST["Specialite"];
}
if (!isset($_POST["Salle"])) {
    $toutRempli = false;
    echo "sall";
} else {
    $Salle = $_POST["Salle"];
}

}


elseif(isset($_POST["labo"])){
   
    if (isset($_POST["Nom"])) {
        $Nom = $_POST["Nom"];
    } else {
        $toutRempli = false;
        $Nom = "";
    }
    if (isset($_POST["Service"])) {
        $Service = $_POST["Service"];
    } else {
        $toutRempli = false;
        $Service = "";
    }
    if (!isset($_POST["Tel"])) {
        $toutRempli = false;
    } else {
        $Tel = $_POST["Tel"];
    }
    if (!isset($_POST["Mail"])) {
        $toutRempli = false;
    } else {
        $Mail = $_POST["Mail"];
    }
    if (!isset($_POST["Salle"])) {
        $Salle = false;
    } else {
        $Salle = $_POST["Salle"];
    }
    
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
    

    if ($toutRempli == true) {
        if(isset($_POST["medecin"])){
        $sql = "SELECT * FROM comptes WHERE Login='$Login' AND MDP='$MDP' AND Nom='$Nom' AND Prenom='$Prenom'";
        $res = mysqli_query($db_handle, $sql);
        //var_dump($res);

        while ($data = mysqli_fetch_assoc($res)) {
            //var_dump($data);
            //$data = une ligne de la table
            //On crée un tableau avec toutes ces lignes
            $Compte = $data;
        }
        if (isset($Compte)) {
            $existant = true;
        } else {
            $sql = "INSERT INTO comptes (Nom, Prenom, Type, Login, MDP) VALUES ('$Nom', '$Prenom', '2', '$Login', '$MDP')";
            $res = mysqli_query($db_handle, $sql);
           // return mysqli_query($db_handle, $sql)or die(mysqli_error($db_handle));
            $sql3  = "INSERT INTO medecins (Id,Nom, Prenom, Spe,Salle,Tel, Mail, Image, Repos, CV) 
            VALUES (NULL,'$Nom', '$Prenom','$Specialite','$Salle', '$Tel', '$Mail', '$Image', '$Repos', '$Cv')";
           
            //var_dump($res);
            return mysqli_query($db_handle, $sql3)or die(mysqli_error($db_handle));
            //$res3 = mysqli_query($db_handle, $sql3);
            //var_dump($res);
            $inscrit=true;
        }
    }
    elseif(isset($_POST["labo"])){
        $sql4  = "INSERT INTO labo (Nom, Service,Salle,Tel, Mail) 
        VALUES ('$Nom', '$Service','$Salle', '$Tel', '$Mail')";      
       $res4=mysqli_query($db_handle, $sql4);	
$inscrit=true;
    }


    }


    //var_dump($Compte);
} else {
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
    <?php if ($toutRempli == false) : ?>
        <script type="text/javascript">
            alert("Veuillez remplir tous les champs");
           // window.location = "Ajouter.php";
        </script>

    <?php else : ?>
        <?php if ($existant == false && $inscrit == true) : ?>
            <script type="text/javascript">
                alert("Inscription reussie \nBienvenue");
              //  window.location = "Modifier.php";
            </script>
        <?php endif ?>
    <?php endif ?>
</body>