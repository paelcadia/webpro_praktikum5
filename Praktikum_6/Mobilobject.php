<?php
class Mobil {
    public $warna;

    
    public function setWarna($warna) {
        $this->warna = $warna;
    }

    public function getWarna() {
        return $this->warna;
    }
}

$mobil1 = new Mobil();
$mobil1->setWarna("Merah");
$mobil2 = new Mobil();
$mobil2->setWarna("Biru");

echo "Warna mobil pertama : " . $mobil1->getWarna() . "<br>";
echo "Warna mobil kedua : " . $mobil2->getWarna();
?>