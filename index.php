
        
<?php

session_start();
require 'includes/db.inc.php';
// default oldal
$page = 'index';
$_SESSION['kosarid']='';
$_SESSION['modosit']='';
$category="";
$title='';
$szoveg = "Belépés";
$action = "login"; 
 if(isset($_REQUEST['page'])) {
        if(file_exists('controller/'.$_REQUEST['page'].'.php')) {
                $page = $_REQUEST['page']; 
        }
}

if(isset($_REQUEST['kosarid'])){
                $_SESSION['kosarid']=$_REQUEST['kosarid'];
                $page = "kosar"; 
                $title=$_REQUEST['kosarid'];
}

if(isset($_REQUEST['modositid'])){
        $_SESSION['modositid']=$_REQUEST['modositid'];
        $page = "kosar";
        $title=$_REQUEST['modositid'];
}

$menupontok = array(    'index' => "Főoldal",
                        $action => $szoveg,
                        'registration' => "Regisztráció"
        ); 
// ki vagy be vagyok lépve?
if(!empty($_SESSION["felhasznalo_id"])) {
        $szoveg = "Kilépés ";
        $action = "logout";
        $fo="Profil: ".$_SESSION["nev"];
        $sql="SELECT felhasznalo_id FROM admin WHERE felhasznalo_id='".$_SESSION['felhasznalo_id']."'";
                if(!$result = $conn->query($sql)) echo $conn->error;
                if($result->num_rows > 0){
                        $menupontok = array(    
                                'index' => "Főoldal", 
                                'upload'=>"Áru feltöltés",
                                'admin'=>"Admin",
                                'kosar'=>"Kosár",
                                $action => $szoveg
                
        );
                }else{
                        $menupontok = array(    
                        'index' => "Főoldal", 
                        'upload'=>"Áru feltöltés",
                        'kosar'=>"Kosár",
                        $action => $szoveg
        
);  
                }
               
        
}

if(array_key_exists($page,$menupontok)){
        $title = $menupontok[$page];
        
}

// router

        
include 'includes/htmlheader.inc.php';
require 'model/Users.php';
require 'model/Termek.php';
require 'model/Kosar.php';
require 'model/Tipus.php';
$tanulo=new Users;
$termek=new Termek;
$kosar=new Kosar;
$tipus=new Tipus;
$tipusIds=$tipus->tipusLista($conn);
$termekIds=$termek->termekekLista($conn);
$kosarIds=$kosar->kosarLista($conn);
?>


<body>
<?php
include 'includes/menu.inc.php';
include 'controller/'.$page.'.php';
?>
</body>
</html>