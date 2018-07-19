sitewatch
=========

Scénario :

Créer un ftp pour les associations avec un répertoire ou ils doivent déposé les fichiers : /home/assocName/In/file_date.xlsx
Créer un répertoire tmp ou le le fichier csv est temporairemnt déplacéé  : /home/assocName/tmp/file_date.csv
Créer un répertoire back ou le le fichier .xslx est définitivementt stocké  : /home/assocName/back/file_date.xlsx




Le client dépose un fichier sur un ftp .

Le cron vérifie la présence du fichier sur le ftp . ( mettre en place un service qui vérifie la présence d'un nouveau fichier )

Si oui le traitement est lancé :

conversion du fichier du format xlsx au format ( csv ou JSON ) .

déplacement du fichier csv vers un répertoire tomporaire

déplacement du fichier xsls vers un emplacement d'archivage .

Faire les traitement à partir du fichier csv pour insérer dans une bdd .

Creer un service Symfony :   ( https://openclassrooms.com/courses/2078536-developpez-votre-site-web-avec-le-framework-symfony2-ancienne-version/2080362-les-services-theorie-et-creation )
--------------------------

Créer une commande :
---------------------

http://www.tutoriel-symfony2.fr/blog/comment-creer-une-commande-symfony

https://openclassrooms.com/forum/sujet/symfony2-lire-fichier-excel

http://www.ustrem.org/en/articles/reading-xls-with-php-en/

https://dyrk.org/2016/03/08/php-quelques-lignes-qui-transforme-un-fichier-excel-en-extract-csv/   ----------- top

https://www.phpclasses.org/package/7965-PHP-Convert-data-from-Excel-spreadsheet-to-JSON-format.html à voir .....

https://alain-sahli.developpez.com/tutoriels/php/ez/publish/administration/

<!-- Source : https://jsfiddle.net/jlevaillant/6w5ju52v/11/?utm_source=website&utm_medium=embed&utm_campaign=6w5ju52v -->
<!-- https://jolicode.com/blog/une-fenetre-modale-accessible -->

// curl -i -H "Content-Type: application/json" -X POST -d '{"recherche":"jean v", "traitementApplication":"Ecran saisie commandes", "typeAction":"01",  "codeApplication":"01"}' http://rcu.onisep.fr:8080/rcuWS/service/client/etablissements/
