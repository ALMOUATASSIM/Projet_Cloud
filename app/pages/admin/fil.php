<?php 

//cette page afficher tous les filière

     require_once('../../ScriptPhp/connection.php');
?>
<?php
        $sql = 'SELECT id,nom,c_nom FROM filiere';
        $statement = $connection->prepare($sql);
        $result = $statement->execute(array());
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
            <a  href="admin.php">Statistique</a>
            <a  href="enseig.php">Enseignant</a>
            <a  href="fonc.php">Fonctionnare</a>
            <a  href="etud.php">Etudiant</a>
            <a class="in" href="fil.php">Filière</a>
            <a  href="demande.php">Demande</a>
           
        </div>
         <div class="fonct">
            <form action="fil.php" method="post">
                <table class="user">
                <tr>
                    <th>ID</th>
                    <th>Filière</th>
                    <th>Nom Complet</th>
                    <th colspan="2"><button type="button" name="ajouter" onclick="linke()" class="button-11" >Ajouter</button></th>
                </tr>
                    <?php  if($statement->rowCount()>0) {  
                    foreach($statement as $row) { ?>

                    <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td colspan="2">
                           <button type="button" name="modify" onClick="modif(<?php echo $row[0]; ?>)" class="button-7" >Modifer</button>
                        <button type="button" name="delet" onClick="supp(<?php echo $row[0]; ?>)" class="button-8" >Supprimer</button> 
                        </td>
                    </tr>
                <?php }} else { ?>
                    <tr>
                        <th colspan="2">Aucun Filière existe</th>
                    </tr>
                    <?php } ?>
                
            </table>
            </form>
        </div>
        <script>
            
            function modif(id)
            {
                if(confirm("Vous voulez modifier ?")){
                    window.location.href='modfil.php?id=' +id+'';
                    return true;
                }
                else {
                    return false;
                }
            }
            function linke(){
                location.href = "ajoutfil.php";
            }
            function supp(id)
            {
                if(confirm("Vous voulez supprimer ?")){
                    window.location.href='deletfil.php?id=' +id+'';
                    return true;
                }
                else {
                    return false;
                }
            } 
        </script>
    </body>
</html>