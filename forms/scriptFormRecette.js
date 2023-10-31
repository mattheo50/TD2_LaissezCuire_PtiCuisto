//déclarations de variables
let recherche;
let ListeIngredientAjouteTab = [];
const ajoutIngredient = document.getElementById("ajout_ing_bouton");
let premierIngredient = true;

// fonctions d'autocomplétion du champ de recherche d'ingrédients
$(document).ready(function() {
    $("#ingredient").on("input", function() {
        recherche = document.getElementById("ingredient").value;
        var query = $(this).val();

        if (query !== "") {
            $.ajax({
                url: "autocomplete.php",
                method: "POST",
                data: { query: query },
                success: function(data) {
                    var datalist = $("#Listingredient");
                    datalist.empty();
                    datalist.html(data);
                }
            });
        }
    });
});

//ajout de l'ingrédient entré à la liste pour l'afficher et l'envoyer ensuite en post
ajoutIngredient.addEventListener("click",(event)=>{
    if(!(recherche == undefined)){
        if(premierIngredient == true){
            document.getElementById("ListeIngredientAjoute").innerHTML += recherche;
            document.getElementById("ingredientPost").value += recherche;
            premierIngredient = false;
        }else{
            document.getElementById("ListeIngredientAjoute").innerHTML += (", "+recherche);
            document.getElementById("ingredientPost").value += "/"+recherche;
        }
        ListeIngredientAjouteTab.push(recherche);
        console.log(document.getElementById("ingredientPost").value);
    }
});

//fonction de reset du champ de recherche (empeche les ajouts trop rapide)
function resetbouton(){
    var bouton = document.getElementById("ajout_ing_bouton");
    bouton.value = undefined;
    //chercher a faire plus propre
}