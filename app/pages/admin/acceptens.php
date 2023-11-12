       <?php

// l'acceptation du enseignant ou fonctionnaire inscrit 

    require_once('../../ScriptPhp/connection.php');
            
           $sql1 = 'UPDATE enseignant SET demande = 1 WHERE id=:id AND demande = 0'; 
          $statement1 = $connection->prepare($sql1); 
           $result1 = $statement1->execute(array('id' => $_GET['id']));
                if($result1 ){
                header ("location: demande.php");
            } else {
              echo 'not ';
            }


            
   
    ?>