<?php
  include "conf/connex.inc.php";
  $menu="visualisation";
  require_once ("head.inc.php");
  require_once ("menu.inc.php");

  $cnx = new PDO('mysql:host='.$serveur.';port='.$port.';dbname='.$bdd, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// menu déroulant
  echo "<h3>Visualisez vos données</h3>";

  $tables = isset($_POST['tables']) ? $_POST['tables'] : NULL;

  $sql = "show tables";
  assert ('$cnx->prepare($sql)');
  $alltables=$cnx->query($sql,PDO::FETCH_NUM);

//  $tables = isset($_POST['tables']) ? $_POST['tables'] : NULL;
  echo '<form method="POST" action="tables_visu.php">';
  
  echo '<select name="tables">';
  echo '<option value="">Choisir une table</option>';

     while($result=$alltables->fetch()){
	  echo '<option value="'.$result[0].'">'.$result[0].'</option>';
     }

  echo '</select>';
  echo '   ';
  echo '<input type="submit" value="Choisir">';
  echo '</form>';

// Affichages des tables
  if (isset ($_POST["tables"]) && $_POST["tables"]=="$tables") {
  
  $sql = "SHOW COLUMNS FROM `$tables`";
  $qid=$cnx->prepare($sql);
  $qid->execute();

  echo " <p>Affichage de la table \" $tables \" </p><br />";

  while( $row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
     $tableau = array($row);
     echo '<table border="1" width="100%">';
     echo "<tr>";
     foreach ($tableau as $v1) {
       foreach ($v1 as $v2) {
       	       echo "<th> $v2 </th>";
       }
     }
     echo "</tr>";
  }
     
  $sql = "SELECT * FROM `$tables`";
  $qid=$cnx->prepare($sql);
  $qid->execute();

  while($row=$qid->fetch(PDO::FETCH_OBJ)){
    echo '<tr>';
    foreach ($tableau as $v1) {
      foreach ($v1 as $v2) {
        echo '<td>'.$row->$v2.'</td>';
      }
    }
    echo '</tr>';
  }
  echo '</table>';
}

// fermeture de la connexion
  $qid = $cnx->prepare($sql);
  $qid->closeCursor();
  $cnx = null;  

// Pied de page
  require_once ("footer.inc.php");
?>