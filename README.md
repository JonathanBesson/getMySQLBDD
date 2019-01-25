# getMySQLBDD
Lightweight script to get our BDD without phpMyAdmin or others (MySQLi method) based on (crazydiver_e2)[https://www.developpez.net/forums/d135268/php/php-base-donnees/php-mysql/copie-base-donnees-php/]

**source** : https://www.developpez.net/forums/d135268/php/php-base-donnees/php-mysql/copie-base-donnees-php/

## How to use ?
  1 · **Set** our database security informations in `SQLConnect.php`
```
    $host   = "localhost";
    $userdb = "root";
    $passdb = "root";
    $dbname = "my_database";
```
  2 · **Launch** script on our server to grab the right database !
  
  3 · **Import** the generated file (_located in script's folder_) in our **phpMyAdmin**

  4 · **take a rest** ! 


