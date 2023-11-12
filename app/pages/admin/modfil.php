<?php 
     require_once('../../ScriptPhp/connection.php');
?>

<?php 
    function getID($connection){
        $id = $_GET['id'];
        return $id;
    }
?>


<!doctype html>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="../../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">

    </head>
   
   <?php

    if(isset($_GET['id'])){
        $sql = 'SELECT id,nom, c_nom FROM filiere WHERE id= :id ';
        $statement = $connection->prepare($sql);
        $statement->execute(array('id' => $_GET['id']));
        $row = $statement->fetch(PDO::FETCH_BOTH);
    }
    ?>
      <?php 
  function Exist($con) {
            $stmt = $con->prepare("SELECT * FROM filiere WHERE nom= :nom OR c_nom = :c_nom EXCEPT SELECT * FROM filiere WHERE id=".$_GET['id']);
            $stmt->execute(array("nom" => $_POST['nom'],"c_nom" => $_POST['c_nom'] )); 
            return $stmt->fetchColumn();
        }
        
?>
       <?php
    if(isset($_POST['valider'])){
        $nom = $_POST['nom'];
        $c_nom = $_POST['c_nom'];
        if(Exist($connection)){
            echo '<div class="err"> Filière ou Nom complet du filière déja existe</div>';
        }
        else {
            $sql1 = 'UPDATE filiere SET nom= :nom, c_nom= :c_nom WHERE id=:id'; 
            $statement1 = $connection->prepare($sql1); 
           
                try{
            $result = $statement1->execute(array('nom' => $nom, 'c_nom' => $c_nom, id => $_GET['id']));
            header("location: fil.php");
        }catch(PDOException $e){
            echo '<div class="err"> Vérifier les données</div>';
        }
         
            } 
  
       }
    ?>
  
    
    <body>
        <header>
            <div class="alle">
                <h1><a href="index.php">AdminUPPA</a><span class="orange">.</span></h1>
                <nav>
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="../../ScriptPhp/logout.php">Déconnexion</a></li>
                    </ul>
                </nav>
            </div>         
        </header>
        <div  class="toplog" >
            <a  href="admin.php">Statistique</a>
            <a  href="enseig.php">Enseignant</a>
            <a  href="fonc.php">Fonctionnare</a>
            <a  href="etud.php">Etudiant</a>
            <a  class="in" href="fil.php">Filière</a>
            <a  href="demande.php">Demande</a>


        </div>
        <div class="modif" style="margin: 10px auto;">
            <h1 style="text-align:center;">Modifier un filière</h1><br>
            
            <form method="post" >
                <table style="margin: 10px auto;">
                    <tr>
                        <td><label>ID</label></td>
                        <td><input type="text" name="id" value="<?php echo $row[0]; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td><label>Filière</label></td>
                        <td><input type="text" name="nom" value="<?php echo $row[1]; ?>" required></td>
                    </tr>
                    <tr>
                        <td><label>Nom complet</label></td>
                        <td><input type="text" name="c_nom" value="<?php echo $row[2]; ?>" required></td>
                    </tr>
                    
                    <tr>
                        <td></td>
                        
                        <td colspan="2">
                            <button style="float:right;" type="button" name="quitter" class="button-10" onclick="link()">Quitter</button>
                            <button style="float:right;" type="submit" name="valider" class="button-9">Valider</button>
                        </td>
                    </tr>
                </table>
            </form>
            
        </div>
        
                       
        <script>
            function link(){
                location.href = "fil.php";
            }
        </script>
    </body>
</html>
