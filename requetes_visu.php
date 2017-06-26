<?php
  include "conf/connex.inc.php";
  $menu="visualisation";
  require_once ("head.inc.php");
  require_once ("menu.inc.php");

  $cnx = new PDO('mysql:host='.$serveur.';port='.$port.';dbname='.$bdd, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Récupération de la Variable
  $question = isset($_POST['question']) ? $_POST['question'] : NULL;
  $_SESSION["question"] = $question;

// menu déroulant
  echo "<h3>Visualisez le résultats de vos requêtes</h3>";

/*
Les questions sont formulées en langue naturelle et transformé en requêtes SQL
*/

  $sql = "select * from dt_requete";
  $qid=$cnx->prepare($sql);
  $qid->execute();
  $alltables=$cnx->query($sql,PDO::FETCH_NUM);
  
  echo '<form method="POST" action="requetes_visu.php">';
  echo '<table border="0">';
  echo '<tr>';
  echo '<td>';
  echo '<select name="question">';
  echo '<option value="Choix">Choisir une question</option>';

     while($req=$alltables->fetch()){
	  echo '<option value="'.$req[0].'">'.$req[1].'</option>';
     }

  echo '</select>';

  echo '</td>';
  echo '<td>';
  echo '<td align="right">';
  echo '<input type="submit" value="Sélectionner">';
  echo '</td>';
  echo '</tr>';
  echo '</table>';
  echo '</form>';


// Affichages des tables
  if (isset ($_POST["question"]) && $_POST["question"]=="$question") {

  $sql1 = "select * from dt_requete where id_requete = $question";
  $qid=$cnx->prepare($sql1);
  $qid->execute();
  $alltables=$cnx->query($sql1,PDO::FETCH_NUM);

  while($req=$alltables->fetch()){
    echo '<p>La question posée : '.$req[1].'</p>';
    echo '<p>La requète SQL : '.$req[2].'</p>';
  }
  
  echo "<br />";

  $sql2 = "select * from dt_requete where id_requete = $question";
  $qid=$cnx->prepare($sql2);
  $qid->execute();
  $alltables2=$cnx->query($sql2,PDO::FETCH_NUM);
  $req=$alltables2->fetch();

  $req2 = $req[2];
  
// Résultat de la requête enregistrée

  $sql3 = "$req2";
  $qid=$cnx->prepare($sql3);
  $qid->execute();

// Tableau du résultat

  echo '<table border="1">';
  echo '<tr>';
  
  while($row=$qid->fetch(PDO::FETCH_OBJ)){
    $tableau = array($row);
    // print_r($tableau);
  }
  
  foreach($tableau as $vat){
    foreach ($vat as $key => $value) {
      echo '<th>'.$key.'</th>';
    }
  }
   
  echo '</tr>';
  echo '<tr>';

  $sql3 = "$req2";
  $qid=$cnx->prepare($sql3);
  $qid->execute();

  while($row=$qid->fetch(PDO::FETCH_OBJ)){
    $tableau = array($row);
    // print_r($tableau);
    
    foreach($tableau as $vat){
      foreach ($vat as $key => $value) {
        echo '<td>'.$value.'</td>';
      }
    }
  echo '</tr>';
  }
  echo '</table>';


} // Fin du IF



















/*
  $sql = "SHOW COLUMNS FROM `$tables`";

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
*/



// fermeture de la connexion
  $qid = $cnx->prepare($sql);
  $qid->closeCursor();
  $cnx = null;  

// Pied de page
  require_once ("footer.inc.php");
?>