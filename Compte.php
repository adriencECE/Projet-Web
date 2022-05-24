<?php
    session_start();
    $vars = array($_SESSION["connecte"], $_SESSION["login"], $_SESSION["MDP"]);
    $jsvars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);

    $db = "omnessante"; //Name of DB
    $site = "localhost"; //Name of the Website
    $db_id = "root"; //DB login ID
    $db_mdp = ""; //DB login PW
    $sql = "";
    $login = $_SESSION["login"];
    $MDP = $_SESSION["MDP"];
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
                $Nom = $data["Nom"];
                $Prenom = $data["Prenom"];
                $Type = $data["Type"];
            }   
            if(isset($Compte) && $Type == 1){
                $sql = "SELECT * FROM patient WHERE Nom='$Nom' AND Prenom='$Prenom'";
            $res = mysqli_query($db_handle, $sql);
            //var_dump($res);
     
                while($data = mysqli_fetch_assoc($res))
                {
                    $Patient=$data;
                } 
            }  
            else if(isset($Compte) && $Type == 2){
                $sql = "SELECT * FROM medecins WHERE Nom='$Nom' AND Prenom='$Prenom'";
            $res = mysqli_query($db_handle, $sql);
            //var_dump($res);
     
                while($data = mysqli_fetch_assoc($res))
                {
                    $Medecin=$data;
                } 
            } 
            else if(isset($Compte) && $Type == 3){
                $sql = "SELECT * FROM comptes WHERE Nom='$Nom' AND Prenom='$Prenom'";
            $res = mysqli_query($db_handle, $sql);
            //var_dump($res);
     
                while($data = mysqli_fetch_assoc($res))
                {
                    $Admin=$data;
                } 
            }    
            //var_dump($Compte);
    }
    else{
        echo "Unable to connect <br>";
    }



?>
<html>

<head>
    <title>OMNES Sant&eacute;-Compte</title>
    <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon"
        href="https://www.omneseducation.com/app/themes/inseec-group/favicon.ico">
        <script src="script.js">  
        
        </script>
</head>

<body>
    <div id="wrapper">
    <div id="header">
            <div id="nav">
                <img src="omnessante.png" class="logo">
                <div class="header-right">

                    <a href="Accueil.php" data-after="Accueil">Accueil </a>
                    <!--<input type="button" name="Accueil" value="Accueil">
                    </a>-->
                    <a href="ToutParcourir.php" data-after="ToutParcourir">Parcourir </a>
                    <!--<input type="button" name="Parcourir" value="Tout Parcourir">
                    </a>-->
                    <a href="Accueil.php" data-after="Acc" id="btn1">Modif </a>
                    <!--<input type="button" name="Modifier" value="Modifier" id="btn1">
                    </a>-->
                    <a href="Compte.php" data-after="Compte" id="btn2">Compte </a>
                    <!--<input type="button" name="Compte" value="Compte" id="btn2">
                    </a>-->
                    <!--Modification boutons en fonction du compte connecte-->
                    <?php echo "<script type='text/javascript'>testConnexion1Acc($jsvars)</script>";
                    echo "<script type='text/javascript'>testConnexion2Acc($jsvars)</script>" ?>
                </div>
            </div>
        </div>
        <div id="section">
            Infos Compte <br>
            <?php //var_dump($_SESSION);
            if($Type == 1)//Patient
            {
                echo "Bonjour ".$Patient["Prenom"]." ".$Patient["Nom"]."<br>";
                echo "Mail: ".$Patient["Mail"]."<br>";
                echo "Adresse: ".$Patient["Adresse"];
            }
            else if($Type == 2)//Medecin
            {
                echo "Bonjour Dr. ".$Medecin["Prenom"]." ".$Medecin["Nom"]."<br>";
                echo "Mail: ".$Medecin["Mail"]."<br>";
            }
            else if($Type == 3)//Admin
            {
                echo "Bonjour ".$Admin["Nom"]."<br>";
                echo "Mail: admin@gmail.com"."<br>";
            }
            ?>
            <br>
            <form method="post" action="Accueil.php">
                <input type="submit" name="DeconnexionBtn" value="Deconnexion">
            </form>
            
        </div>
        <div id="footer">Copyright &copy; 2022, OMNES Sant&eacute;<br>
            <a href="mailto:OMNES.sante@gmail.com">OMNES.sante@gmail.com</a>
        </div>
    </div>
</body>

</html>