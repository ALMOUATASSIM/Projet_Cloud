<?php 
     require_once('../../ScriptPhp/connection.php');
?>
<?php 
// une fonction qui retoure le nombre des ligne dans chaque table (on saiaie le requête d'affichage du table dans $sql)
    function rowCount($con,$sql){
        $statement = $con->prepare($sql);  
        $statement->execute();
        return $statement->rowCount();
    }
?>
<!doctype html>
<html>
    <head>
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
            <a class="in" href="admin.php">Statistique</a>
            <a  href="enseig.php">Enseignant</a>
            <a  href="fonc.php">Fonctionnare</a>
            <a  href="etud.php">Etudiant</a>
            <a  href="fil.php">Filière</a>
            <a  href="demande.php">Demande</a>
        </div>
        <div>
            <table class="stati">
                <tr>
                    <th><a href="enseig.php"><img  src="../../images/en.png"> <br>Enseignant</a></th>
                    <th><a href="fonc.php"><img  src="../../images/fonc.png"> <br>Fonctionnaire</a></th>
                    <th><a href="etud.php"><img  src="../../images/et.png"> <br>Etudiant</a></th>
                    <th><a href="fil.php"><img  src="../../images/fil.png"> <br>Filière</a></th>
                    <th><a href="demande.php"><img  src="../../images/dem.png"> <br>Demande</a></th>
                </tr>
                <tr>
                    <td><?php echo rowCount($connection,'SELECT * FROM etudiant WHERE demande = 1') ?></td>
                    <td><?php echo rowCount($connection,'SELECT * FROM enseignant WHERE qui = "enseignant" AND demande = 1') ?></td>
                    <td><?php echo rowCount($connection,'SELECT * FROM enseignant WHERE qui = "fonctionnaire" AND demande = 1') ?></td>
                    <td><?php echo rowCount($connection,'SELECT * FROM filiere ') ?></td>
                    <td><?php echo rowCount($connection,'SELECT nom FROM enseignant WHERE demande = 0 UNION SELECT nom FROM etudiant WHERE demande = 0') ?></td>
                    
                </tr>
            </table>
            <table class="static">
                <th>Ajouter un utilisateur : </th>
                <td><button type="submit" name="update" class="button-6" onclick="linke()" style="float:right;" >Ajouter</button></td>
            </table>
            
        </div>
        <script>
            function linke(){
                location.href = "ajout.php";
            }
        </script>
    </body>
</html>