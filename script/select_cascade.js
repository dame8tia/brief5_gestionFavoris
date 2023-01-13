function getCatSelected(id_cat){

    el_hidden = document.getElementById("id_cat_selected");
    /* console.log(el_hidden); */
    el_hidden.innerHTML=id_cat;
/*     console.log(document.getElementById("id_cat_selected").innerHTML)
    console.log(id_cat); */
    query = "SELECT t1.id_cat, t2.id_ss_cat, t1.categorie, t2.ss_categorie"
    query +=" FROM categorie_ss_categorie AS t3"
    query +=" RIGHT OUTER JOIN categorie AS t1"
    query +=" ON t1.id_cat = t3.id_cat"
    query +=" LEFT OUTER JOIN ss_categorie AS t2"
    query +=" ON t2.id_ss_cat = t3.id_ss_cat WHERE t1.id_cat="+id_cat ;

    console.log(query);
    return query ;
}