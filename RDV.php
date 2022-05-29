<?php session_start();
$vars = array($_SESSION["connecte"], $_SESSION["login"], $_SESSION["MDP"]);
$jsvars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);


//Patient
if ($_SESSION["type"] == 1) {
    $NomMedecin = $_SESSION["name2"];
    $NomPatient = $_SESSION["name"];
    $PrenomMedecin = $_SESSION["prenom2"];
    $PrenomPatient = $_SESSION["prenom"];
    //Medecin
} else if ($_SESSION["type"] == 2) {
    $NomMedecin = $_SESSION["name"];
    $NomPatient = $_SESSION["name2"];
    $PrenomMedecin = $_SESSION["prenom"];
    $PrenomPatient = $_SESSION["prenom2"];
}
$nom=$_SESSION["name"];
$prenom=$_SESSION["prenom"];

if (isset($_POST['enter'])){
    if($_POST['name2'] != ""){
        $_SESSION['name2'] = stripslashes(htmlspecialchars($_POST['name2']));
    } else {
        $_POST['name2'] = "";
        echo '<span class="error">Veuillez saisir votre nom</span>';
    }
}



$db = "omnessante"; //Name of DB
$site = "localhost"; //Name of the Website
$db_id = "root"; //DB login ID
$db_mdp = ""; //DB login PW
$var;
$sql = "";
$Date="";
$Heure="";
$repos=""; 
//Connect
//$db_handle = mysqli_connect($site, $db_id, $db_mdp, $db, $port);
$db_handle = mysqli_connect($site, $db_id, $db_mdp);

//var_dump($db_handle);

//Access DB
$db_found = mysqli_select_db($db_handle,$db);

//var_dump($db_found);


$rdv[]="";

if (isset($_POST["Id"])) {
    $Id = $_POST["Id"];
    $_SESSION["Id"] = $_POST["Id"];
 
   
} else {
    $Id = $_SESSION["Id"];
}

if($db_found){
    //echo "Connected to DB <br>";
    
       

//Patient
if($_SESSION["type"]==1){
    $sql = "SELECT * FROM rdv WHERE NomP='$NomPatient' AND PrenomP='$PrenomPatient'";    //Medecin
    }else if($_SESSION["type"]==2){
        $sql = "SELECT * FROM rdv WHERE NomM='$NomMedecin' AND PrenomM='$PrenomMedecin'";
    }

        $res = mysqli_query($db_handle, $sql);
        //var_dump($res);
 
        while($data = mysqli_fetch_assoc($res))
        {
            //var_dump($data);
            //$data = une ligne de la table
            //On crée un tableau avec toutes ces lignes
            $rdv[]=$data;
        
        }  
        if($_SESSION["type"]==2){  
        $sql = "SELECT Repos FROM medecins WHERE Nom='$NomMedecin' AND Prenom='$PrenomMedecin'";
        $res = mysqli_query($db_handle, $sql);
       // var_dump($res);
 
        while($data = mysqli_fetch_assoc($res))
        {
           
            //$data = une ligne de la table
            //On crée un tableau avec toutes ces lignes
            $repos=$data['Repos'];
        
        }   
    }   
       // var_dump($repos);
        
       if (isset($_GET["Bouton"])) {
        $Bouton = $_GET["Bouton"];
            $rest = substr($Bouton, -2); 
    if(is_numeric($rest))
    {
    $Heure=$rest;
    $Date=substr($Bouton,0,-2);
    }
    else{
    $Heure=substr($Bouton, -1);
    $Date=substr($Bouton,0, -1);
    }

    foreach($rdv as $elem )
    {
      
    if($elem!=""){
    if($elem["Date"]==$Date && $elem["Heure"]==$Heure)
    {
    $rdvclick=$elem;
    $_SESSION["rdv"]=$rdvclick;
    }}
    }
    
    
    } else {
    
        $Bouton = "";
    }
        //<?php echo $var["Date"].$var["Heure"]
        //var_dump($Compte);
        if (isset($_GET["supr"])) {
            $supr = $_GET["supr"];
            if(isset($_SESSION["rdv"]))
            {
                $rdvclick=$_SESSION["rdv"];
            }
        
        if($supr && isset($rdvclick))
        {

            $Date2=$rdvclick["Date"];
            $PrenomMedecin2=$rdvclick["PrenomM"];
           $NomMedecin2=$rdvclick["NomM"];
            $NomPatient2=$rdvclick["NomP"];
          $PrenomPatient2=$rdvclick["PrenomP"];
           $Heure2=$rdvclick["Heure"];
            $sql="DELETE FROM rdv WHERE Date='$Date2' AND Heure='$Heure2' AND PrenomP='$PrenomPatient2' AND NomP='$NomPatient2' AND NomM='$NomMedecin2' AND PrenomM='$PrenomMedecin2'";
            $res = mysqli_query($db_handle, $sql);
          
            
        }
       header("Location:RDV.php");
    }
}
else{
    echo "Unable to connect <br>";
}

