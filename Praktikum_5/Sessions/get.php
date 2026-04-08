<?php
session_start(); // Memastikan sesi dimulai

if (isset($_SESSION['username']) && isset($_SESSION['favorite_color'])) {
    echo "Username: " . $_SESSION['username'] . "<br>";
    echo "Warna Favorit: " . $_SESSION['favorite_color'];
} else {
    echo "Session belum diatur.";
}
?>