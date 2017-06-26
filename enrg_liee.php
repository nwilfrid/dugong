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

  $id = defid($tables);

/********************************
   Menu des tables principales
*/
  menu_tl(); // Fonction se trouvant dans le fichier fonction.inc.php

// echo " <p>Affichage du dernier enregistrement de la table \" $tables \" </p><br />";

/********************************
   Tableau global de présentation
*/

if (isset ($_POST["tables"]) && $_POST["tables"]!=="Choix" && $_POST["tables"]=="$tables") {

echo '<table border="0">';
echo "<tr>";
  echo "<th>";
    echo "Affichage de la table \" $tables \"";
  echo "</th>";
  echo "<th>";
    echo "Le dernier enregistrement";
  echo "</th>";
echo "</tr>";

echo "<tr>";
  echo "<td>";

/*********************************
   Affichages des champs de saisie pour la table sélectionné dans le menu déroulant menu_tp().
*/
  enrg_tables($tables); // Fonction se trouvant dans fonction.inc.php

echo "</td>";
echo '<td valign="top">';

/*********************************
   Affichages des champs de saisie pour la table sélectionné dans le menu déroulant menu_tp().
*/
  denrg($tables); // Fonction se trouvant dans fonction.inc.php

echo "</td>";
echo "</tr>";
echo "</table>";

/* FIN DU TABLEAU */

} else {
  echo "Faites le choix de la table dans laquelle vous souhaitez enregistrer des données !" ;
}

/*******************************
   Déconnexion avec la base de données
*/

$qid = $cnx->prepare($sql);
$qid->closeCursor();
$cnx = null;

// Bas de page
require_once ("footer.inc.php");
?>
