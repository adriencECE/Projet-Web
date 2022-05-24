


function testConnexion1(vars) {
    
    //alert("ttest1"+vars[0]+" "+vars[1]+" "+vars[2]);
    if (vars[0] == "true") {
        document.getElementById("btn2").setAttribute("value", "Votre Compte");
        
        if (vars[1] == "admin") { 
            document.getElementById("btn1").setAttribute("value", "Modifier");
        }
        else { 
            document.getElementById("btn1").setAttribute("value", "rdv"); 
        }
    }
    else {
        document.getElementById("btn1").setAttribute("disabled", ""); 
        document.getElementById("btn2").setAttribute("value", "Connexion");
    }

}


function testConnexion2(vars) {
    if (vars[0] == "true") {
        document.getElementById("lienCompte").href = "Compte.php"; 
     }
     else {
        document.getElementById("lienCompte").href = "Connexion.php"; 
     }
}
