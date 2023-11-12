    <?php
// la suppression des enseignant
     require_once('../../ScriptPhp/connection.php');
 
            $sql1 = 'DELETE FROM enseignant WHERE id = :id';
            $statement1 = $connection->prepare($sql1);
            $result = $statement1->execute(array('id' => $_GET['id']));
            header ("Location: enseig.php");
            
        
          
    
        
    ?>