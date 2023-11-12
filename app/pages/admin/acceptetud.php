
<?php
// l'acceptation du étudiant inscrit 

    require_once('../../ScriptPhp/connection.php');
            echo $_GET['id'];
           $sql1 = 'UPDATE etudiant SET demande = 1 WHERE id= :id AND demande = 0'; 
          $statement1 = $connection->prepare($sql1); 
           $result1 = $statement1->execute(array('id' => $_GET['id']));
                if($result1 ){
                    header ("location: demande.php");
            } else {
              echo 'not ';
            }


            
   
    ?>