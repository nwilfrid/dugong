<?php
  session_start();
  include "conf/connex.inc.php";
  include "fonctions.inc.php";
  $menu="enregistrement";
  require_once ("head.inc.php");
  require_once ("menu.inc.php");

  echo "Choisissez la table :";

  $sql = "show tables";
  assert ('$cnx->prepare($sql)');
  $alltables=$cnx->query($sql,PDO::FETCH_NUM);

  $tables = isset($_POST['tables']) ? $_POST['tables'] : NULL;
  $_SESSION["tables"] = $tables;

//  $id = defid($tables); // nom du champ de l'ID
//  $nbrel = fdligne_tab($tables); // Valeur désignant les 5 dernières n-uplet

/********************************
   Menu des tables principales
*/
  menu_tr(); // Fonction se trouvant dans le fichier fonction.inc.php

/********************************
   Tableau global de présentation
*/

if (isset ($_POST["tables"]) && $_POST["tables"]!=="Choix" && $_POST["tables"]=="$tables") {

echo '<table border="0">';
echo "<tr>";
  echo '<th style="width:500px ; text-align:left" >';
    echo "Saisie dans la table \" $tables \"";
  echo "</th>";
  echo "<th>";
    echo "Les 5 derniers enregistrements";
  echo "</th>";
echo "</tr>";

echo "<tr>";
  echo "<td>";

/*********************************
   Affichages des champs de saisie pour la table sélectionné dans le menu déroulant menu_tp().
*/
  enrg_tables_relations($tables); // Fonction se trouvant dans fonctions.inc.php

echo "</td>";
echo '<td valign="top">';

/*********************************
   Affichages des champs de saisie pour la table sélectionné dans le menu déroulant menu_tr().
*/

if (isset ($_POST["tables"]) && $_POST["tables"]!=="Choix" && $_POST["tables"]=="$tables") {

  denrgs($tables);
  
}

echo "</td>";
echo "</tr>";
echo "</table>";

/*
FIN DU TABLEAU
*/

} else {
  echo "Faites le choix de la table dans laquelle vous souhaitez enregistrer des données !" ;
}


echo "<br />";
echo "<p> Attention : Il ne peut y avoir deux fois le même ensemble de clef étrangère ! </p>";
echo "<br />";



/*******************************
   Déconnexion avec la base de données
*/

$qid = $cnx->prepare($sql);
$qid->closeCursor();
$cnx = null;

// Bas de page
require_once ("footer.inc.php");
?>
