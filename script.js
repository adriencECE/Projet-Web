
var connecte = false;
var nomUser = "";
var prenomUser = "";

function connexion(nom, prenom) {
    nomUser = nom;
    prenomUser = prenom;
    connecte = true;
}

function deconnexion() {
    nomUser = "";
    prenomUser = "";
    connecte = false;
}

function test() {


    if (connecte == true) {
        document.getElementById("btn2").setAttribute("value", "Votre Compte");
        if (nomUser == "admin") { document.getElementById("btn1").setAttribute("value", "Modifier");
     }
        else { document.getElementById("btn1").setAttribute("value", "rdv"); }
    }
    else { document.getElementById("btn1").setAttribute("disabled", ""); 
    document.getElementById("btn2").setAttribute("value", "Connexion");}

}

//document.write("nimportequoiet tjr plus");