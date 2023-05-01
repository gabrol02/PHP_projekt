<?php
class Tipus {
    
    private $termek_tipus_id;
    private $tipus_id;
    
    public function set_tipus($termek_tipus_id, $conn) {
        // adatbázisból lekérdezzük
        $sql = "SELECT termek_tipus_id, tipus_id  FROM termek_tipus";
        $sql .= " WHERE termek_tipus_id = $termek_tipus_id ";
        $result = $conn->query($sql);
        if ($conn->query($sql)) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->termek_tipus_id = $row['termek_tipus_id'];
                $this->tipus_id = $row['tipus_id'];
              
                
                
            }
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // építsük fel az összes get metódust
    public function get_tipus() {
        return $this->tipus_id;
    }

    public function get_termek_tipus_id() {
        return $this->termek_tipus_id;
    }


    
    public function tipusLista($conn) {
        $lista = array();
        $sql = "SELECT termek_tipus_id FROM termek_tipus";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['termek_tipus_id'];
                }
            }
        }
        return $lista;
    }   
}
?>