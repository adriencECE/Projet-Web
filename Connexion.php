<?php
//Connection
//echo "Connecting to DB <br>";

$db = "omnessante"; //Name of DB
$site = "localhost"; //Name of the Website
$db_id = "root"; //DB login ID
$db_mdp = ""; //DB login PW
$var;
$sql = "";

if(isset($_POST["login"])){
    $login=$_POST["login"];
}
else{
    $login = "";
}
if(isset($_POST["MDP"])){
    $MDP=$_POST["MDP"];
}
else{
    $MDP = "";
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

        $sql = "SELECT * FROM compte WHERE 'login'="$login" AND 'MDP'="$MDP"";

   
    
        
        $res = mysqli_query($db_handle, $sql);
        //var_dump($res);
 
        while($data = mysqli_fetch_assoc($res))
        {
            //$data = une ligne de la table
            //On crée un tableau avec toutes ces lignes
            $Compte=$data;
        }
  
}
else{
    echo "Unable to connect <br>";
}
?>

<html>

<head>
    <title>OMNES Sant&eacute;-Connexion</title>
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
            <form method="post" action="Connexion.php">
                <input type="radio" name="Personne" value="Patient">
                <input type="radio" name="Personne" value="Medecin">
                <input type="radio" name="Personne" value="Admin">
                <label>Login:</label>
                <input type="text" name="login"><br>
                <label>Mot de Passe:</label>
                <input type="text" name="MDP"><br>
                <input type="submit" name="Connexion" value="Connexion"><br>
                <label>Pas de compte?</label><br>
                <input type="submit" name="Inscription" value="Inscription">
            </form>
        </div>
        <div id="footer">Copyright &copy; 2022, OMNES Sant&eacute;<br>
            <a href="mailto:OMNES.sante@gmail.com">OMNES.sante@gmail.com</a>
        </div>
    </div>
</body>

</html>