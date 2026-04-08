<?php
setcookie("user", "", time() - 3600, "/"); // Set waktu kadaluarsa di masa lalu
echo "Cookie telah dihapus.";
?>