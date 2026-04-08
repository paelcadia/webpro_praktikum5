<?php
require_once 'start.php'; // Memastikan sesi dimulai

$_SESSION['username'] = 'JohnDoe';
$_SESSION['favorite_color'] = 'Blue';

echo "Session telah diset.";
?>