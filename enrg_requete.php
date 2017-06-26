<?php
  session_start();
  include "conf/connex.inc.php";
  include "fonctions.inc.php";
  $menu="enrg_requete.php";
  require_once ("head.inc.php");
  require_once ("menu.inc.php");

  $question = isset($_POST['question']) ? $_POST['question'] : NULL;
  $_SESSION["question"] = $question;

  $requete = isset($_POST['requete']) ? $_POST['requete'] : NULL;
  $_SESSION["requete"] = $requete;

/* Formulaire de saisi de la question et de la requête associée */

  echo "<h3>Enregistrer vos questions en langue naturelle et la requête SQL associée</h3>";
  echo '<br />';
  
  echo '<form method="POST" action="enrg_requete.php">';
  echo '<table>';
  echo '<tr>';
  echo '<td>Saisir la question</td>';
  echo '<td><input type="text" size="80" name="question"></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td>Saisir la requête</td>';
  echo '<td><input type="text" size="80" name="requete"></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td></td>';
  echo '<td align="right">';
  echo '<input type="submit" value="Enregistrer">';
  echo '<td>';
  echo '</tr>';
  echo '</table>';
  echo '</form>';


  if (isset ($_POST["question"]) && $_POST["question"]!=="" && $_POST["question"]=="$question") {

     echo "Question : $question";
     echo "<br />";
     echo "Requête : $requete";
     echo "<br />";

  $sqlreq = "INSERT INTO `dt_requete`(`question_requete`, `sql_requete`) VALUES ('$question','$requete')";

  $tab=ftab(dt_requete);
  $req=$cnx->prepare($sqlreq);
  $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $cnx->beginTransaction();
  $req->execute($tab);
  $lastId = $cnx->lastInsertId();
  $cnx->commit();

/*
  assert ('$cnx->prepare($sqlreq)');
  $qid=$cnx->prepare($sqlreq);
  $cnx->beginTransaction();
  $qid->execute();
  $lastId = $cnx->lastInsertId();
  $cnx->commit();
*/

  echo "<br />";
  echo "Les données de la table \"dt_requete\" ont bien été ajoutés et son id est $lastId !";

  echo "<br />";
  echo "<br />";

  $sql2 = "select * from dt_requete where id_requete = $lastId";
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

/*******************/
  } // Fin du IF

  require_once ("footer.inc.php");

?>