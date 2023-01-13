CREATE DATABASE favoris ;

CREATE TABLE favori
(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nom VARCHAR(150) NOT NULL,
    etiquette VARCHAR(150),
    descript VARCHAR(500),
    adresse_url VARCHAR(2000)    
)
;

ALTER TABLE favori
ALTER COLUMN adresse_url VARCHAR(2000) NOT NULL; -- Ne fonctionne pas

CREATE TABLE categorie (
    id_cat INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    categorie VARCHAR(150) NOT NULL
)
;

CREATE TABLE ss_categorie (
    id_ss_cat INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    ss_categorie VARCHAR(150) NOT NULL
)
;

CREATE TABLE type_favori (
    id_type INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    type_favori VARCHAR(150) NOT NULL
)
;

CREATE TABLE categorie_ss_categorie (
    id_cat      INT NOT NULL,
    id_ss_cat   INT NOT NULL,
    FOREIGN KEY (id_cat) REFERENCES categorie (id_cat) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_ss_cat) REFERENCES ss_categorie (id_ss_cat) ON DELETE RESTRICT ON UPDATE CASCADE,
    PRIMARY KEY (id_cat, id_ss_cat)
)

ALTER TABLE favori
ADD id_cat INT NULL;

ALTER TABLE favori 
ADD FOREIGN KEY (id_cat) REFERENCES categorie (id_cat)
ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE favori
ADD id_ss_cat INT NULL;
ALTER TABLE favori 
ADD FOREIGN KEY (id_ss_cat) REFERENCES ss_categorie (id_ss_cat)
ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE favori
ADD id_type INT NULL;

ALTER TABLE favori 
ADD FOREIGN KEY (id_type) REFERENCES type_favori (id_type)
ON DELETE RESTRICT ON UPDATE CASCADE;

// Insertion des valeurs

INSERT INTO categorie (categorie)
 VALUES
 ('Outils'),
 ('Front End'),
 ('Back End'),
 ('Dev Web Mobile'),
 ('Veilles'),
 ('Gestion de projet');

 INSERT INTO ss_categorie (ss_categorie)
 VALUES
 ('Développeur'), --1   => 1,1
 ('Design'),  --1       => 1,2

 ('Maquette'),  --2     => 2,3
 ('HTML'), --2          => 2,4
 ('CSS'), --2           => 2,5
 ('Java Script'), --2   => 2,6
 
 ('Algorithmes'), --3   => 3,7
 ('PHP'), --3           => 3,8
 ('SQL'), --3           => 3,9    

 ('Responsive Web Design'), --4 => 4,10
 
 ('Support'), --5       => 5,11
 ('Articles'), --5      => 5,12

 ('SCRUM'), --6         => 6,13
 ('MERISE') --6         => 6,14
 ;

 INSERT INTO categorie_ss_categorie 
 VALUES 
 (1,1), 
 (1,2),
 (2,3),
 (2,4),
 (2,5),
 (2,6),
 (3,7),
 (3,8),
 (3,9),
 (4,10),
 (5,11),
 (5,12),
 (6,13),
 (6,14);

 INSERT INTO type_favori (type_favori)
 VALUES 
 ("Tutoriel"),
 ("Plugin"),
 ("Cours"),
 ("Mémo"),
 ("Documentation"),
 ("Article"),
 ("Vidéo");

 INSERT INTO favori (adresse_url,nom,etiquette,descript,id_cat,id_ss_cat,id_type)
 VALUES
