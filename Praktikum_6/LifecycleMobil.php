<?php
class Mobil {
    public $merk;
    public $warna;

    public function __construct($merk, $warna) {
        $this->merk = $merk;
        $this->warna = $warna;
        echo "Mobil $this->merk dengan warna $this->warna telah dibuat.<br>";
    }

    public function jalankan() {
        echo "Mobil $this->merk sedang berjalan.<br>";
    }

    public function __destruct() {
        echo "Mobil $this->merk telah dihentikan dan dihapus dari memori.<br>";
    }
}

$mobil1 = new Mobil("Toyota", "Merah");
$mobil1->jalankan();
?>