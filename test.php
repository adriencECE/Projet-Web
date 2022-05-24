


<!DOCTYPE html>
<html>
<head>
    <title>Prime Properties :: Contact</title>
    <meta charset="utf-8" />
    <link href="format.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
    

<?php 

$fichier = 'testo.xml';
$contenu = simplexml_load_file($fichier);


foreach ($contenu as $donnee) {
    
    echo '<br><center><h1>'.$donnee->nom.' '.$donnee->prenom.'</h1></center><br><br>';
echo '<div id="rightcolumn">';
    echo'<h3><u>Expérience professionelle</u></h3><br>';
    echo '<i>'.$donnee->debut.'</i><br>'.$donnee->poste.'<br>'.$donnee->lieu.'<br>'.$donnee->description.'<br>'.$donnee->desc.'<br><br>';
    echo '<i>'.$donnee->debutd.'</i><br>'.$donnee->posted.'<br>'.$donnee->lieud.'<br>'.$donnee->descriptiond.'<br>'.$donnee->descd.'<br>';
    echo '<h3><u>Formation</h3></u>'.$donnee->diplome.'<br>'.$donnee->universite.'<br>';
    echo '</div>';

    echo '<div id="leftcolumn">' ;
    ?>
<img class="image" src="<?php echo $donnee->photo;?>" ></img>
<?php
echo'<u><h3>Information</h3></u><br><u>Adresse:</u> '.$donnee->adresse.'<br><br><u>Téléphone:</u> '.$donnee->tel.'<br><br><u>Mail:</u> '.$donnee->mail.'<br>';
   
    echo'<br><br> <h3><u> Compétences </u></h3><br>';
    echo '<li>'.$donnee->un.'</li><br>';
    echo '<li>'.$donnee->deux.'</li><br>';
    echo '<li>'.$donnee->trois.'</li><br>';
    echo '<li>'.$donnee->quatre.'</li><br>';
    echo '</div>';
    

}
?>



</body>
</html>