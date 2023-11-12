    <?php
// la suppression des étudiants
     require_once('../../ScriptPhp/connection.php');
 
            $sql1 = 'DELETE FROM etudiant WHERE id = :id';
            $statement1 = $connection->prepare($sql1);
            $result = $statement1->execute(array('id' => $_GET['id']));
            header ("Location: etud.php");
            
        
          
    
        
    ?>