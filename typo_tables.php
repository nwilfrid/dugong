<?php
  session_start();
  include "conf/connex.inc.php";
  include "fonctions.inc.php";
  $menu="typo_tables.php";
  require_once ("head.inc.php");
  require_once ("menu.inc.php");

/***************************************
   Menu déroulant des tables principales
*/

  echo "<h3>Configurer la typologie des tables</h3>";

  $tables1 = isset($_POST['tables1']) ? $_POST['tables1'] : NULL;
  $_SESSION["tables1"] = $tables1;

  $tables2 = isset($_POST['tables2']) ? $_POST['tables2'] : NULL;
  $_SESSION["tables2"] = $tables2;

  menu_tables_typo();


/* réponse au choix du menu général */

   if (isset ($_POST["tables1"]) && $_POST["tables1"]!=="Choix" && $_POST["tables1"]=="$tables1") {

    echo "Voici la première table que vous avez choisie : $tables1";
    echo "<br />";
    echo "Voici la deuxième table que vous avez choisie : $tables2";
    echo "<br />";

    $sqlinsert = "INSERT INTO `dt_class_tables`(`nom_table`, `id_typo_table`) VALUES ('$tables1','$tables2')";

    $tab=ftab(dt_class_tables);
    $req=$cnx->prepare($sqlinsert);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $cnx->beginTransaction();
    $req->execute($tab);
    $cnx->commit();

/*
    assert ('$cnx->prepare($sqlinsert)');
    $qid=$cnx->prepare($sqlinsert);
    $cnx->beginTransaction();
    $qid->execute();
    $cnx->commit();
*/

  echo "<br />";

  echo "Les données de la table dt_class_tables ont bien été ajoutés !";

   }

  require_once ("footer.inc.php");

?>