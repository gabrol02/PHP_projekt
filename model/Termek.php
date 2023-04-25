<?php
class Termek {
    
    private $termekek_id;
    private $termek_nev;
    private $termek_tipus;
    private $termek_ar;
    
    public function set_termek($termekek_id, $conn) {
        // adatbázisból lekérdezzük
        $sql = "SELECT termekek_id, termek_nev, termek_tipus, termek_ar   FROM termek";
        $sql .= " WHERE termekek_id = $termekek_id ";
        $result = $conn->query($sql);
        if ($conn->query($sql)) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->termekek_id = $row['termekek_id'];
                $this->termek_nev = $row['termek_nev'];
                $this->termek_tipus = $row['termek_tipus'];
                $this->termek_ar = $row['termek_ar'];
                
                
            }
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // építsük fel az összes get metódust
    public function get_termek_nev() {
        return $this->termek_nev;
    }

    public function get_termek_tipus() {
        return $this->termek_tipus;
    }

    public function get_termek_ar() {
        return $this->termek_ar;
    }
    
    public function get_termekek_id() {
        return $this->_termekek_id;
    }
    
    public function termekekLista($conn) {
        $lista = array();
        $sql = "SELECT termekek_id FROM termek";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['termekek_id'];
                }
            }
        }
        return $lista;
    }   
}
?>