<?php
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
$pdo=connectToEncryptedMySQL("/etc/apache2/data-design/cpaul9.ini");
require_once("profile.php");


$profile = new Profile (null,1,"this is from PHP");
$profile->insert($pdo);
$profile->setprofilecontent("now i changed the message");
$profile->update($pdo);
$profile->delete($pdo);

