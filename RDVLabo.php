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
$var;
$sql = "";
$Date = "";
$Heure = "";
$repos = "";

if (isset($_POST["Id"])) {
  $Id = $_POST["Id"];
  $_SESSION["Id"] = $_POST["Id"];
} else {
  $Id = $_SESSION["Id"];
}
var_dump($Id);
//Connect
//$db_handle = mysqli_connect($site, $db_id, $db_mdp, $db, $port);
$db_handle = mysqli_connect($site, $db_id, $db_mdp);

//var_dump($db_handle);

//Access DB
$db_found = mysqli_select_db($db_handle, $db);

//var_dump($db_found);
$nomLabo = "";
$nomPatient = "";

$rdv[] = "";


if ($db_found) {
  //echo "Connected to DB <br>";

  $sql = "SELECT Nom FROM labo WHERE Id='$Id'";
  $res = mysqli_query($db_handle, $sql);
  //var_dump($res);

  while ($data = mysqli_fetch_assoc($res)) {
    //var_dump($data);
    //$data = une ligne de la table
    //On crée un tableau avec toutes ces lignes
    // $med=$data;

    $nomLabo = $data["Nom"];
  }
  // $test=$data["Nom"];
  $nomPatient = $_SESSION["name"];
  $sql = "SELECT * FROM rdv WHERE NomM='$nomLabo'";
  $res = mysqli_query($db_handle, $sql);
  //var_dump($res);

  while ($data = mysqli_fetch_assoc($res)) {
    //var_dump($data);
    //$data = une ligne de la table
    //On crée un tableau avec toutes ces lignes
    $rdv[] = $data;
  }

  // var_dump($repos);

  //<?php echo $var["Date"].$var["Heure"]
  //var_dump($Compte);
} else {
  echo "Unable to connect <br>";
}
?>

<!DOCTYPE html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Calendrier</title>
  <link href="OMNESSante.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="script.js"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript">
    function RDV(clicked_id) {


      var choix = confirm("Validez vous ce rdv ?");

      if (choix) {


        // $but=clicked_id;

        window.location = "Paiement.php?Bouton=" + clicked_id + "&Id=" + <?php echo $Id ?>;
      } else {
        alert("Non");
      }

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

  <section class="lesMedecins">
    <div id="section" style="color:black">
    <h2>Choisissez vos horaires:</h2>
      <table border="colapse">
        <tr bgcolor="grey">

          <th width="150">Lundi 06/06</th>
          <th width="150">Mardi 07/06</th>
          <th width="150">Mercredi 08/06</th>
          <th width="150">Jeudi 09/06</th>
          <th width="150">Vendredi 10/06</th>
          <th width="150">Samedi 11/06</th>
          <th width="150">Dimanche 12/06</th>
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
          <td> <br><input id="mercredi10" type="button" value="10h-11h" onclick="RDV(this.id)" class="mercredi">
          </td>
          <td> <br><input id="jeudi10" type="button" value="10h-11h" onclick="RDV(this.id)" class="jeudi">
          </td>
          <td> <br><input id="vendredi10" type="button" value="10h-11h" onclick="RDV(this.id)" class="vendredi">
          </td>
          <td><br><input id="samedi10" type="button" value="10h-11h" onclick="RDV(this.id)" class="samediv">
          </td>
          <td> <br><input id="dimanche10" type="button" value="10h-11h" onclick="RDV(this.id)" class="dimanche">
          </td>
        </tr>

        <tr>

          <td> <br><input id="lundi11" type="button" value="11h-12h" onclick="RDV(this.id)" class="lundi">
          </td>
          <td> <br><input id="mardi11" type="button" value="11h-12h" onclick="RDV(this.id)" class="mardi">
          </td>
          <td> <br><input id="mercredi111" type="button" value="11h-12h" onclick="RDV(this.id)" class="mercredi">
          </td>
          <td><br><input id="jeudi11" type="button" value="11h-12h" onclick="RDV(this.id)" class="jeudi">
          </td>
          <td> <br><input id="vendredi11" type="button" value="11h-12h" onclick="RDV(this.id)" class="vendredi">
          </td>
          <td> <br><input id="samedi11" type="button" value="11h-12h" onclick="RDV(this.id)" class="samedi">
          </td>
          <td> <br><input id="dimanche11" type="button" value="11h-12h" onclick="RDV(this.id)" class="dimanche">
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
          <td><br><input id="mercredi16" type="button" value="16h-17h" onclick="RDV(this.id)" class="mercredi">
          </td>
          <td> <br><input id="jeudi16" type="button" value="16h-17h" onclick="RDV(this.id)" class="jeudi">
          </td>
          <td> <br><input id="vendredi16" type="button" value="16h-17h" onclick="RDV(this.id)" class="vendredi">
          </td>
          <td><br><input id="samedi16" type="button" value="16h-17h" onclick="RDV(this.id)" class="samedi">
          </td>
          <td><br><input id="dimanche16" type="button" value="16h-17h" onclick="RDV(this.id)" class="dimanche">
          </td>
        </tr>

        <tr>

          <td> <br><input id="lundi17" type="button" value="17h-18h" onclick="RDV(this.id)" class="lundi">
          </td>
          <td><br><input id="mardi17" type="button" value="17h-18h" onclick="RDV(this.id)" class="mardi">
          </td>
          <td> <br><input id="mercredi17" type="button" value="17h-18h" onclick="RDV(this.id)" class="mercredi">
          </td>
          <td> <br><input id="jeudi17" type="button" value="17h-18h" onclick="RDV(this.id)" class="jeudi">
          </td>
          <td> <br><input id="vendredi17" type="button" value="17h-18h" onclick="RDV(this.id)" class="vendredi">
          </td>
          <td><br><input id="samedi17" type="button" value="17h-18h" onclick="RDV(this.id)" class="samedi">
          </td>
          <td><br><input id="dimanche17" type="button" value="17h-18h" onclick="RDV(this.id)" class="dimanche">
          </td>
        </tr>
      </table>
      </form>

      <?php
      foreach ($rdv as $var) :

      ?>
        <script type="text/javascript">
          document.getElementById("<?php echo $var["Date"] . $var["Heure"] ?>").style.backgroundColor = "Red";
          document.getElementById("<?php echo $var["Date"] . $var["Heure"] ?>").disabled = true;
        </script>

      <?php endforeach; ?>
      <script type="text/javascript">
        var elements = document.getElementsByClassName("dimanche");
        for (i = 0; i < elements.length; i++) {
          elements[i].style.backgroundColor = "white";
          elements[i].disabled = true;

        }
      </script>


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