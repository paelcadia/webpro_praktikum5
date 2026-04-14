<?php
class Kendaraan {
    public $merk;
    public $warna;

    public function tampilkanInfo() {
        return "Kendaraan ini adalah $this->merk dengan warna $this->warna.";
    }
}
?>
