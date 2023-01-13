function confirmDelete(id) {
    console.log("Lancer la boite de dialogue Confirmation DELETE", window.location);

    if(confirm("Voulez vous vraiment supprimer le favori ?")){
        window.location='script/delete.php?id='+id
    }
    else{
        alert("Aucune suppression réalisée")
    }

}