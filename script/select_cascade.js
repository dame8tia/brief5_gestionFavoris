// réalisation d'une classe 

class LinkedSelect {
    constructor ($selectHtml){
        // un dollar : convention perso pour préciser que c'est un élément du DOM
        this.$selectHtml = $selectHtml
        /*this.$cible = this.$selectHtml.dataset.target  
        // les 3 fonctionnenent mais je ne peux pas les appeler dans les fonctions .load 
        // (pour que çà marche il faut une fonction flechée) et ... DONC dans ces fct, je les attrape avec l'évènement
        this.$target = document.getElementById(this.$cible)//this.$selectHtml.dataset.target
        this.$optionDefault = this.$target.firstElementChild */
        // bind nécessaire avec un évènement dans le constructor
        this.onChange = this.onChange.bind(this)
        this.$selectHtml.addEventListener('change', this.onChange)

    }

    onChange(e){

        let id_target = e.target.dataset.target
        let targetHtml = document.getElementById(id_target)
        let optionDefault = targetHtml.firstElementChild
        let optiontHtml = ""

        // -- > 1 - on récupère les données en AJAX
        let request = new XMLHttpRequest // pour l'AJAX ou utiliser l"objet fetch
        // Récupération de l'attribut data-source (qui contient l'url et replace le $id por l'id du sélect sur lequel on fait un changement, true pour l'asynchrone)
        // on peut utiliser dataset (cf ds le constructor pour la target)
        request.open('GET', this.$selectHtml.getAttribute('data-source').replace('$id', e.target.value,true))
        // Chargement 
        request.onload = function() {
            if (request.status >=200 && request.status < 400){

                let data = JSON.parse(request.responseText)

                data.forEach(function(option){
                    optiontHtml += '<option value = "'+ option["label"] + '">'+ option ["value"] + '</option>'+"\n"
                });

                console.log("Option à écrire : "+optiontHtml)
                targetHtml.innerHTML = optiontHtml
                targetHtml.insertBefore(optionDefault,targetHtml.firstChild)
                targetHtml.selectedIndex = 0
                targetHtml.style.display = null
            }            
        }  
        // test si erreur
        request.onerror = function() {
            alert("impossible de charger la liste")
        }
        // appel de la requête
        request.send()
    }
} 


let $selects = document.querySelectorAll('.linked-select')// classe donnée àl'attribut select concernée par la dépendance de liste
/* console.log($selects); */
$selects.forEach(function($select){
    // Création d'une instance de la classe ci dessus
    new LinkedSelect($select)
})


