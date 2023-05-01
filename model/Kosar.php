<?php
class Kosar {
    
    private $kosar_id;
    private $felhasznalo_id;
    private $termek_id;
    private $mennyiseg;
    
    public function set_kosar($kosar_id, $conn) {
        // adatbázisból lekérdezzük
        $sql = "SELECT kosar_id, felhasznalo_id, termek_id, mennyiseg   FROM kosar";
        $sql .= " WHERE kosar_id = $kosar_id ";
        $result = $conn->query($sql);
        if ($conn->query($sql)) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->kosar_id = $row['kosar_id'];
                $this->felhasznalo_id = $row['felhasznalo_id'];
                $this->termek_id = $row['termek_id'];
                $this->mennyiseg = $row['mennyiseg'];
                
                
            }
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // építsük fel az összes get metódust
    public function get_kosar_felhasznalo_id() {
        return $this->felhasznalo_id;
    }

    public function get_kosar_termek_id() {
        return $this->termek_id;
    }

    public function get_kosar_mennyiseg() {
        return $this->mennyiseg;
    }
    
    public function get_kosar_id() {
        return $this->kosar_id;
    }
    
    public function kosarLista($conn) {
        $lista = array();
        $sql = "SELECT kosar_id FROM kosar";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['kosar_id'];
                }
            }
        }
        return $lista;
    }   
}
?>