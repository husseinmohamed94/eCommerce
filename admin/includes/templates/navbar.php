<nav class="navbar navbar-expand-lg navbar-light  navbar-dark bg-dark">
<div class="container">
  <a class="navbar-brand" href="deshbord.php"> <?php    echo lang('HOME_ADMIN') ?>    </a>
 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainnav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="mainnav">
    <ul class="navbar-nav ">

     <li class="nav-item">
        <a class="nav-link" href="categories.php"> <?php    echo lang('categories') ?></a>
      </li>
 <li class="nav-item"> <a class="nav-link" href="items.php"> <?php    echo lang('ITEMS') ?></a></li>
        
        <li class="nav-item"><a class="nav-link" href="members.php"> <?php    echo lang('MENBERS') ?></a></li>
        <li class="nav-item">  <a class="nav-link" href="comments.php"> <?php    echo lang('COMMENTS') ?></a></li>
      
      </ul>
        <ul class="nav navbar-nav ml-auto">
   
      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" href="#" id="mainnav" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo  $_SESSION['Username'] ;?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item"  href = "../index.php">visit shop</a>
          <a class="dropdown-item" href="members.php?action=Edit&UserId=<?php echo $_SESSION['ID'] ?>">Edit prefille</a>
          <a class="dropdown-item" href="#">setting</a>
          <a class="dropdown-item" href="logout.php">logout</a>
        
      </li>

    </ul>
  </div>
  </div>
</nav>