<?php


     $dbHost = "db";
     $dbName = "annuaireuppa";
     $dbUsername = "user";
     $dbUserpassword = "password";
    
    
  
       
            try
            {
                $connection = new PDO("mysql:host=" . $dbHost . ";dbname=" . $dbName , $dbUsername, $dbUserpassword);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
       
   
    
    
        

?>
