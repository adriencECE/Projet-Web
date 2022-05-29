<?php session_start();
$vars = array($_SESSION["connecte"], $_SESSION["login"], $_SESSION["MDP"]);
$jsvars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);


$db = "omnessante"; //Name of DB
$site = "localhost"; //Name of the Website
$db_id = "root"; //DB login ID
$db_mdp = ""; //DB login PW
$sql = "";
if($_SESSION["type"]==1){
    $NomPatient=$_SESSION["name"];
    $PrenomPatient = $_SESSION["prenom"];
    $NomMedecin=$_SESSION["name2"];
    $PrenomMedecin = $_SESSION["prenom2"];
    //Medecin
    }else if($_SESSION["type"]==2){
    $NomMedecin=$_SESSION["name"];
    $PrenomMedecin = $_SESSION["prenom"];
    $NomPatient=$_SESSION["name2"];
    $PrenomPatient = $_SESSION["prenom2"];
    }
 
$text;
$sent;
if(isset($_GET["text"])){
    $text = $_GET["text"];
    $sent = $_GET["sent"];
}
else{
    $text = "erreur";
    $sent = false;
}

//Si aucun message envoye on recupere les anciens
if($sent==false){
    //Connect
    $db_handle = mysqli_connect($site, $db_id, $db_mdp);

//Access DB
$db_found = mysqli_select_db($db_handle, $db);
$messages;
if ($db_found) {
    //echo "Connected to DB <br>";
    $sql = "SELECT * FROM message WHERE NomM='$NomMedecin' AND NomP='$NomPatient'";
    $res = mysqli_query($db_handle, $sql);
    while ($data = mysqli_fetch_assoc($res)) {
        //$data = une ligne de la table
        //On crée un tableau avec toutes ces lignes
        $messages[] = $data;
    }

    // Charger les anciens messages entre les 2 personnes dans la BDD
    $myfile = fopen(__DIR__ . "/log.html", "a") or die("Impossible d'ouvrir le fichier!" . __DIR__ . "/log.html");
    ftruncate($myfile, 0);
    if(isset($messages)){
        foreach($messages as $mess){
            $loaded_message = "<div class='msgln'> <b class='username'>".$mess['envoyeur']."</b> ".stripslashes(htmlspecialchars($mess['Message']))."<br></div>";
        fwrite($myfile, $loaded_message);
    }
    fclose($myfile);
    }
    

} else {
    echo "Unable to connect <br>";
}
//Si un message est envoye on l'ajoute a la BDD
}else{
    $db_handle = mysqli_connect($site, $db_id, $db_mdp);
    //Access DB
    $db_found = mysqli_select_db($db_handle, $db);
    if ($db_found && $sent==true) {
        //echo "Connected to DB <br>";
        $sql = "INSERT INTO message (NomM, PrenomM, NomP, PrenomP, Type, Message, envoyeur) 
                VALUES ('$NomMedecin', '$PrenomMedecin', '$NomPatient', '$PrenomPatient', '1', '$text','$NomPatient')";
        $res = mysqli_query($db_handle, $sql);
    } else {
        echo "Unable to connect <br>";
    }
}

if (isset($_GET['logout'])){

    //Message de sortie simple
    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>" .
    $_SESSION['name'] . "</b> a quitté la session de chat.</span><br></div>";

    $_SESSION['name2']="";

    $myfile = fopen(__DIR__ . "/log.html", "a") or die("Impossible d'ouvrir le fichier!" . __DIR__ . "/log.html");
    fwrite($myfile, $logout_message);
    ftruncate($myfile, 0);
    fclose($myfile);
    header("Location: RDV.php"); //Rediriger l'utilisateur
 }
$existant=false;
if (isset($_POST['enter'])){
   
    if($_POST['name2'] != ""){
        $Nom=$_POST["name2"];
        $sql="SELECT Nom FROM comptes";
        $res = mysqli_query($db_handle, $sql);
      
        while ($data = mysqli_fetch_assoc($res)) {
            //$data = une ligne de la table
            //On crée un tableau avec toutes ces lignes
            $comptes[] = $data;
        }
        
        foreach($comptes as $var)
        
        {if($var["Nom"]==$Nom)
            {
                echo $var["Nom"];
                $existant=true;
                $_SESSION['name2'] = stripslashes(htmlspecialchars($_POST['name2']));
                header("Location:CommuniquerRDV.php");
            }
        }
        if($existant==false)
        {header("Location:RDV.php");
        }    }
    else{

        header("Location:RDV.php");
        $_POST['name2']="";
        echo '<span class="error">Veuillez saisir votre nom</span>';
    }
}

?>

<html>

<head>
    <title>OMNES Sant&eacute;-Rendez-Vous</title>
    
    <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="chat2.css" />
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
        
            <div id="chatWrapper">
                <div id="menu">
                    <p class="welcome">Communiquer avec Dr. <b>
                            <?php echo $_SESSION['name2']; ?>
                        </b></p>
                    <p class="logout"><a id="exit" href="#">Quitter la conversation</a></p>
                </div>
                <div id="chatbox">
                    <?php
                    if(file_exists("log.html") && filesize("log.html") > 0){
                    $contents = file_get_contents("log.html");
                    echo $contents;
                    }
                    ?>
                </div>
                <form id="formChat" name="message" action="">
                    <input name="usermsg" type="text" id="usermsg" />
                    <input name="submitmsg" type="submit" id="submitmsg" value="Envoyer" />
                </form>
            </div>
        </div>
        <div id="footer">Copyright &copy; 2022, OMNES Sant&eacute;<br>
            <a href="mailto:OMNES.sante@gmail.com">OMNES.sante@gmail.com</a>
        </div>
    </div>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        // jQuery Document
        
        $(document).ready(function () {
            $("#submitmsg").click(function () {
                var clientmsg = $("#usermsg").val();
                $.post("post.php", { text: clientmsg });
                window.location.href="CommuniquerRDV.php?text="+clientmsg+"&sent=true";
                $("#usermsg").val("");

                return false;
            });
            function loadLog() {
                var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Hauteur de défilement avant la requête
                $.ajax({
                    url: "log.html",
                    cache: false,
                    success: function (html) {
                        $("#chatbox").html(html); //Insérez le log de chat dans la #chatbox div
                        //Auto-scroll
                        var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Hauteur de défilement apres la requête
                        if (newscrollHeight > oldscrollHeight) {
                            $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Défilement automatique
                        }
                    }
                });
            }
            setInterval(loadLog, 2500);
            $("#exit").click(function () {
                var exit = confirm("Voulez-vous vraiment mettre fin à la conversation ?");
                if (exit == true) {
                    window.location = "RDV.php?logout=true";
                }
            });
        });


    </script>
</body>

</html>