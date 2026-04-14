<?php
class Mobil {
    public $warna;       
    private $merek;      
    protected $ukuran;   

    
    public function __construct($warna, $merek, $ukuran) {
        $this->warna = $warna;
        $this->merek = $merek;
        $this->ukuran = $ukuran;
    }

        public function getMerek() {
        return $this->merek;
    }
}

// Membuat objek
$mobilBaru = new Mobil("Merah", "Toyota", "Sedang");
echo "Warna mobil: " . $mobilBaru->warna;
?>