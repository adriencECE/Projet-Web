<?php
session_start();
$vars = array($_SESSION["connecte"], $_SESSION["login"], $_SESSION["MDP"]);
$jsvars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
//Connection
//echo "Connecting to DB <br>";


$db = "omnessante"; //Name of DB
$site = "localhost"; //Name of the Website
$db_id = "root"; //DB login ID
$db_mdp = ""; //DB login PW
if (isset($_POST["Id"])) {
    $Id = $_POST["Id"];
    $_SESSION["Id"] = $_POST["Id"];
} else {
    $Id = $_SESSION["Id"];
}
$sql = "";

//Connect
$db_handle = mysqli_connect($site, $db_id, $db_mdp);

//Access DB
$db_found = mysqli_select_db($db_handle, $db);

if ($db_found) {}

?>
<html>

<head>
    <title>OMNES Sant&eacute;-Accueil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon" href="https://www.omneseducation.com/app/themes/inseec-group/favicon.ico">
    <script type="text/javascript" src="script.js"></script>
</head>


<body>

   

    <section class="ajouterMedecin">
        <div id="section">
            <form method="post" action="TraitementNvMedecin.php">
            <label>Login:</label>
                <input type="text" name="Login" />
                <label>MDP:</label>
                <input type="text" name="MDP" />
                <label>Nom:</label>
                <input type="text" name="Nom" />
                <label>Prenom:</label>
                <input type="text" name="Prenom" />
                <label>Specialite:</label>
                <input type="text" name="Specialite" />
                <label>Salle</label>
                <input type="text" name="Salle" />
                <label>Tel:</label>
                <input type="number" name="Tel" />
                <label>Mail:</label>
                <input type="text" name="Mail" /> 
                <label>Image:</label>
                <input type="text" name="Image" />
                <label>Repos</label>
                <input type="text" name="Repos" />
                <label>CV:</label><br>
                <input type="text" name="Cv" />
              
                <input type="submit" value="Soumettre" name="medecin"/>
            </form>
        </div>
    </section>
    <section class="ajouterMedecin">
        <div id="section">
            <form method="post" action="TraitementNvMedecin.php">
                <label>Nom:</label>
                <input type="text" name="Nom" />
                <label>Service:</label>
                <input type="text" name="Service" />
                <label>Salle</label>
                <input type="text" name="Salle" />
                <label>Tel:</label>
                <input type="number" name="Tel" />
                <label>Mail:</label>
                <input type="text" name="Mail" /> 
                <input type="submit" value="Soumettre" name="labo" />
            </form>
        </div>
    </section>
    <section class="footerAcceuil">
        <a id="footer"></a>
        <div class="footer container">
            <div id="footer">
                <a>Copyright &copy; 2022, OMNES Sant&eacute;<br></a>
                <a href="mailto:OMNES.sante@gmail.com">OMNES.sante@gmail.com</a>
            </div>
        </div>
    </section>

</body>

</html>