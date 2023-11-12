<?php 
//cette page afficher tous les etudiants qui sont accepter et ont l'autorité de ce connecté


     require_once('../../ScriptPhp/connection.php');
?>
<!doctype html>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="../../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">

    </head>

    
    <?php
        $sql = 'SELECT id,nom, pnom, email, tel, cne, fil FROM etudiant WHERE demande = 1 ';
        $statement = $connection->prepare($sql);
        $statement->execute(array());
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
        <div class="fonctio">
            <form method="post" action="etud.php" >
                <table class="etud">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>CNE</th>
                    <th>Filière</th>
                    <th colspan="2"></th>
                    
                </tr>
                <?php  if($statement->rowCount()>0) {  
                    foreach($statement as $row) { ?>
                <tr>
                    <input type="hidden" name="idd" value="<?php echo $row[0]; ?>">
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td>
                    <td><?php echo $row[4]; ?></td>
                    <td><?php echo $row[5]; ?></td>
                    <td><?php echo $row[6]; ?></td>
                    
                    <td style="padding:0;margin:0" colspan='2'>
                        <button type="button" name="modify" onClick="modif(<?php echo $row[0]; ?>)" class="button-7" >Modifer</button>
                        <button type="button" name="delet" onClick="supp(<?php echo $row[0]; ?>)" class="button-8" >Supprimer</button>
                    </td>
                </tr>
                 <?php }} else { ?>
                    <tr>
                        <th colspan="7">Aucun Etudiant existe</th>
                    </tr>
                    <?php } ?>
            </table>
            </form>
     </div>
        <script>
            function supp(id)
            {
                if(confirm("Vous voulez supprimer ?")){
                    window.location.href='deleteetud.php?id=' +id+'';
                    return true;
                }
                else {
                    return false;
                }
            } 
            function modif(id)
            {
                if(confirm("Vous voulez modifier ?")){
                    window.location.href='modetud.php?id=' +id+'';
                    return true;
                }
                else {
                    return false;
                }
            } 
        </script>
    </body>
</html>