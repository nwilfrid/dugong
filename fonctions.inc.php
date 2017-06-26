<?php

/******************************************************
Liste des fonctions utilisés et dans quel fichier
*/


/*******************************************************
   Menus déroulant pour l'enregistrement des tables dans
   la typologie
*/

function menu_tables_typo()
{
  include "conf/connex.inc.php";
  $sql1 = "show tables";
  assert ('$cnx->prepare($sql1)');
  $alltables1=$cnx->query($sql1,PDO::FETCH_NUM);

  $sql2 = "select * from dt_typo_table where id_typo_table < 4";
  $qid=$cnx->prepare($sql2);
  $qid->execute();
  $alltables2=$cnx->query($sql2,PDO::FETCH_NUM);

  echo '<form method="POST" action="typo_tables.php">';
  echo '<table class="tab" border="0">';
  echo '<tr>';
  echo '<td class="typo">';
  echo "<p>Liste des tables de la base de données</p>";
  echo '</td><td>';
  echo '<select name="tables1">';
  echo '<option value="Choix">Choisir une table</option>';

     while($id_table=$alltables1->fetch()){
	  echo '<option value="'.$id_table[0].'">'.$id_table[0].'</option>';
     }

  echo '</select>';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td class="typo">';
  echo "<p>Liste des différentes typologies</p>";
  echo '</td><td>';
  echo '<select name="tables2">';
  echo '<option value="Choix">Choisir un type</option>';

     while($val_table=$alltables2->fetch()){
	  echo '<option value="'.$val_table[0].'">'.$val_table[1].'</option>';
     }

  echo '</select>';
  echo '</td></tr>';
  echo '<tr><td></td>';
  echo '<td align="right">';
  echo '<input type="submit" value="Enregistrer">';
  echo '</td></tr>';
  echo '</table>';
  echo '</form>';

}
/* FIN de la fonction */


/************************************************
   Définit la valeur ID de l'avant dernière ligne
   d'une table pour la fonction LIMIT en SQL
   L'idée de et définir une variable contenant
   le nombre de ligne totale d'une table -1
   afin de l'intégrer dans LIMIT d'une requête SQL
   SELECT * TABLE $tables LIMIT $var,1;
*/

function fdligne_tab($tables)
{
  include "conf/connex.inc.php";
  $sql3 = "SELECT count(*) FROM `$tables`";

  $qid=$cnx->prepare($sql3);
  $qid->execute();
  
  $result=$qid->fetchAll(PDO::FETCH_COLUMN, 0);
  $lcount=$result['0']-5;
  return $lcount;
}



/********************************************
  Formulaire d'enregistrement de données pour
  les tables principales et liées
*/