function loginForm()
{
    $sent = false;
    echo
    '<div id="loginform">
<p>Avec qui voulez-vous communiquer</p>
<form action="CommuniquerRDV.php" method="post">
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
    <link rel="stylesheet" href="chat.css" />
    <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon"
        href="https://www.omneseducation.com/app/themes/inseec-group/favicon.ico">
    <script src="script.js">
    </script>
    
    <script>
        function RDV(clicked_id) {
window.location="RDV.php?Bouton="+clicked_id;
        
        }
        
        
    </script>
</head>

<body>
<section class="presentation">
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
        </div>
    </section>
    
    <section>


        <div id="loginchat"> 

            <?php
                       
                            loginForm();
                        ?>

        </div>

        <div id="tableau" style="color:black">
            <table border="colapse">
                <tr bgcolor="grey">

                    <th width="50px">Lundi 06/06</th>
                    <th width="50px">Mardi 07/06</th>
                    <th width="50px">Mercredi 08/06</th>
                    <th width="50px">Jeudi 09/06</th>
                    <th width="50px">Vendredi 10/06</th>
                    <th width="50px">Samedi 11/06</th>
                    <th width="50px">Dimanche 12/06</th>
                </tr>

                <tr>

                    <td>
                        <input id="lundi8" type="button" value="8h-9h" onclick="RDV(this.id)  " class="lundi">
                    </td>
                    <td><input id="mardi8" type="button" value="8h-9h" onclick="RDV(this.id)" class="mardi">
                    </td>
                    <td><input id="mercredi8" type="button" value="8h-9h" onclick="RDV(this.id)" class="mercredi">
                    </td>
                    <td><input id="jeudi8" type="button" value="8h-9h" onclick="RDV(this.id)" class="jeudi">
                    </td>
                    <td><input id="vendredi8" type="button" value="8h-9h" onclick="RDV(this.id)" class="vendredi">
                    </td>
                    <td><input id="samedi8" type="button" value="8h-9h" onclick="RDV(this.id)" class="samedisamedi">
                    </td>
                    <td><input id="dimanche8" type="button" value="8h-9h" onclick="RDV(this.id)" class="dimanche">
                    </td>

                </tr>

                <tr>

                    <td> <br><input id="lundi9" type="button" value="9h-10h" onclick="RDV(this.id)" class="lundi">
                    </td>
                    <td><br><input id="mardi9" type="button" value="9h-10h" onclick="RDV(this.id)" class="mardi">
                    </td>
                    <td> <br><input id="mercredi9" type="button" value="9h-10h" onclick="RDV(this.id)" class="mercredi">
                    </td>
                    <td> <br><input id="jeudi9" type="button" value="9h-10h" onclick="RDV(this.id)" class="jeudi">
                    </td>
                    <td> <br><input id="vendredi9" type="button" value="9h-10h" onclick="RDV(this.id)" class="vendredi">
                    </td>
                    <td> <br><input id="samedi9" type="button" value="9h-10h" onclick="RDV(this.id)" class="samedi">
                    </td>
                    <td> <br><input id="dimanche9" type="button" value="9h-10h" onclick="RDV(this.id)" class="dimanche">
                    </td>
                </tr>

                <tr>

                    <td><br><input id="lundi10" type="button" value="10h-11h" onclick="RDV(this.id)" class="lundi">
                    </td>
                    <td> <br><input id="mardi10" type="button" value="10h-11h" onclick="RDV(this.id)" class="mardi">
                    </td>
                    <td> <br><input id="mercredi10" type="button" value="10h-11h" onclick="RDV(this.id)"
                            class="mercredi">
                    </td>
                    <td> <br><input id="jeudi10" type="button" value="10h-11h" onclick="RDV(this.id)" class="jeudi">
                    </td>
                    <td> <br><input id="vendredi10" type="button" value="10h-11h" onclick="RDV(this.id)"
                            class="vendredi">
                    </td>
                    <td><br><input id="samedi10" type="button" value="10h-11h" onclick="RDV(this.id)" class="samediv">
                    </td>
                    <td> <br><input id="dimanche10" type="button" value="10h-11h" onclick="RDV(this.id)"
                            class="dimanche">
                    </td>
                </tr>

                <tr>

                    <td> <br><input id="lundi11" type="button" value="11h-12h" onclick="RDV(this.id)" class="lundi">
                    </td>
                    <td> <br><input id="mardi11" type="button" value="11h-12h" onclick="RDV(this.id)" class="mardi">
                    </td>
                    <td> <br><input id="mercredi111" type="button" value="11h-12h" onclick="RDV(this.id)"
                            class="mercredi">
                    </td>
                    <td><br><input id="jeudi11" type="button" value="11h-12h" onclick="RDV(this.id)" class="jeudi">
                    </td>
                    <td> <br><input id="vendredi11" type="button" value="11h-12h" onclick="RDV(this.id)"
                            class="vendredi">
                    </td>
                    <td> <br><input id="samedi11" type="button" value="11h-12h" onclick="RDV(this.id)" class="samedi">
                    </td>
                    <td> <br><input id="dimanche11" type="button" value="11h-12h" onclick="RDV(this.id)"
                            class="dimanche">
                    </td>
                </tr>



                <td><input id="lundi14" type="button" value="14h-15h" onclick="RDV(this.id)" class="lundi">
                </td>
                <td> <input id="mardi14" type="button" value="14h-15h" onclick="RDV(this.id)" class="mardi">
                </td>
                <td><input id="mercredi14" type="button" value="14h-15h" onclick="RDV(this.id)" class="mercredi">
                </td>
                <td><input id="jeudi14" type="button" value="14h-15h" onclick="RDV(this.id)" class="jeudi">
                </td>
                <td><input id="vendredi14" type="button" value="14h-15h" onclick="RDV(this.id)" class="vendredi">
                </td>
                <td><input id="samedi14" type="button" value="14h-15h" onclick="RDV(this.id)" class="samedi">
                </td>
                <td><input id="dimanche14" type="button" value="14h-15h" onclick="RDV(this.id)" class="dimanche">
                </td>
                </tr>

                <tr>

                    <td><input id="lundi15" type="button" value="15h-16h" onclick="RDV(this.id)" class="lundi">
                    </td>
                    <td> <input id="mardi15" type="button" value="15h-16h" onclick="RDV(this.id)" class="mardi">
                    </td>
                    <td> <input id="mercredi15" type="button" value="15h-16h" onclick="RDV(this.id)" class="mercredi">
                    </td>
                    <td><input id="jeudi15" type="button" value="15h-16h" onclick="RDV(this.id)" class="jeudi">
                    </td>
                    <td><input id="vendredi15" type="button" value="15h-16h" onclick="RDV(this.id)" class="vendredi">
                    </td>
                    <td><input id="samedi15" type="button" value="15h-16h" onclick="RDV(this.id)" class="samedi">
                    </td>
                    <td><input id="dimanche15" type="button" value="15h-16h" onclick="RDV(this.id)" class="dimanche">
                    </td>
                </tr>
                <tr>



                <tr>

                    <td><br><input id="lundi16" type="button" value="16h-17h" onclick="RDV(this.id)" class="lundi">
                    </td>
                    <td> <br><input id="mardi16" type="button" value="16h-17h" onclick="RDV(this.id)" class="mardi">
                    </td>
                    <td><br><input id="mercredi16" type="button" value="16h-17h" onclick="RDV(this.id)"
                            class="mercredi">
                    </td>
                    <td> <br><input id="jeudi16" type="button" value="16h-17h" onclick="RDV(this.id)" class="jeudi">
                    </td>
                    <td> <br><input id="vendredi16" type="button" value="16h-17h" onclick="RDV(this.id)"
                            class="vendredi">
                    </td>
                    <td><br><input id="samedi16" type="button" value="16h-17h" onclick="RDV(this.id)" class="samedi">
                    </td>
                    <td><br><input id="dimanche16" type="button" value="16h-17h" onclick="RDV(this.id)"
                            class="dimanche">
                    </td>
                </tr>

                <tr>

                    <td> <br><input id="lundi17" type="button" value="17h-18h" onclick="RDV(this.id)" class="lundi">
                    </td>
                    <td><br><input id="mardi17" type="button" value="17h-18h" onclick="RDV(this.id)" class="mardi">
                    </td>
                    <td> <br><input id="mercredi17" type="button" value="17h-18h" onclick="RDV(this.id)"
                            class="mercredi">
                    </td>
                    <td> <br><input id="jeudi17" type="button" value="17h-18h" onclick="RDV(this.id)" class="jeudi">
                    </td>
                    <td> <br><input id="vendredi17" type="button" value="17h-18h" onclick="RDV(this.id)"
                            class="vendredi">
                    </td>
                    <td><br><input id="samedi17" type="button" value="17h-18h" onclick="RDV(this.id)" class="samedi">
                    </td>
                    <td><br><input id="dimanche17" type="button" value="17h-18h" onclick="RDV(this.id)"
                            class="dimanche">
                    </td>
                </tr>
            </table>
            </form>
          
<section>
 
        <?php
if (isset($_GET["Bouton"])) {
echo $rdvclick["Date"];
echo $rdvclick["Heure"];
echo $rdvclick["PrenomM"];
echo $rdvclick["NomM"];
echo $rdvclick["NomP"];
echo $rdvclick["PrenomP"];

?>

<input type="button" value="Supprimer" onclick="window.location='RDV.php?supr=true'">
<?php
}

?>

</section>

            <?php
  foreach($rdv as $var):
        
             ?>
            <script type="text/javascript">
                document.getElementById("<?php echo $var["Date"].$var["Heure"]?>").style.backgroundColor = "Red";
                
                var elements = document.getElementsByClassName("<?php echo $repos?>");
                for (i = 0; i < elements.length; i++) {
                    elements[i].style.backgroundColor = "white";
                    elements[i].disabled = true;

                }
                var elements = document.getElementsByClassName("dimanche");
                for (i = 0; i < elements.length; i++) {
                    elements[i].style.backgroundColor = "white";
                    elements[i].disabled = true;

                }
            </script>

            <?php endforeach ; ?>


        </div>
    </section>





    <section class="footerRDV">
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