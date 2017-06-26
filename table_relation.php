<?php
  session_start();
  include "conf/connex.inc.php";
  include "fonctions.inc.php";
  $menu="enregistrement";
  require_once ("head.inc.php");
  require_once ("menu.inc.php");

  echo "<h3>Enregistrer les données des tables de relation</h3>";
/*  echo "<br />";
  echo "Choisissez une table de la base de données.</p>"; */
  // echo "<br />";

  $tables = isset($_POST['tables']) ? $_POST['tables'] : NULL;
  $_SESSION["tables"] = $tables;

/* Menu déroulant : liste les tables principales de la base de données */
  menu_tr();

  $id = defid($tables);

  if (isset ($_POST["tables"]) && $_POST["tables"]!=="Choix" && $_POST["tables"]=="$tables") {

  echo '<table border="0">';
  echo "<tr>";
  echo "<td>";

    $sql = "SHOW COLUMNS FROM `$tables`";
    $qid=$cnx->prepare($sql);
    $qid->execute();

    while( $row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
      $tableau = array($row);
      echo '<table border="0">';
      echo "<tr>";
      foreach ($tableau as $v1) {
        foreach ($v1 as $v2) {
       	  echo '<td align="right">'.$v2.' :</td>';
          echo '</tr>';
        } 
      } 
    } 

    echo '</table>';

  echo "</td>";
  echo "<td>";

    $sql2 = "SELECT * FROM `$tables` order by `$id` desc limit 1";
    $qid=$cnx->prepare($sql2);
    $qid->execute();
  
    while($row=$qid->fetch(PDO::FETCH_OBJ)){
    echo '<table border="0">';
    echo "<tr>";

      foreach ($tableau as $v3) {
        foreach ($v3 as $v4) {
       	  echo "<td>";
  	  if ($row->$v4 === NULL || $row->$v4 === ''){
	    print "Champ vide";
	  } else {
            print $row->$v4;
          }
	  echo "</td>";
          echo '</tr>';
        }
      }
    }
    echo '</table>';

  echo "</td>";
  echo "</tr>";
  echo '</table>';
  
} // Fin du IF


// Bas de page
  require_once ("footer.inc.php");
?>