function enrg_tables($tables)
{
  include "conf/connex.inc.php";
  $id = defid($tables);
  
  if (isset ($_POST["tables"]) && $_POST["tables"]!=="Choix" && $_POST["tables"]=="$tables") {

    $sql = "SHOW COLUMNS FROM `$tables`";
    $qid=$cnx->prepare($sql);
    $qid->execute();
  
    echo '<form method="POST" action="valider.php">';
    while( $row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
       $tableau = array($row);
       echo '<table class="tab" border="0">';
       foreach ($tableau as $v1) {
       unset($v1['0']);
         foreach ($v1 as $v2) {
       	       echo '<tr>';
       	       echo '<td id="tab_align">'.$v2.' :</td>';
	       echo '<td><input type="text" name="'.strtolower($v2).'"></td>';
     	       echo '<tr>';
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
}

/*************************************************
  Formulaire d'enregistrement des tables relations 
*/

function enrg_tables_relations($tables)
{
  include "conf/connex.inc.php";
  $id = defid($tables);
  
  if (isset ($_POST["tables"]) && $_POST["tables"]!=="Choix" && $_POST["tables"]=="$tables") {

    $sql = "SHOW COLUMNS FROM `$tables`";
    $qid=$cnx->prepare($sql);
    $qid->execute();
  
    echo '<form method="POST" action="valider_tr.php">';
    while( $row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
       $tableau = array($row);
       echo '<table class="tab" border="0">';
       foreach ($tableau as $v1) {
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
}


/********************************************************
  Définition de la variable $id qui donne le nom du champ
  de l'ID de la table (par exemple "id_table")
  -> defid($tables) : avec la condition IF sur la variable $tables
  -> defid2($tables) : sans la condition IF sur la variable $tables
*/

function defid($tables)
{
  include "conf/connex.inc.php";

  if (isset ($_POST["tables"]) && $_POST["tables"]!=="Choix" && $_POST["tables"]=="$tables") {
  
    $sql = "SHOW COLUMNS FROM `$tables`";
    $qid=$cnx->prepare($sql);
    $qid->execute();

    while( $row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
      $tableau = array($row);
      foreach ($tableau as $v1) {
      }
    } // fin de la première boucle WHILE

  $id = $v1['0']; // variable du premier champ de la table correspondant à l'ID
  
  return $id;

  } // Fin du IF
}

function defid2($tables)
{
  include "conf/connex.inc.php";

    $sql = "SHOW COLUMNS FROM `$tables`";
    $qid=$cnx->prepare($sql);
    $qid->execute();

    while( $row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
      $tableau = array($row);
      foreach ($tableau as $v1) {
      }
    } // fin de la première boucle WHILE

  $id = $v1['0']; // variable du premier champ de la table correspondant à l'ID
  return $id;
}

function defid3($tables)
{
  include "conf/connex.inc.php";

    $sql = "SHOW COLUMNS FROM `$tables`";
    $qid=$cnx->prepare($sql);
    $qid->execute();

    while( $row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
      $tableau = array($row);
      foreach ($tableau as $v1) {
      }
    } // fin de la première boucle WHILE

  $id = $v1['1']; // variable du premier champ de la table correspondant à l'ID
  return $id;
}



/************************************************
  Affichage du dernier enregistrement d'une table
  -> denrg($tables) : avec la condition IF sur la variable $tables
  -> denrg2($tables) : sans la condition IF sur la variable $tables
  -> denrgs($tables) : 
*/

function denrg($tables)
{
  include "conf/connex.inc.php";
  $id = defid($tables);

  if (isset ($_POST["tables"]) && $_POST["tables"]!=="Choix" && $_POST["tables"]=="$tables") {

  echo '<table class="tab" border="0">';
  echo "<tr>";
  echo "<td>";

    $sql = "SHOW COLUMNS FROM `$tables`";
    $qid=$cnx->prepare($sql);
    $qid->execute();

    while( $row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
      $tableau = array($row);
      echo '<table class="tab" border="0">';
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
    echo '<table class="tab" border="0">';
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
}

function denrg2($tables)
{
  include "conf/connex.inc.php";
  $id = defid2($tables);

//  if (isset ($_POST["tables"]) && $_POST["tables"]!=="Choix" && $_POST["tables"]=="$tables") {

  echo '<table class="tab" border="0">';
  echo "<tr>";
  echo "<td>";

    $sql = "SHOW COLUMNS FROM `$tables`";
    $qid=$cnx->prepare($sql);
    $qid->execute();

    while( $row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
      $tableau = array($row);
      echo '<table class="tab" border="0">';
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
    echo '<table class="tab" border="0">';
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
  
//  } // Fin du IF
}

function denrgs($tables)
{
  include "conf/connex.inc.php";

    $nbrel = fdligne_tab($tables);
    $sql = "SHOW COLUMNS FROM `$tables`";
    $qid=$cnx->prepare($sql);
    $qid->execute();

    while( $row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
      $tableau = array($row);
      echo '<table class="tab" border="0">';
      echo "<tr>";
      foreach ($tableau as $v1) {
        foreach ($v1 as $v2) {
          echo '<td align="right">'.$v2.' :</td>';
        } 
      } 
      echo '</tr>';
    }

  $sql = "SELECT * FROM `$tables` limit $nbrel,5";
  $qid=$cnx->prepare($sql);
  $qid->execute();
  
  while($row=$qid->fetch(PDO::FETCH_OBJ)){
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
      }
    }
    echo '</tr>';
  }
  echo '</table>';
  
} // Fin de la fonction


function denrgs_id($tables)
{
  include "conf/connex.inc.php";

    // $nbrel = fdligne_tab($tables);
    $sql = "SHOW COLUMNS FROM `$tables`";
    $qid=$cnx->prepare($sql);
    $qid->execute();

    while( $row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
      $tableau = array($row);
      echo '<table class="tab" border="0">';
      echo "<tr>";
      foreach ($tableau as $v1) {
        foreach ($v1 as $v2) {
          echo '<td align="right">'.$v2.' :</td>';
        } 
      } 
      echo '</tr>';
    }

  $sql = "SELECT * FROM `$tables` where $id = $";
  $qid=$cnx->prepare($sql);
  $qid->execute();
  
  while($row=$qid->fetch(PDO::FETCH_OBJ)){
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
      }
    }
    echo '</tr>';
  }
  echo '</table>';

/*  
  echo "<br />";
  echo $row->$v4['0'];
*/  

} // Fin de la fonction




/***************************************
   Menu déroulant des tables principales
*/

function menu_tp()
{
  include "conf/connex.inc.php";

  $sql = "select * from dt_class_tables where id_typo_table = 1";
  $qid=$cnx->prepare($sql);
  $qid->execute();
  $alltables=$cnx->query($sql,PDO::FETCH_NUM);


  echo '<form method="POST" action="enrg_principal.php" name="menud">';
  echo '<select name="tables">';
  echo '<option value="Choix">Choisir une table</option>';

  while($result=$alltables->fetch()){
    echo '<option value="'.$result[1].'">'.$result[1].'</option>';
  }

  echo '</select>';
  echo '   ';
  echo '<input type="submit" value="Choisir">';
  echo '</form>';

  // Déconnexion avec la base de données
  $qid = $cnx->prepare($sql);
  $qid->closeCursor();
  $cnx = null;
}

/***********************************
   Menu déroulant des tables "liées"
*/

function menu_tl()
{
  include "conf/connex.inc.php";

  $sql = "select * from dt_class_tables where id_typo_table = 2";
  $qid=$cnx->prepare($sql);
  $qid->execute();
  $alltables=$cnx->query($sql,PDO::FETCH_NUM);
  
  echo '<form method="POST" action="enrg_liee.php" name="menud">';
  echo '<select name="tables">';
  echo '<option value="Choix">Choisir une table</option>';

  while($result=$alltables->fetch()){
    echo '<option value="'.$result[1].'">'.$result[1].'</option>';
  }

  echo '</select>';
  echo '   ';
  echo '<input type="submit" value="Choisir">';
  echo '</form>';

  // Déconnexion avec la base de données
  $qid = $cnx->prepare($sql);
  $qid->closeCursor();
  $cnx = null;
}

/**************************************
   Menu déroulant des tables "relation"
*/

function menu_tr()
{
  include "conf/connex.inc.php";

  $sql = "select * from dt_class_tables where id_typo_table = 3";
  $qid=$cnx->prepare($sql);
  $qid->execute();
  $alltables=$cnx->query($sql,PDO::FETCH_NUM);

  echo '<form method="POST" action="enrg_relation.php" name="menud">';
  echo '<select name="tables">';
  echo '<option value="Choix">Choisir une table</option>';

  while($result=$alltables->fetch()){
    echo '<option value="'.$result[1].'">'.$result[1].'</option>';
  }

  echo '</select>';
  echo '   ';
  echo '<input type="submit" value="Choisir">';
  echo '</form>';

// Déconnexion avec la base de données
  $qid = $cnx->prepare($sql);
  $qid->closeCursor();
  $cnx = null;
}


/***************************************************
   Liste l'ensemble des tables de la base de données
*/

function liste_tables()
{
  include "conf/connex.inc.php";
  $sql = "show tables";
  assert ('$cnx->prepare($sql)');
  $alltables=$cnx->query($sql,PDO::FETCH_NUM);

  echo 'liste des tables de la base de données';

  while($result=$alltables->fetch()){
  }
  return $result[0];
}


/***********************************************
   fonction SQL : requete qui permet l'insertion
   de données dans une table
   -> fsql : sans afficher la première colonne de la table
   -> fsql_tr : en affichant la première colonne de la table
*/

function fsql($var)
{
  include "conf/connex.inc.php";
  $sql = "SHOW COLUMNS FROM `$var`";
  $qid=$cnx->prepare($sql);
  $qid->execute();

  global $newstr;
  global $new2str;

  while($row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
     $tableau = array($row);
     $a1 = "INSERT INTO $var(";
     foreach ($tableau as $v1) {
       unset($v1['0']);
       foreach ($v1 as $v2) {
	 $newstr .= $v2.',';
	 $new2str .= ':'.$v2.', ';
       }
     }
     $newstr = substr($newstr, 0,-1);
     $a1 .= $newstr;
     $a2 =")";
     $a1 .= $a2;
     $new2str = strtolower(substr($new2str, 0, -2));
     $a3 =" VALUES(";
     $a1 .= $a3;
     $a1 .= $new2str;
     $a4 = ")";
     $a1 .= $a4;
     return $a1;
  }
}

function fsql_tr($var)
{
  include "conf/connex.inc.php";
  $sql = "SHOW COLUMNS FROM `$var`";
  $qid=$cnx->prepare($sql);
  $qid->execute();

  global $newstr;
  global $new2str;

  while($row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {
     $tableau = array($row);
     $a1 = "INSERT INTO $var(";
     foreach ($tableau as $v1) {
//       unset($v1['0']);
       foreach ($v1 as $v2) {
	 $newstr .= $v2.',';
	 $new2str .= ':'.$v2.', ';
       }
     }
     $newstr = substr($newstr, 0,-1);
     $a1 .= $newstr;
     $a2 =")";
     $a1 .= $a2;
     $new2str = strtolower(substr($new2str, 0, -2));
     $a3 =" VALUES(";
     $a1 .= $a3;
     $a1 .= $new2str;
     $a4 = ")";
     $a1 .= $a4;
     return $a1;
  }
}



/****************************************************
   Tableau variable et valeur au format d'une requête
   permettant l'enregistrement des données
   -> ftab($var)
   -> ftab_tr($var)
*/

function ftab($var)
{
  include "conf/connex.inc.php";
  $sql = "SHOW COLUMNS FROM `$var`";
  $qid=$cnx->prepare($sql);
  $qid->execute();

  while($row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {

     $tableau = array($row);
     $nbre = count($tableau[0]);
     $tab2 = array();
     
     foreach ($tableau as $tab1) {
     }

     $tab2 = array_map('strtolower',$tab1);

     for ($i=0;$i<$nbre;$i++) {
     	 $tab3[$i] = ':'.$tab2[$i];
     }

     unset($tab3['0']);

     for($i=0;$i<$nbre;$i++){
         $tab4 = $_POST;
     }

     $tab5 = array_combine($tab3, $tab4);
     return $tab5;
  }
}


function ftab_tr($var)
{
  include "conf/connex.inc.php";
  $sql = "SHOW COLUMNS FROM `$var`";
  $qid=$cnx->prepare($sql);
  $qid->execute();

  while($row=$qid->fetchAll(PDO::FETCH_COLUMN, 0)) {

     $tableau = array($row);
     $nbre = count($tableau[0]);
     $tab2 = array();
     
     foreach ($tableau as $tab1) {
     }

     $tab2 = array_map('strtolower',$tab1);
     
     // print_r($tab2);
     
     for ($i=0;$i<$nbre;$i++) {
     	 $tab3[$i] = ':'.$tab2[$i];
     }

     for($i=0;$i<$nbre;$i++){
         $tab4 = $_POST;
     }
     
     $tab5 = array_combine($tab3, $tab4);
     //print_r($tab5);
     return $tab5;
  }
}


/* Fin du fichier */
?>
