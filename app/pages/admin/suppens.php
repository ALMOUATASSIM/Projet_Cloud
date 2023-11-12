    <?php
// le refus du enseignant ou fonctionnaire inscrit 

     require_once('../../ScriptPhp/connection.php');
 
            $sql1 = 'DELETE FROM enseignant WHERE id = :id';
            $statement1 = $connection->prepare($sql1);
            $result = $statement1->execute(array('id' => $_GET['id']));
            header ("Location: demande.php");

           
        
          
    
        
    ?>