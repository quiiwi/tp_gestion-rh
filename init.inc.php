<?php


$pdo = new PDO('mysql:host=localhost;dbname=salaries', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

session_start();

define('RACINE_SITE', '/PHP/Gestionnaire-personnel/');

$contenu ='';

require_once('fonction.inc.php');