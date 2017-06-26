<?php
  session_start();
  include ('./conf/connex.inc.php');
  include ('fonctions.inc.php');
  $menu="enregistrement";
  require_once ("head.inc.php");
  require_once ("menu.inc.php");

  $tables = $_SESSION["tables"];

  $id = defid2($tables);

  $newstr = isset($newstr) ? $newstr : NULL;
  $new2str = isset($new2str) ? $new2str : NULL;
  
  $sql2=fsql($tables);
  $tab=ftab($tables);
  $req=$cnx->prepare($sql2);

  $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $cnx->beginTransaction();
  $req->execute($tab);
  $lastId = $cnx->lastInsertId();
  $cnx->commit();

  menu_tp($tables);

  echo "<br />";
  echo "Les données de la table \"$tables\" ont bien été ajoutés !";

  echo "<br />";
  print "Enregistrement n° $lastId";

  echo "<br /><br />";
  denrg2($tables);

require_once ("footer.inc.php");
?>