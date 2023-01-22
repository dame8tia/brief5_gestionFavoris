class LinkedSelect {

    constructor ($selectHtml){
        // un dollar : convention perso Grafikart pour préciser que c'est un élément du DOM
        this.$selectHtml = $selectHtml
        this.$target = document.getElementById(this.$selectHtml.dataset.target)
        this.$optionDefault = this.$target.firstElementChild
        
        // bind nécessaire avec un évènement dans le constructor
        this.onChange = this.onChange.bind(this)
        this.$selectHtml.addEventListener('change', this.onChange)
    }

    onChange(e){

        let optiontHtml = ""
        // -- > 1 - on récupère les données en AJAX
        let request = new XMLHttpRequest // pour l'AJAX ou utiliser l"objet fetch
        // Récupération de l'attribut data-source ("../model/list_ss_cat.php?type=ss_categorie&filter=$id", true pour l'asynchrone)
        // on peut utiliser dataset.source au lieu getAttribute

        request.open('GET', this.$selectHtml.getAttribute('data-source').replace('$id', e.target.value,true))

        console.log("cccccccccccccccccc")
        // Chargement : Fonction fléchée
        request.onload = () => {

            if (request.status >=200 && request.status < 400){

                let data = JSON.parse(request.responseText)

                data.forEach(function(option){
                    optiontHtml += '<option value = "'+ option["label"] + '">'+ option ["value"] + '</option>'+"\n"
                });

                this.$target.innerHTML = optiontHtml
                this.$target.insertBefore(this.$optionDefault,this.$target.firstChild)
                this.$target.selectIndex = 0
                this.$target.style.display = null
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



// Grafikart met des $ pour les variables provenant du dom
let $selects = document.querySelectorAll('.linked-select')// classe donnée à l'attribut select concerné par la dépendance de liste

$selects.forEach(function($select){
    // Création d'une instance de la classe ci dessus
    new LinkedSelect($select)
})


