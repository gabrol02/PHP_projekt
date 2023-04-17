<?php

?>
<nav class="navbar navbar-expand-lg navbar-dark sticky">
  <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarNav">
    <ul class="navbar-nav nav-pills">
      <?php
        foreach($menupontok as $key => $value) {
            $active = '';
            if(isset($_REQUEST['page']) and $_REQUEST['page'] == $key) $active = 'active';
            if($key == 'felhasznalo') $key.='&action='.$action;
            ?><li class="nav-item ">
            <a class="nav-link  text-danger <?php echo $active; ?> " href="index.php?page=<?php echo $key; ?>"><?php echo $value; ?></a> </li>           
        <?php 
        }
        ?>
    
    </ul>
    <form action="index.php?page=searchedUser" method="post" class="form-inline my-2 my-lg-0" name="searchedform">
      <input class="form-control mr-sm-2" type="search" name="searched" placeholder="Felhasználó keresése" aria-label="Search" required>
      <button class="btn btn-dark bg-dark  my-2 my-sm-0" type="submit">Keresés</button>

    
    </form>
  </div>
</nav>