<?php

################################################################################
# ime   : menu.php
# opis  : Script for generation navbar
# autor : Benjamin Babić
# datum : 06/06/2023
################################################################################

echo '
<nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #16113A">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="img/logo-white.svg" height="32"  alt=""/>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                                               
				<li class="nav-item">
                    <a class="nav-link active" href="index.php?what=songs">
                        <i class="fas fa-music"></i> Songs
                    </a> 
                </li>
                
              	<li class="nav-item">
                    <a class="nav-link active" href="index.php?what=users">
                        <i class="fas fa-music"></i> Users
                    </a> 
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="index.php?what=artists">
                        <i class="fas fa-id-card"></i> Artists
                    </a> 
                </li>
                
                <li class="nav-item">                    
                    <a class="nav-link active" href="index.php?what=albums">
                        <i class="fas fa-book"></i> Albums
                    </a>      
                </li>
                
                <li class="nav-item">                    
                    <a class="nav-link active" href="index.php?what=genres">
                        <i class="fas fa-atom"></i> Genres
                    </a>                    
                </li>      
                
                <li class="nav-item">                    
                    <a class="nav-link active" href="index.php?what=podcast_categories">
                        <i class="fas fa-atom"></i> Podcast categories
                    </a>                    
                </li>               
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-tools"></i> Settings
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown01">
                        <li><a class="dropdown-item" href="index.php?what="><i class="fas fa-question"></i> Česta pitanja</a></li>                                           
                    </ul>
                </li>       

                <li class="nav-item">
                    <a class="nav-link active" href="logout.php" onclick="return confirm(\'Are you sure you want to log out?\')">
                        <i class="fas fa-power-off"></i> Log out
                    </a>
                </li>                  
            </ul>
            <form method="POST" action="" class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search term..." aria-label="Search" name="search">
                <button class="btn btn-outline-light" type="submit" name="btn_search">Search</button>
            </form>
        </div>
    </div>
</nav>';


?>