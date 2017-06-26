<?php
  session_start();
  include ('./conf/connex.inc.php');
  include ('fonctions.inc.php');
  $menu="enregistrement";
  require_once ("head.inc.php");
  require_once ("menu.inc.php");

  $tables = $_SESSION["tables"];

  $id = defid2($tables);
  $id2 = defid3($tables);

/*
  $newstr = isset($newstr) ? $newstr : NULL;
  $new2str = isset($new2str) ? $new2str : NULL;
*/

  $sql2=fsql_tr($tables);
  $tab=ftab_tr($tables);

  $tabx = (array_values($tab));
  $tab0=$tabx['0'];
  $tab1=$tabx['1'];

// Vérification
/*
  echo "<br />";
  print_r($sql2);
  echo "<br />";
  echo "<br />";
  echo "<br />";
  echo "$id, $id2";
  echo "<br />";
  echo $tab0;
  echo "<br />";
  echo $tab1;
  echo "<br />";
  echo "-----------------------------------------------------------";
  echo "<br />";
  echo "<br />";
*/

  $req=$cnx->prepare($sql2);
  $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $cnx->beginTransaction();
  $req->execute($tab);
  $lastId = $cnx->lastInsertId();
  $cnx->commit();

/**********
  Affichage
*/
  
  menu_tr($tables);

  echo "<br />";
  echo "Les données de la table \"$tables\" ont bien été ajoutés !";
  echo "<br />";
  echo "<br />";
  echo "<br />";


/*********
   Tableau
*/

echo '<table border="1">';
echo "<tr>";
  echo '<th style="width:500px ; text-align:left" >';
    echo "Saisie dans la table \" $tables \"";
  echo "</th>";
  echo "<th>";
    echo "L'ensemble des enregistrements associé à l'$id : $tab0";
  echo "</th>";
echo "</tr>";


echo "<tr>";
  echo '<td style="vertical-align:top">';

  $sql = "SHOW COLUMNS FROM `$tables`";
  $qid=$cnx->prepare($sql);
  $qid->execute();

  while( $row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
    $tableau = array($row);
    echo '<table border="1" align="center">';
    echo "<tr>";
    foreach ($tableau as $v1) {
      foreach ($v1 as $v2) {
        echo '<td align="right">'.$v2.'</td>';
      } 
    } 
    echo '</tr>';
  }

  $sql = "SELECT * FROM `$tables` where $id = $tab0 and $id2 = $tab1";
  $qid=$cnx->prepare($sql);
  $qid->execute();
  
  while($row=$qid->fetch(PDO::FETCH_OBJ)){
    echo "<tr>";
    foreach ($tableau as $v3) {
      foreach ($v3 as $v4) {
        echo "<td>";
        if ($row->$v4 === NULL || $row->$v4 === ''){
          print "NULL";
        } else {
          print $row->$v4;
        }
        echo "</td>";
      }
    }
    echo '</tr>';
  }
  echo '</table>';

echo "</td>";
echo '<td style="vertical-align:top">';


  $sql = "SHOW COLUMNS FROM `$tables`";
  $qid=$cnx->prepare($sql);
  $qid->execute();

  while( $row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
    $tableau = array($row);
    echo '<table border="1" align="center">';
    echo "<tr>";
    foreach ($tableau as $v1) {
      foreach ($v1 as $v2) {
        echo '<td align="right">'.$v2.'</td>';
      } 
    } 
    echo '</tr>';
  }

  $sql = "SELECT * FROM `$tables` where $id = $tab0";
  $qid=$cnx->prepare($sql);
  $qid->execute();
  
  while($row=$qid->fetch(PDO::FETCH_OBJ)){
    echo "<tr>";
    foreach ($tableau as $v3) {
      foreach ($v3 as $v4) {
        echo "<td>";
        if ($row->$v4 === NULL || $row->$v4 === ''){
          print "NULL";
        } else {
          print $row->$v4;
        }
        echo "</td>";
      }
    }
    echo '</tr>';
  }
  echo '</table>';

echo "</td>";
echo "</tr>";
echo "</table>";


/*
FIN DU TABLEAU
*/


require_once ("footer.inc.php");
?>