<?php
class Users {
    
    private $felhasznalo_id;
    private $nev;
    private $jelszo;
    private $emailcim;
    private $iranyitoszam;
    public function set_user($felhasznalo_id, $conn) {
        // adatbázisból lekérdezzük
        $sql = "SELECT felhasznalo_id, nev, jelszo, emailcim, iranyitoszam  FROM felhasznalo";
        $sql .= " WHERE felhasznalo_id = $felhasznalo_id ";
        $result = $conn->query($sql);
        if ($conn->query($sql)) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->felhasznalo_id = $row['felhasznalo_id'];
                $this->nev = $row['nev'];
                $this->jelszo = $row['jelszo'];
                $this->emailcim = $row['emailcim'];
                $this->iranyitoszam = $row['iranyitoszam'];
                
            }
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // építsük fel az összes get metódust
    public function get_nev() {
        return $this->nev;
    }

    public function get_jelszo() {
        return $this->jelszo;
    }

    public function get_emailcim() {
        return $this->emailcim;
    }
    
    public function get_felhasznalo_id() {
        return $this->_felhasznalo_id;
    }
    public function get_iranyitoszam() {
        return $this->_iranyitoszam;
    }
    public function felhasznaloLista($conn) {
        $lista = array();
        $sql = "SELECT felhasznalo_id FROM felhasznalo";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['felhasznalo_id'];
                }
            }
        }
        return $lista;
    }   
}
?>