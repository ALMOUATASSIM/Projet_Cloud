<?php
session_start();
require_once('../../ScriptPhp/connection.php');
?>
<?php
    if(isset($_POST['chercher1'])){
        
        $che1 = $_POST['che1'];
        $qui = $_POST['qui'];
        $par = $_POST['par'];
        $che1 = trim($che1);
        $che1 = str_replace(' ', '', $che1);
//        Si l'admin veut chercher un etudiant
        if($qui == "Etudiant"){
//            Si l'admin clique sur tous pour afficher tous les étudiants existe
            if($par == "Tous"){
//                la requête d'affichage de tous les étudiants (demande = 1 signifie les utilisateurs qui sont accepté par l'admin)
                $sql = "SELECT nom,pnom,email,tel FROM etudiant WHERE demande = 1";
                
                try{
                    $statement = $connection->prepare($sql);
                    $statement->execute(array()); 
                    
                }
                
                catch(PDOException $e){
                echo "<div class='err'> Aucun Etudiant existe</div>";
                }
            } 
//            Si l'admin clique sur chercher pour chercher l'étudiant soit par nom, prénom, cne, filière, email ou téléphone
            else if ($par == "Chercher"){
//             La requête du recherche 
                $sql = "SELECT nom,pnom,email,tel FROM etudiant WHERE  demande = 1 AND (nom LIKE '%$che1%' OR pnom LIKE '%$che1%' OR cne LIKE '%$che1%' OR fil LIKE '%$che1%' OR email LIKE '%$che1%' OR tel LIKE '%$che1%')";
//                s'i l'admin a laisser le champ du recherche vide
                if(!$che1) {
                    $_SESSION['err'] = 1;
                    header("location: index.php");
                }
                else{
                    try{
                        $statement = $connection->prepare($sql);
                        $statement->execute(array()); 
                    }catch(PDOException $e){
                        echo "<div class='err'> Aucun Etudiant existe</div>";
                    }
                }
            }
            
//  la recherche d'un enseignat          
        }else if($qui == "Enseignant") {
//            la recherde de tous les enseignants
            if($par == "Tous"){
                $sql = "SELECT nom,pnom,email,tel FROM enseignant WHERE qui = 'enseignant' AND demande = 1  ";
                try{
                    $statement = $connection->prepare($sql);
                    $statement->execute(array()); 
                }catch(PDOException $e){
                echo "<div class='err'> Aucun enseignant existe </div>";
                }
            }
//            la recherche spécifie d'un enseignant
            else if ($par == "Chercher"){
                $sql = "SELECT nom,pnom,email,tel FROM enseignant WHERE qui = 'enseignant' AND demande = 1 AND (nom LIKE '%$che1%' OR pnom LIKE '%$che1%' OR ppr LIKE   '%$che1%' OR email LIKE '%$che1%' OR tel LIKE '%$che1%' ) " ;
//                si le champ de recherche est vide
                if(!$che1) {
                    $_SESSION['err'] = 1;
                    header("location: index.php");
                }else {
                    try{
                        $statement = $connection->prepare($sql);
                        $statement->execute(array()); 
                    }catch(PDOException $e){
                        echo "<div class='err'> Aucun enseignant existe</div>";
                    }
                }
            }
            
//            la recherche d'un fonctionnaire
        }else if($qui == "Fonctionnaire"){
//            la recherde de tous les fonctionnaires
            if($par == "Tous"){
                $sql = "SELECT nom,pnom,email,tel FROM enseignant WHERE qui = 'fonctionnaire' AND demande = 1 ";
                try{
                    $statement = $connection->prepare($sql);
                    $statement->execute(array()); 
                }catch(PDOException $e){
                    echo "<div class='err'> Aucun fonctionnaire existe</div>";
                }
//                la recherche spécifie d'un fonctionnaire
            } else if ($par == "Chercher"){
                $sql = "SELECT nom,pnom,email,tel FROM enseignant WHERE qui = 'fonctionnaire' AND demande = 1 AND  (nom LIKE '%$che1%' OR pnom LIKE '%$che1%' OR ppr LIKE '%$che1%'  OR email LIKE '%$che1%' OR tel LIKE '%$che1%') " ;
                if(!$che1) {
                    $_SESSION['err'] = 1;
                    header("location: index.php");
                } else {
                    try{
                        $statement = $connection->prepare($sql);
                        $statement->execute(array()); 
                    }catch(PDOException $e){
                        echo "<div class='err'> Aucun fonctionnaire existe</div>";
                    }
                }
            }
        }
    }
    
?>

<!DOCTYPE html>

<html>
    <head>
        <title> Résultats </title>
        <meta charset="UTF-8">
        <link href="../../css/style.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">
        
    </head>
    <body>
         <header>
            <div class="alle">
                <h1><a href="index.php">AdminUPPA</a><span class="orange">.</span></h1>
                <nav>
                    <ul>
                        
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="admin.php">Admin</a></li>
                        <li><a href="../../ScriptPhp/logout.php">Déconnexion</a></li>
                    </ul>
                </nav>
            </div>         
        </header>
        <div class="topcompte" >
            <p>Résultats</p>

        </div>
        <section class="table-recherche">
            <form action="chercher.php">
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                </tr>
                <?php if($qui == "Etudiant"){ ?>
                <?php 
                    if($statement->rowCount()>0)
                    {
                        foreach($statement as $row)
                        {
                ?>
                <tr>
                    <td><?php echo $row[0];?></td>
                    <td><?php echo $row[1];?></td>
                    <td><?php echo $row[2];?></td>
                    <td><?php echo $row[3];?></td>
                    
                </tr>
                <?php } ?>
                <td colspan="4" style="border:none;"><a class="button-11" href="etud.php" style="color: #fff;float:right;">Page de Modification</a></td>
                <?php }else { ?>
                <tr>
                    <th colspan="4">Aucun Etudiant existe </th>
                </tr>
                <?php }} else if($qui == "Enseignant"){ ?>
                <?php 
                    if($statement->rowCount()>0)
                    {
                        foreach($statement as $row)
                        {
                ?>
                <tr>
                    <td><?php echo $row[0];?></td>
                    <td><?php echo $row[1];?></td>
                    <td><?php echo $row[2];?></td>
                    <td><?php echo $row[3];?></td>
                </tr>
                <?php } ?>
                <td colspan="4" style="border:none;"><a class="button-11" href="enseig.php" style="color: #fff;float:right;">Page de Modification</a></td>
                <?php }else { ?>
                <tr>
                    <th colspan="4">Aucun Enseignant existe </th>
                </tr>
                <?php }} else if($qui == "Fonctionnaire"){ ?>
                <?php 
                    if($statement->rowCount()>0)
                    {
                        foreach($statement as $row)
                        {
                ?>
                <tr>
                    <td><?php echo $row[0];?></td>
                    <td><?php echo $row[1];?></td>
                    <td><?php echo $row[2];?></td>
                    <td><?php echo $row[3];?></td>
                </tr>
                <?php } ?>
                <td colspan="4" style="border:none;"><a class="button-11" href="fonc.php" style="color: #fff;float:right;">Page de Modification</a></td>
                <?php }else { ?>
                <tr>
                    <th colspan="4">Aucun Fonctionnaire existe </th>
                </tr>
                <?php }} ?>
                
            </table>
        </form>
        </section>
    </body>
</html>


