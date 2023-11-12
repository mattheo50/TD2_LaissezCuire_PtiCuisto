//déclarations de variables
let recherche;
let ListeIngredientAjouteTab = [];
let ListeTagAjoutee = [];
const ajoutIngredient = document.getElementById("ajout_ing_bouton");
const ajoutTag = document.getElementById("ajout_tag_bouton");
const TagSelectionee = document.getElementById("tags_recette_form_recette");
const ingredientsListeCachee = document.getElementById("ingredientPost");
const tagListeCachee = document.getElementById("TagPost");
const formCreationRecette = document.querySelector("form");
let premierTag = true;
let premierIngredient = true;

// fonctions d'autocomplétion du champ de recherche d'ingrédients
$(document).ready(function() {
    $("#ingredient").on("input", function() {
        recherche = document.getElementById("ingredient").value;
        var query = $(this).val();

        if (query !== "") {
            $.ajax({
                url: "model/autocomplete.php",
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
    }
});

ajoutTag.addEventListener("click",(event)=>{
     if(ListeTagAjoutee.indexOf(TagSelectionee.value) < 0){
        if(premierTag == true){
            document.getElementById("ListeTagAjoute").innerHTML += TagSelectionee.options[TagSelectionee.selectedIndex].text;
            document.getElementById("TagPost").value += TagSelectionee.value;
            premierTag = false;
        }else{
            document.getElementById("ListeTagAjoute").innerHTML += (", "+TagSelectionee.options[TagSelectionee.selectedIndex].text);
            document.getElementById("TagPost").value += "/"+TagSelectionee.value;
        }
        ListeTagAjoutee.push(TagSelectionee.value);
        console.log(TagSelectionee.value);
     }
});

formCreationRecette.addEventListener("submit", (event) => {
    if (tagListeCachee.value == '') {
        // Si c'est vide on affiche une alert
        erreur();
        // j'empeche le form de s'envoyer
        event.preventDefault();
    }else if (ingredientsListeCachee.value == '') {
        // Si la liste des ingrédients est vide on ne submit pas le form
        erreur();
        // j'empeche le form de s'envoyer
        event.preventDefault();
    }
  });

  function erreur() {
    if (tagListeCachee.value == '') {
        alert("La liste de tags ne peut pas être vide");
    }else if (ingredientsListeCachee.value == '') {
        alert("Votre liste d'ingrédients est vide, veuillez d'abord la remplir");
    }
  }

//fonction de reset du champ de recherche (empeche les ajouts trop rapide)
function resetIngbouton(){
    let bouton = document.getElementById("ajout_ing_bouton");
    bouton.value = undefined;

}

//fonction de reset du champ de recherche (empeche les ajouts trop rapide)
function resetTagbouton(){
    TagSelectionee.value = null;

}