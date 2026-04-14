<?php
class Mobil {
    public function maju() {
        echo "Mobil bergerak maju";
    }

    public function berhenti() {
        echo "Mobil berhenti";
    }

    public function belok($arah) {
        echo "Mobil berbelok ke " . $arah;
    }
}

$myCar = new Mobil();
$myCar->maju();
$myCar->berhenti();
$myCar->belok("kanan");
?>