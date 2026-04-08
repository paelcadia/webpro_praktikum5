<?php
setcookie("user", "John Doe", time() + (86400 * 30), "/"); // Cookie berlaku selama 30 hari
echo "Cookie telah diset.";
?>