<?php
  include "conf/connex.inc.php";
  $menu="enregistrement";
  require_once ("head.inc.php");
  require_once ("menu.inc.php");

  echo "<br/>Enregistrer les données <br/> Choisissez la table de la base de données : ";

  $sql = "show tables";
  assert ('$cnx->prepare($sql)');
  $alltables=$cnx->query($sql,PDO::FETCH_NUM);

  $tables = isset($_POST['tables']) ? $_POST['tables'] : NULL;
  echo '<form method="POST" action="enregistrement.php">';
  
  echo '<select name="tables">';

     while($result=$alltables->fetch()){
	  echo '<option value="'.$result[0].'">'.$result[0].'</option>';
     }

  echo '</select>';
  echo '   ';
  echo '<input type="submit" value="Choisir">';
  echo '</form>';
  
  // $tables = $_POST['tables'];
  // echo $_POST["tables"]."<br/>";
  echo $tables;
  // echo 'Vous voulez enregistrer une lettre';

  if (isset ($_POST["tables"]) && $_POST["tables"]=="Lettre") { ?> 
  <p>Vous voulez enregistrer une <?php echo $_POST["tables"]; ?></p>

  <form method="POST" action="test.php">
  <table border="1">
    <tr>
        <td>La cote :</td>
        <td><input type="text" name="cote" ></td>
    </tr>
    <tr>
	<td>L'année de la lettre (nombre) :</td>
	<td><input type="text" name="lettre_annee"></td>
    </tr>
    <tr>
	<td>Le mois de la lettre (nombre) :</td>
	<td><input type="text" name="lettre_mois" ></td>
    </tr>
    <tr>
	<td>Le jour de la lettre (nombre) :</td>
	<td><input type="text" name="lettre_jour" ></td>
    </tr>
    <tr>
	<td>Citation sur la date :</td>
	<td><input type="text" name="cit_date_lettre"></td>
    </tr>
    <tr>
	<td>Approbation du roi :</td>
	<td><input type="text" name="app_roi"></td>
    </tr>
    <tr>
	<td>Citation sue l'approbation :</td>
	<td><input type="text" name="cit_app_roi"></td>
    </tr>
    <tr>
	<td><input type="submit" value="Enregistrer"></td>
    </tr>
   </table>
  </form>

  <?php };


//  if (isset ($_POST["tables"]) && $_POST["tables"]=="Lettre"){
//  echo 'Vous voulez enregistrer une lettre';
//  }

// Déconnexion avec la base de données
  $qid = $cnx->prepare($sql);
  $qid->closeCursor();
  $cnx = null;

// Bas de page
  require_once ("footer.inc.php");
?>