("https://code.visualstudio.com/","VSCode","","",1,1,NULL),
("https://learngitbranching.js.org/?locale=fr_FR","Git","Branche","",1,1,1),
("https://github.com/","Git","Site officiel","",1,1,NULL),
("https://www.hostinger.fr/tutoriels/commandes-git ","Git","Commandes Git","",1,1,NULL),
("https://youtu.be/e68PKFYWfoQ ","Figma","","Apprendre figma",1,2,1),
("https://www.youtube.com/watch?v=icaC_DTYs3c&ab_channel=TutorialTim ","Figma","","",1,2,2),
("https://miro.com/fr/ ","Miro","","",1,2,NULL),
("https://www.openstudio.fr/2022/10/27/comment-optimiser-lergonomie-de-son-site-web/ ","Open Studi","","",2,3,NULL),
("https://www.usabilis.com/definition-wireframe/","Wireframe","","",2,3,NULL),
("https://developer.mozilla.org/fr/docs/Learn/Getting_started_with_the_web/HTML_basics ","Doc Mozilla","","",2,4,5),
("https://developer.mozilla.org/fr/docs/Web/HTML/Element ","Element HTML","","",2,4,5),
("http://iamjmm.ovh/NSI/ressourcesHTMLCSS/cours/htmlCss/c5-2.html ","HTML+CSS","","",2,4,NULL),
("https://www.youtube.com/watch?v=Cwm9qX9onq4 ","Site Vitrine","","",2,4,1),
("https://www.youtube.com/watch?v=qsbkZ7gIKnc","Cours HTML","","",2,4,3),
("https://openclassrooms.com/fr/courses/1603881-apprenez-a-creer-votre-site-web-avec-html5-et-css3 ","HTML5 CSS3","","",2,4,3),
("https://alticreation.com/bem-pour-le-css/ ","BEM","","",2,5,NULL),
("https://css-tricks.com/snippets/css/a-guide-to-flexbox/ ","FlexBox","FlexBox","",2,5,4),
("https://youtu.be/UcC76tcvLgA ","FlexBox","FlexBox","",2,5,7),
("https://flexboxfroggy.com/#fr ","FlexBox","FlexBox","",2,5,4),
("https://openclassrooms.com/fr/courses/6175841-apprenez-a-programmer-avec-javascript ","Apprendre le JS","","",2,6,3),
("https://www.youtube.com/watch?v=kUXNmv4ZcWA ","Tableaux","","",2,6,7),
("https://www.xm1math.net/algobox/doc.html ","AlgoBox","Algorithme pour les enfants","",3,7,5),
("https://openclassrooms.com/fr/courses/4366701-decouvrez-le-fonctionnement-des-algorithmes ","OCR Algorithme","","",3,7,3),
("https://pixees.fr/classcode/formations/module1/ ","Algorithme","Algo récréatif","",3,7,3),
("https://studylibfr.com/doc/179347/cours-sur-les-boucles-ou-instructions-r%C3%A9p%C3%A9titives# ","Boucles, instructions répétitives","","",3,7,3),
("https://www.youtube.com/watch?v=cEK4cPTP5qE&ab_channel=HassanELBAHI ","Constantes, Variables","","",3,7,3),
("https://www.php.net/manual/fr/ ","Manuel PHP","","",3,8,5),
("https://drive.google.com/drive/u/0/folders/1-HH7b2Rf_tvJVnHV6cKqr2nRekLjGFes ","Cours Greta","","",3,8,3),
("https://drive.google.com/drive/folders/1nPTgAOYv5ZsIARtEQ74n-F4pLzfT5Ngq?usp=share_link","Cours Greta","Support","",3,9,3),
("https://openclassrooms.com/fr/courses/1959476-administrez-vos-bases-de-donnees-avec-mysql ","OCR Administrer MySQL","","",3,9,3),
("https://openclassrooms.com/fr/courses/6971126-implementez-vos-bases-de-donnees-relationnelles-avec-sql ","OCR SGBDR","","",3,9,3),
("https://openclassrooms.com/fr/courses/918836-concevez-votre-site-web-avec-php-et-mysql ","OCR Site Web Php_ MySQL","","",3,9,3),
("http://www.turrier.fr/articles/php-mysql-creer-bdd/php-mysql-creer-bdd.php ","Site Web Php_ MySQL","","",3,9,1),
("https://sql.sh/ ","SQL Officiel","","",3,9,5),
("https://sql.sh/919-aide-memoire-mysql ","Aide mémoire","","",3,9,4),
("https://www.usabilis.com/responsive-web-design-site-web-adaptatif/ ","Responsive Design","Explication","",4,10,6),
("https://www.codingame.com/ ","Apprendre en jouant","","",4,10,1),
("https://drive.google.com/file/d/178KS7Z_AD9nIO_ohfHFIuGnOrSueWduW/view ","Cours Greta Scrum","SCRUM","",6,13,3),
("https://drive.google.com/file/d/13Jrto7jRgyCmP660VsZx76aI1zUYKE5j/view?usp=sharing ","Cours Greta –veille internet","","",5,11,3),
("https://drive.google.com/file/d/1Pq1S5q6Cg9bsvcAKwWqoDiGLlQ3W_2vo/view?usp=sharing ","Cours Greta –support veille","","",5,11,3),
("https://outilstice.com/2021/08/meilleurs-moteurs-de-recherche-pour-etudiants/#Google_Scholar_Lincontournable_moteur_de_recherche_pour_etudiants ","Moteur de recherche","","",5,12,6),
("https://www.codingame.com/ ","Apprendre en jouant","","",5,12,1);

/* REQUETE POUR LA Graphical User Interface */
/* Afficher la liste des favoris existants */
SELECT t1.nom, t1.etiquette, t1.descript, t1.adresse_url, t2.categorie, t3.ss_categorie
FROM `favori` AS t1
LEFT OUTER JOIN categorie AS t2
ON t1.id_cat = t2.id_cat
LEFT OUTER JOIN ss_categorie AS t3
ON t1.id_ss_cat = t3.id_ss_cat 
LEFT OUTER JOIN type_favori AS t4
ON t1.id_type = t4.id_type;

/* Afficher les catégories et sous catégories existantes (le cas échéant) */
SELECT t1.id_cat, t2.id_ss_cat, t1.categorie, t2.ss_categorie
FROM categorie_ss_categorie AS t3
RIGHT OUTER JOIN categorie AS t1
ON t1.id_cat = t3.id_cat
LEFT OUTER JOIN ss_categorie AS t2
ON t2.id_ss_cat = t3.id_ss_cat ;
   

