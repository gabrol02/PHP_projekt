<?php

if(empty($_SESSION['search'])){
    header('Location: index.php?page=index');
}


include 'view/searchedTermek.php';
    ?>