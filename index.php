<?php
   require('head.inc.php');
   require('menu.inc.php');
?>
    
    <!- Texte d'accueil -->
			  
   <div align="justify">
   <p>Bienvenue sur l'application de gestion des données dans une base de données scientifiques.</p>
   <p>Vous pouvez enregistrer des données en respectant l'organisation des tables afin de faciliter la saisi et la cohérence des données.</p>
   <p>Les tables sont organisées selon trois types : les tables principales, les tables liées et les tables de relations.</p>
   <ul class="corps">
    <li class="corps"> les tables principales ne possède aucune clef étrnagère ;</li>
    <li class="corps"> les tables liées possède au moins une clef étrangère, de fait elles sont liées à au moins une autre table ;</li>
    <li class="corps"> les tables de relations (dites "tables relations") sont des tables qui dynamisent la relation entre deux autres tables. La clef primaire de ces tables est composée respectivement des deux clefs étrangères qui la composent. Cela permet d'assurer non seulement les relations avec les tables associées et l'intégrité des données évitant ainsi les doublons.</li>
   </ul>
   <br />
   </div>
   
   <!-- FIN du texte d'accueil -->

  </td>
</tr>
<?php
   require('footer.inc.php');
?>
