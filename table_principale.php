<?php
  session_start();
  include "conf/connex.inc.php";
  include "fonctions.inc.php";
  $menu="enregistrement";
  require_once ("head.inc.php");
  require_once ("menu.inc.php");

  echo "<h3>Enregistrer les données des tables principales</h3>";
/*  echo "<br/>";
  echo "Choisissez une table de la base de données.</h3>"; */
  // echo "<br/>";
  
  $tables = isset($_POST['tables']) ? $_POST['tables'] : NULL;
  $_SESSION["tables"] = $tables;

/* Menu déroulant : liste les tables principales de la base de données */
  menu_tp();

// Bas de page
  require_once ("footer.inc.php");
?>
