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
  function Exist($con) {
            $stmt = $con->prepare("SELECT nom FROM enseignant 
            WHERE email= :email OR tel = :tel OR ppr= :cne 
            UNION
            SELECT nom FROM etudiant 
            WHERE email= :email OR tel = :tel OR cne= :cne 
            EXCEPT 
            SELECT nom FROM etudiant WHERE id=".$_GET['id']);
            $stmt->execute(array("email" => $_POST['email'],"tel" => $_POST['tel'],"cne" => $_POST['cne'] )); 
            return $stmt->fetchColumn();
        }
        
?>

   
    
   
    
       <?php
    if(isset($_POST['valider'])){
           $nom = $_POST['nom'];
           $pnom = $_POST['pnom'];
           $email = $_POST['email'];
           $tel = $_POST['tel'];
           $cne = $_POST['cne'];
           $fil = $_POST['fil'];
           $password = $_POST['password'];
           if(Exist($connection)){
            echo "<div class='err'> Le PPR ou l'Email ou le Téléphone déja existe </div>";
           }else{
               $sql1 = 'UPDATE etudiant SET nom= :nom, pnom= :pnom, email= :email, tel= :tel, fil =:fil, cne= :cne, password= :password WHERE id=:id'; 
               $statement1 = $connection->prepare($sql1); 
               try{
                   $result = $statement1->execute(array('nom' => $nom, 'pnom' => $pnom, 'email' => $email, 'tel' => $tel, 'fil' => $fil, 'cne' => $cne ,'password' => $password, 'id' => getID($connection)));
                   header("location: etud.php");
               }catch(PDOException $e){
                   echo '<div class="err"> Vérifier les données</div>';
            }
           }
           
           
              
       }
    ?>
  
    <?php

    if(isset($_GET['id'])){
        $sql = 'SELECT id,nom, pnom, email, tel, cne, fil,password FROM etudiant WHERE id= :id ';
        $statement = $connection->prepare($sql);
        $statement->execute(array('id' => $_GET['id']));
        $row = $statement->fetch(PDO::FETCH_BOTH);
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
            <a  class="in" href="etud.php">Etudiant</a>
            <a  href="fil.php">Filière</a>
            <a  href="demande.php">Demande</a>


        </div>
        <div class="modif" style="margin: 10px auto;">
            <h1 style="text-align:center;">Modifier un etuddiant</h1><br>
            <form method="post">
                <table style="margin: 10px auto;">
                    <tr>
                        <td><label>ID : </label></td>
                        <td><input type="text" name="id" value="<?php echo $row[0]; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td><label>NOM : </label></td>
                        <td><input type="text" name="nom" value="<?php echo $row[1]; ?>" required></td>
                    </tr>
                    <tr>
                        <td><label>Prénom : </label></td>
                        <td><input type="text" name="pnom" value="<?php echo $row[2]; ?>" required></td>
                    </tr>
                    <tr>
                        <td><label>Email : </label></td>
                        <td><input type="text" name="email" value="<?php echo $row[3]; ?>" required></td>
                    </tr>
                    <tr>
                        <td><label>Téléphone : </label></td>
                        <td><input type="text" name="tel" value="<?php echo $row[4]; ?>" required></td>
                    </tr>
                    <tr>
                        <td><label>CNE : </label></td>
                        <td><input type="text" name="cne" value="<?php echo $row[5]; ?>" required></td>
                    </tr>
                    <tr>
                        <td><label>Filière : </label></td>
                        <td><input type="text" name="fil" value="<?php echo $row[6]; ?>" required></td>
                    </tr>
                    <tr>
                        <td><label>Mot de passe : </label></td>
                        <td><input type="text" name="password" value="<?php echo $row[7]; ?>" required></td>
                    </tr>
                    <tr>
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
                location.href = "etud.php";
            }
        </script>
    </body>
</html>
