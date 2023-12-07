<?php

################################################################################
# ime   : Logout.PHP                                                             
# opis  : Skripta za logout iz sustava     
# autor : Ivan Bozajic                                                        
# datum : 02/2023                                                        
################################################################################

session_start();

session_destroy();

header("Location: index.php");

exit;

?>