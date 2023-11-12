    <?php
//la suppresion des filières
     require_once('../../ScriptPhp/connection.php');
 
            $sql1 = 'DELETE FROM filiere WHERE id = :id';
            $statement1 = $connection->prepare($sql1);
            $result = $statement1->execute(array('id' => $_GET['id']));
            header ("Location: fil.php");
            
        
          
    
        
    ?>