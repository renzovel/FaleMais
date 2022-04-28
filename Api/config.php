<?php
//Configuracao url local (dentro do docker)
define('localURL', "http://localhost:80");
//Configuracao url local fora do docker
define('publicURL', "http://localhost:8080");
//Configuracao da base de dados
define('DBHOST','db'); //nome da rede em docker
define('DBDATABASE','falemaisdb'); //nome da base de dados em docker
define('DBUSER','root'); //usuario da do mysql em docker
define('DBPASSWORD','root'); // password  do mysql em docker









//carregamos os routers
require(__DIR__."/route.php");
//carregamos as configuracoes da base de dados
require(__DIR__."/database.php");