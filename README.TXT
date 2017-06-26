Dugong base de données
Cette application est sous licence
GNU Affero General Public License, 2016
https://www.gnu.org/licenses/agpl.html

Version 0.1 (Septembre 2016)

Réalisé par Wilfrid NIOBET
email : wilfrid@loblique.org
site web : http://loblique.org

Préalable:

	Il est nécessaire d'avoir installé un serveur Web
	par exemple Apache, Nginx.

	Il est nécessaire d'avoir installé php5 et de l'avoir
	activité sur le serveur Web

	Il est nécessaire d'avoir accès a une base de données
	pour pouvoir l'administrer via cette interface

Installation:

	Récupérez les sources de l'application à l'adresse suivante:
	http://loblique.org

	Décompressez l'archive contenant les sources du programme
	dans le répertoire courant de votre serveur Web
	exemple sous linux: /var/wwww/http/
	exemple sous Mac OSX: /Library/WebServer/Documents/

	Copiez le fichier conf/connex.inc.php.original en lui
	donnant le nom conf/connex.inc.php
	exemple : cp conf/connex.inc.php.original conf/connex.inc.php

	Modifiez le fichier conf/connex.inc.php avec les valeurs
	qui conviennent:
	    $serveur = "localhost"; // adresse du serveur de la base
	    	     de donnée ("localhost" est fortement conseillé)
	    $user = "";  // nom du compte utilateur de la base de données
	    $passwd = ""; // mot de passe de l'utilisateur
	    $bdd = ""; // nom de la base de données
	    $port="3306"; // port réseau de l'accès à la base de
	    	     données (MySQL = "3306")

	Votre application est installé !

	Testez là en ouvran votre navigateur Web et en tapant
	l'adresse suivante : http://localhost/dugong
	
N'hésitez pas à me contacter si vous rencontrez un problème.
