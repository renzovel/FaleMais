<?php
//Configuracao url local (dentro do docker)
define('localURL', "http://localhost:80");
//Configuracao url local fora do docker
define('publicURL', "http://localhost:8080");
//Configuracao da base de dados
define('DBHOST','db');
define('DBDATABASE','falemaisdb');
define('DBUSER','root');
define('DBPASSWORD','root');










require(__DIR__."/route.php");
require(__DIR__."/database.php");