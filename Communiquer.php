<?php session_start();
$vars = array($_SESSION["connecte"], $_SESSION["login"], $_SESSION["MDP"]);
$jsvars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);

if (isset($_GET['logout'])){

    //Message de sortie simple
    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>" .
    $_SESSION['name'] . "</b> a quitté la session de chat.</span><br></div>";

    $_SESSION['name2']="";

    $myfile = fopen(__DIR__ . "/log.html", "a") or die("Impossible d'ouvrir le fichier!" . __DIR__ . "/log.html");
    fwrite($myfile, $logout_message);
    fclose($myfile);
    header("Location: RDV.php"); //Rediriger l'utilisateur
 }
if (isset($_POST['enter'])){
    if($_POST['name2'] != ""){
        $_SESSION['name2'] = stripslashes(htmlspecialchars($_POST['name2']));
    }
    else{
        $_POST['name2']="";
        echo '<span class="error">Veuillez saisir votre nom</span>';
    }
}

function loginForm() {
echo
'<div id="loginform">
<p>Avec qui voulez-vous communiquer</p>
<form action="RDV.php" method="post">
<label for="name">Nom: </label>
<input type="text" name="name2" id="name2" />
<input type="submit" name="enter" id="enter" value="Soumettre" />
</form>
</div>';
}

?>

<html>

<head>
    <title>OMNES Sant&eacute;-Rendez-Vous</title>
    <link rel="stylesheet" href="chat2.css" />
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
            <?php
            if ($_SESSION['name2'] == ""){
            loginForm();
            }
            else {
            ?>
        
            <div id="chatWrapper">
                <div id="menu">
                    <p class="welcome">Communiquer avec <b>
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
                var exit = confirm("Voulez-vous vraiment mettre fin à la session ?");
                if (exit == true) {
                    window.location = "RDV.php?logout=true";
                }
            });
        });


    </script>
    <?php } ?>
</body>

</html>