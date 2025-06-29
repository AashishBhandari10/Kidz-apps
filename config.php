<?php
$host = 'localhost';
$db   = 'kidz_apps';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// API keys and other configurations
define('GOOGLE_MAPS_API_KEY', 'AIzaSyALNrrms42EKXpYrAuXs_EC3Scr9TrxHrY');
define('YOUTUBE_API_KEY', 'AIzaSyAhFAQ_EfxJrc2Qx-Bl9Nzu2HKLD2jhuUA');
define('MAILCHIMP_API_KEY', '640278db6278414cee8f61c7b7ad3f6c-us10');
?>