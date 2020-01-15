const buttons = document.querySelectorAll("button");//on ecoute tout les bouttons

for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", function(){ // on ecoute les clics aux bouttons
        
        const joueur = buttons[i].innerHTML;//On va chercher le texte à l'interieure du boutton
        const robot = buttons[Math.floor(Math.random() * buttons.length)].innerHTML;//On va chercher un nombre aux hazar entre 0 et 1 multiplié par la taille du "tableau" et l'arrondire 
        let result= "";
        if (joueur === robot) {
            result = "Egalité";
        }
        else if ((joueur === "Pierre" && robot === "Ciseaux") || joueur === "Feuille" && robot === "Pierre" || (joueur === "Ciseaux" && robot === "Feuille")) {
            result = "Gagné!";
        }
        else {
            result = "Perdu!";
        }

        document.querySelector(".result").innerHTML = `
            Joueur : ${joueur} </br>
            Robot : ${robot} </br>
            ${result}
            `;
        //console.log(result);
        
    });
}