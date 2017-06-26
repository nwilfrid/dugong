<?php
  session_start();
  include "conf/connex.inc.php";
  $menu="enregistrement";
  require_once ("head.inc.php");
  require_once ("menu.inc.php");

  echo "fichier : enrg.php<br />";
  echo "<br/>Enregistrer les données <br/> Choisissez la table de la base de données : ";

  $sql = "show tables";
  assert ('$cnx->prepare($sql)');
  $alltables=$cnx->query($sql,PDO::FETCH_NUM);

  $tables = isset($_POST['tables']) ? $_POST['tables'] : NULL;
  $_SESSION["tables"] = $tables;


  echo '<form method="POST" action="enrg.php" name="menud">';
  echo '<select name="tables">';
  echo '<option value="">Choisir une table</option>';
  echo '<option value="Lettre">Lettre</option>';
  echo '<option value="Personne">Personne</option>';
  echo '<option value="Communaute">Communaute</option>';
  
//     while($result=$alltables->fetch()){
//	  echo '<option value="'.$result[0].'">'.$result[0].'</option>';
//     }

  echo '</select>';
  echo '   ';
  echo '<input type="submit" value="Choisir">';
  echo '</form>';

// nouvelle version
// Affichages des tables
if (isset ($_POST["tables"]) && $_POST["tables"]=="$tables") {
  
  $sql = "SHOW COLUMNS FROM `$tables`";
  $qid=$cnx->prepare($sql);
  $qid->execute();

  echo '<form method="POST" action="valider.php">';

  echo " <p>Affichage de la table \" $tables \" </p><br />";
  while( $row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
     $tableau = array($row);
     echo '<table border="1">';
     foreach ($tableau as $v1) {
     // id
       unset($v1['0']);
       foreach ($v1 as $v2) {
       	       echo "<tr>";
       	       echo "<td> $v2 :</td>";
	       echo '<td><input type="text" name="'.strtolower($v2).'"></td>';
     	       echo "<tr>";
       }
     }
  }
  echo '<tr valign="baseline">';
    echo '<td colspan="2" align="right"><div style="margin-top:20px">';
      echo '<input type="submit" value="Enregistrer">';
    echo '</div></td>';
  echo '</tr>';
  echo '</table>';
  echo '</form>';
}

// Déconnexion avec la base de données
  $qid = $cnx->prepare($sql);
  $qid->closeCursor();
  $cnx = null;

// Bas de page
  require_once ("footer.inc.php");
?>
