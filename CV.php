<?php 

$fichier = 'testo.xml';
$contenu = simplexml_load_file($fichier);


foreach ($contenu as $donnee) {
    echo 'Titre : '.$donnee->nom.' | Réalisateur : '.$donnee->prenom.' | Année de sortie : '.$donnee->adresse.'<br>';  
}
?>