// Se déclenche sur le onclick de l'icône Delete

function confirmDelete(id) {
    console.log("Lancer la boite de dialogue Confirmation DELETE", window.location);

    if(confirm("Voulez vous vraiment supprimer le favori ?")){
        window.location='model/delete.php?id='+id
    }
    else{
        alert("Aucune suppression réalisée")
    }

}