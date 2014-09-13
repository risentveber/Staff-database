<?php
if (!isset($_SERVER['PHP_AUTH_USER']) ||
    !isset($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_PW'] != "rootp" || ($_SERVER['PHP_AUTH_USER']) != "root"){
  header('HTTP/1.1 401 Unauthorized');
  header('WWW-Authenticate: Basic realm="Administration"');
  exit("You need a valid username and password to be here. " .
       "Move along, nothing to see.");
}
?>