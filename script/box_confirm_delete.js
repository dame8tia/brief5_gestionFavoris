// Se déclenche sur le onclick de l'icône Delete du homepage

function confirmDelete(id) {

    if(confirm("Voulez vous vraiment supprimer le favori ?")){
        window.location='model/delete.php?id='+id
    }
    else{
        alert("Aucune suppression réalisée")
    }

}
/* 
function deleteConfirmed(status) {// Appelée depuis le delete mais ne fonctionne pas.
    if (status){
        alert("Enregistrement supprimé")
    }
    else {alert("Suppression impossible")}
} */

/* Faire une classe en Javascript avec deux méthodes  */