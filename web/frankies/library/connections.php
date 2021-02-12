<?php

function frankiesFarmConnect(){
try
{
  $dbUrl = getenv('DATABASE_URL');


  if (!isset($dbUrl) || empty($dbUrl)) {
    // example localhost configuration URL with 
    // user: "my_username"
    // password: "my_password"
    // database: "my_database"

    // hardcoded for debugging only not for production site
    $dbUrl = "postgres://kqlogdxvtdybra:3d394e8eb2b52a0af91c902e014f6f1fe7d78e7415ea2ed1d652d89f9fb5f4f7@ec2-54-85-13-135.compute-1.amazonaws.com:5432/d3ta6ofia64hs4";
}
  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}
return $db;
}


?>