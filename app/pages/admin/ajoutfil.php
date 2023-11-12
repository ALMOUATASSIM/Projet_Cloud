<?php
// ajout des filière
    session_start(); 
    require_once('../../ScriptPhp/connection.php');
?>
<?php
    function verify($email,$table,$con){
        
        $sqln = 'SELECT email FROM '.$table.' WHERE email = :email';            
            $statementn = $con->prepare($sqln);
            $statementn->execute(array('email' => $email));
            $countn = $statementn->rowCount();
            if($countn>0){
                return true;
            }else{
                return false;
            }
    }
?>
<?php          
            if(isset($_POST['valider'])) {
                
                
                    $nom         =      $_POST['nom'];
                    $c_nom       =      $_POST['c_nom'];
                    if($nom == "" || $c_nom == ""){
                        echo '<div class="err"> Remplir les champs</div>';
                    }else{
                        
                    
                
                    $sql = "INSERT INTO filiere(nom, c_nom) VALUES (?, ?)";    
                    $statement = $connection->prepare($sql);
                try{
                    $result = $statement->execute(array($nom, $c_nom)); 
                    header("location: fil.php");
                
                }catch (PDOException $e){
                    echo '<div class="err"> Vérifier les données</div>';
                }
                    
            }
            }
                
        ?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Admin</title>
        <link rel="stylesheet" href="../../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">
       
    </head>
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
            <h1 style="text-align:center;">Ajouter une filière</h1><br>
            <form method="post" action="ajoutfil.php">
                <table style="margin: 10px auto;">
                    <tr>
                        <td><label>Filière</label></td>
                        <td><input type="text" name="nom" placeholder="Filère..." required></td>
                    </tr>
                    <tr>
                        <td><label>Nom complet</label></td>
                        <td><input type="text" name="c_nom" placeholder="Nom complet du filière..." required></td>
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
        <script src="../../js/script.js"></script>
        
        
        
        
        
        
        
        
        
        
        
        
    
    </body>
</html>